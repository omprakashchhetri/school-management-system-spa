/**
 * Shared SPA engine for the post-login portals.
 *
 * This used to be duplicated almost 1:1 as inline <script> blocks in both
 * app/Views/portal/post-login-employee.php and post-login-student.php,
 * which meant a bug fixed in one file quietly stayed broken in the other
 * (see README.md). Both portals now include this one file and call
 * SPARouter.init(options) with their own route/plugin configuration.
 *
 * options:
 *   portalSegment       {string}  URL segment the portal is mounted under,
 *                                 e.g. "post-login-employee".
 *   pluginConfigs       {object}  { pluginName: { selector, routes, priority } }
 *                                 for the plugin names listed in PLUGIN_HANDLERS
 *                                 below. init/destroy are supplied by the engine.
 *   customConfigs       {object}  Per-route overrides, e.g.
 *                                 { dataTable: { 'students': {...} }, quillEditor: {...} }
 *   chartConfigs        {array}   [{ id, color, type: 'area'|'line'|'radial' }]
 *   exportTableIds      {array}   Element ids checked (in order) for #exportOptions export.
 *   exportFilenamePrefix{string}  Prefix for downloaded CSV/JSON export files.
 *   errorConfirmColor   {string}  SweetAlert confirm button color for error dialogs.
 *   confirmLogout       {bool}    Ask for confirmation before logging out.
 *   warnBeforeLogout    {bool}    Show a dialog (rather than logging out silently)
 *                                 when the inactivity timer fires.
 *   inactivityTimeoutMs {number}  Defaults to 600000 (10 minutes).
 */
(function (window, document, $) {
    "use strict";

    function init(options) {
        options = options || {};

        const portalSegment = options.portalSegment;
        if (!portalSegment) {
            throw new Error('SPARouter.init: options.portalSegment is required');
        }

        const baseUrl = options.baseUrl;
        const splitToken = portalSegment + "/";
        const baseUrlOfApp = window.location.href.split(splitToken)[0] + splitToken;
        const restOfBaseUrl = window.location.href.split(splitToken)[1] || "";

        const chartConfigs = options.chartConfigs || [];
        const exportTableIds = options.exportTableIds || ['assignmentTable'];
        const exportFilenamePrefix = options.exportFilenamePrefix || 'export';
        const errorConfirmColor = options.errorConfirmColor || '#d33';
        const confirmLogout = !!options.confirmLogout;
        const warnBeforeLogout = !!options.warnBeforeLogout;
        const inactivityTimeoutMs = options.inactivityTimeoutMs || 600000;

        // =========================== AUTH BOOTSTRAP ===========================
        const Auth = (function () {
            const token =
                localStorage.getItem('authToken') ||
                (typeof Cookies !== 'undefined' ? Cookies.get('authToken') : null);

            return {
                token,
                isAuthenticated: !!token
            };
        })();

        // 🔒 HARD FAIL EARLY (prevents half-loaded SPA)
        if (!Auth.isAuthenticated) {
            window.location.href = baseUrl + "pre-login/";
            throw new Error('Authentication required');
        }

        // =========================== GLOBAL AJAX AUTH ===========================
        $.ajaxSetup({
            beforeSend: function (xhr) {
                if (Auth.token) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + Auth.token);
                }
            }
        });

        // =========================== GLOBAL STATE ===========================
        const AppState = {
            activePlugins: {},
            pluginInstances: {},
            currentRoute: '',
            isNavigating: false,
            navigationQueue: []
        };

        // =========================== CALENDAR GLOBALS ===========================
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        // =========================== PLUGIN CONFIGURATION ===========================
        // The caller supplies selector/routes/priority per plugin; the engine
        // owns the actual init/destroy implementations so both portals share
        // one copy of the plugin lifecycle logic.
        const PLUGIN_HANDLERS = {
            dataTable: { init: initDataTable, destroy: destroyDataTable },
            fileUpload: { init: initFileUpload, destroy: destroyFileUpload },
            calendar: { init: initCalendar, destroy: destroyCalendar },
            charts: { init: initCharts, destroy: destroyCharts },
            quillEditor: { init: initQuillEditor, destroy: destroyQuillEditor },
            plyr: { init: initPlyr, destroy: destroyPlyr },
            fullCalendar: { init: initFullCalendar, destroy: destroyFullCalendar },
            jqueryUI: { init: initJQueryUI, destroy: destroyJQueryUI },
            vectorMap: { init: initVectorMap, destroy: destroyVectorMap },
            exportOptions: { init: initExportOptions, destroy: destroyExportOptions }
        };

        const pluginConfigs = {};
        Object.keys(PLUGIN_HANDLERS).forEach(function (name) {
            const supplied = (options.pluginConfigs && options.pluginConfigs[name]) || {};
            pluginConfigs[name] = Object.assign({}, supplied, PLUGIN_HANDLERS[name]);
        });

        const customConfigs = options.customConfigs || {};

        // =========================== NAVIGATION ===========================
        // Exposed on window: page fragments loaded into #app (e.g.
        // exam-details.php, employee-details.js) call navigateTo(...)
        // directly as a global, the same way it worked when this code
        // lived inline in the portal shell.
        function navigateTo(route, push = true) {

            if (AppState.isNavigating) {
                AppState.navigationQueue.push({ route, push });
                return;
            }

            AppState.isNavigating = true;

            $('.preloader').show();
            cleanupAllPlugins();

            $.ajax({
                url: baseUrlOfApp + route,
                method: "POST",
                timeout: 15000,

                success: function (data) {
                    $("#app").html(data);
                    AppState.currentRoute = route;

                    setTimeout(() => {
                        initializePluginsForRoute(route);
                        bindGlobalEventListeners();

                        if (push) {
                            let newUrl = baseUrlOfApp + route;
                            if (route === "") newUrl = baseUrlOfApp;
                            history.pushState({ route }, "", newUrl);
                        }
                    }, 100);
                },

                error: function (xhr) {
                    if (xhr.status === 401 || xhr.status === 403) {
                        logout();
                    } else {
                        showErrorMessage('Error loading page. Please try again.');
                    }
                },

                complete: function () {
                    $('.preloader').hide();
                    AppState.isNavigating = false;

                    if (AppState.navigationQueue.length) {
                        const next = AppState.navigationQueue.shift();
                        setTimeout(() => navigateTo(next.route, next.push), 0);
                    }
                }
            });
        }

        // =========================== GLOBAL AJAX 401 HANDLER ===========================
        $(document).ajaxError(function (event, xhr) {
            if (xhr.status === 401) {
                logout();
            }
        });

        // =========================== LOGOUT ===========================
        function performLogout() {
            cleanupAllPlugins();

            localStorage.removeItem('authToken');
            localStorage.removeItem('loginType');

            Cookies.remove('authToken', { path: '/' });
            Cookies.remove('loginType', { path: '/' });

            window.location.href = baseUrl + "pre-login/";
        }

        function logout() {
            if (!confirmLogout) {
                performLogout();
                return;
            }

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Logout?',
                    text: 'Are you sure you want to logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#487FFF',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performLogout();
                    }
                });
            } else if (confirm('Are you sure you want to logout?')) {
                performLogout();
            }
        }

        // =========================== PLUGIN MANAGEMENT ===========================

        function initializePluginsForRoute(route) {
            const sortedPlugins = Object.keys(pluginConfigs).sort((a, b) => {
                return (pluginConfigs[a].priority || 999) - (pluginConfigs[b].priority || 999);
            });

            sortedPlugins.forEach(pluginName => {
                const config = pluginConfigs[pluginName];
                if (!config.selector || !config.routes) return;

                if (shouldLoadPlugin(config.routes, route)) {
                    setTimeout(() => {
                        try {
                            const elements = document.querySelectorAll(config.selector);
                            if (elements.length > 0) {
                                config.init(route);
                                AppState.activePlugins[pluginName] = true;
                            }
                        } catch (error) {
                            console.error(`Error initializing plugin ${pluginName}:`, error);
                        }
                    }, 50 * (config.priority || 1));
                }
            });
        }

        function shouldLoadPlugin(pluginRoutes, currentRoute) {
            if (pluginRoutes.includes('*')) return true;
            if (pluginRoutes.includes(currentRoute)) return true;

            return pluginRoutes.some(pattern => {
                if (pattern.includes('*')) {
                    const regex = new RegExp('^' + pattern.replace(/\*/g, '.*') + '$');
                    return regex.test(currentRoute);
                }
                return false;
            });
        }

        function cleanupAllPlugins() {
            Object.keys(AppState.activePlugins).forEach(pluginName => {
                if (AppState.activePlugins[pluginName] && pluginConfigs[pluginName]) {
                    try {
                        pluginConfigs[pluginName].destroy();
                        AppState.activePlugins[pluginName] = false;
                    } catch (error) {
                        console.error(`Error cleaning up plugin ${pluginName}:`, error);
                    }
                }
            });

            AppState.pluginInstances = {};
        }

        function getCustomConfig(pluginName, route) {
            if (customConfigs[pluginName] && customConfigs[pluginName][route]) {
                return customConfigs[pluginName][route];
            }
            return null;
        }

        // =========================== PLUGIN INITIALIZATION FUNCTIONS ===========================

        function initDataTable(route) {
            const customConfig = getCustomConfig('dataTable', route);
            const defaultConfig = {
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries"
                },
                destroy: true
            };

            const config = customConfig ? { ...defaultConfig, ...customConfig } : defaultConfig;
            const selector = pluginConfigs.dataTable.selector;

            $(selector).each(function () {
                try {
                    if ($.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable().destroy();
                    }

                    const table = $(this).DataTable(config);
                    if (!AppState.pluginInstances.dataTables) AppState.pluginInstances.dataTables = [];
                    AppState.pluginInstances.dataTables.push(table);
                } catch (error) {
                    console.error('DataTable initialization error:', error);
                }
            });
        }

        function destroyDataTable() {
            if (AppState.pluginInstances.dataTables) {
                AppState.pluginInstances.dataTables.forEach(table => {
                    try {
                        if (table && typeof table.destroy === 'function') {
                            table.destroy();
                        }
                    } catch (error) {
                        console.error('DataTable destroy error:', error);
                    }
                });
                AppState.pluginInstances.dataTables = [];
            }
        }

        function initFileUpload(route) {
            $('.fileUpload').each(function () {
                try {
                    const inputName = $(this).data('input-name') || '[]';
                    $(this).fileUpload({ inputName: inputName });
                } catch (error) {
                    console.error('File upload initialization error:', error);
                }
            });
        }

        function destroyFileUpload() {
            $('.fileUpload').each(function () {
                try {
                    $(this).empty();
                } catch (error) {
                    console.error('File upload destroy error:', error);
                }
            });
        }

        function initCalendar(route) {
            const display = document.querySelector(".display");
            const days = document.querySelector(".days");
            const previous = document.querySelector(".left");
            const next = document.querySelector(".right");

            if (display && days && previous && next) {
                const prevHandler = () => {
                    days.innerHTML = "";
                    month = month - 1;
                    if (month < 0) {
                        month = 11;
                        year = year - 1;
                    }
                    date.setMonth(month);
                    displayCalendar();
                };

                const nextHandler = () => {
                    days.innerHTML = "";
                    month = month + 1;
                    if (month > 11) {
                        month = 0;
                        year = year + 1;
                    }
                    date.setMonth(month);
                    displayCalendar();
                };

                previous.addEventListener("click", prevHandler);
                next.addEventListener("click", nextHandler);

                AppState.pluginInstances.calendarHandlers = { prevHandler, nextHandler, previous, next };

                displayCalendar();
            }
        }

        function destroyCalendar() {
            if (AppState.pluginInstances.calendarHandlers) {
                const { prevHandler, nextHandler, previous, next } = AppState.pluginInstances.calendarHandlers;
                if (previous && next) {
                    previous.removeEventListener("click", prevHandler);
                    next.removeEventListener("click", nextHandler);
                }
                AppState.pluginInstances.calendarHandlers = null;
            }
        }

        function initCharts(route) {
            chartConfigs.forEach(config => {
                const element = document.querySelector(`#${config.id}`);
                if (element) {
                    try {
                        if (config.type === 'area') {
                            createChart(config.id, config.color);
                        } else if (config.type === 'line') {
                            createLineChart(config.id, config.color);
                        } else if (config.type === 'radial') {
                            createRadialChart(config.id);
                        }
                    } catch (error) {
                        console.error(`Error creating chart ${config.id}:`, error);
                    }
                }
            });
        }

        function destroyCharts() {
            if (window.ApexCharts) {
                chartConfigs.forEach(config => {
                    const element = document.querySelector(`#${config.id}`);
                    if (element && element.chart) {
                        try {
                            element.chart.destroy();
                        } catch (error) {
                            console.error(`Error destroying chart #${config.id}:`, error);
                        }
                    }
                });
            }
        }

        function initQuillEditor(route) {
            const customConfig = getCustomConfig('quillEditor', route);
            const defaultConfig = {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['link', 'blockquote'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }]
                    ]
                }
            };

            const config = customConfig ? { ...defaultConfig, ...customConfig } : defaultConfig;

            document.querySelectorAll('.quill-editor, #editor').forEach(element => {
                try {
                    if (!element.classList.contains('ql-container') && window.Quill) {
                        const quill = new Quill(element, config);
                        if (!AppState.pluginInstances.quillEditors) AppState.pluginInstances.quillEditors = [];
                        AppState.pluginInstances.quillEditors.push(quill);
                    }
                } catch (error) {
                    console.error('Quill editor initialization error:', error);
                }
            });
        }

        function destroyQuillEditor() {
            if (AppState.pluginInstances.quillEditors) {
                AppState.pluginInstances.quillEditors.forEach(quill => {
                    try {
                        if (quill && quill.container) {
                            const toolbar = quill.container.previousSibling;
                            if (toolbar && toolbar.classList.contains('ql-toolbar')) {
                                toolbar.remove();
                            }
                            quill.container.innerHTML = '';
                        }
                    } catch (error) {
                        console.error('Quill editor destroy error:', error);
                    }
                });
                AppState.pluginInstances.quillEditors = [];
            }
        }

        function initPlyr(route) {
            if (window.Plyr) {
                try {
                    const players = Plyr.setup('.plyr, video, audio');
                    AppState.pluginInstances.plyrPlayers = players;
                } catch (error) {
                    console.error('Plyr initialization error:', error);
                }
            }
        }

        function destroyPlyr() {
            if (AppState.pluginInstances.plyrPlayers) {
                AppState.pluginInstances.plyrPlayers.forEach(player => {
                    try {
                        if (player && typeof player.destroy === 'function') {
                            player.destroy();
                        }
                    } catch (error) {
                        console.error('Plyr destroy error:', error);
                    }
                });
                AppState.pluginInstances.plyrPlayers = [];
            }
        }

        function initFullCalendar(route) {
            $('#full-calendar, .full-calendar').each(function () {
                try {
                    $(this).fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        }
                    });
                } catch (error) {
                    console.error('FullCalendar initialization error:', error);
                }
            });
        }

        function destroyFullCalendar() {
            $('#full-calendar, .full-calendar').each(function () {
                try {
                    if ($(this).hasClass('fc')) {
                        $(this).fullCalendar('destroy');
                    }
                } catch (error) {
                    console.error('FullCalendar destroy error:', error);
                }
            });
        }

        function initJQueryUI(route) {
            try {
                $('.ui-datepicker').each(function () {
                    if (!$(this).hasClass('hasDatepicker')) {
                        $(this).datepicker();
                    }
                });

                $('.ui-sortable').each(function () {
                    if (!$(this).hasClass('ui-sortable')) {
                        $(this).sortable();
                    }
                });

                $('.ui-draggable').each(function () {
                    if (!$(this).hasClass('ui-draggable')) {
                        $(this).draggable();
                    }
                });
            } catch (error) {
                console.error('jQuery UI initialization error:', error);
            }
        }

        function destroyJQueryUI() {
            try {
                $('.ui-datepicker.hasDatepicker').datepicker('destroy');
                $('.ui-sortable').sortable('destroy');
                $('.ui-draggable').draggable('destroy');
            } catch (error) {
                console.error('jQuery UI destroy error:', error);
            }
        }

        function initVectorMap(route) {
            $('#world-map, .vector-map').each(function () {
                try {
                    $(this).vectorMap({ map: 'world_mill_en', backgroundColor: 'transparent' });
                } catch (error) {
                    console.error('Vector map initialization error:', error);
                }
            });
        }

        function destroyVectorMap() {
            $('#world-map, .vector-map').each(function () {
                try {
                    if ($(this).children('.jvectormap-container').length) {
                        $(this).empty();
                    }
                } catch (error) {
                    console.error('Vector map destroy error:', error);
                }
            });
        }

        function initExportOptions(route) {
            const exportElement = document.getElementById('exportOptions');
            if (exportElement) {
                const exportHandler = function () {
                    const format = this.value;

                    let table = null;
                    for (const id of exportTableIds) {
                        table = document.getElementById(id);
                        if (table) break;
                    }
                    if (!table) return;

                    let data = [];
                    const headers = [];

                    table.querySelectorAll('thead th').forEach(th => {
                        headers.push(th.innerText.trim());
                    });

                    table.querySelectorAll('tbody tr').forEach(tr => {
                        const row = {};
                        tr.querySelectorAll('td').forEach((td, index) => {
                            row[headers[index]] = td.innerText.trim();
                        });
                        data.push(row);
                    });

                    if (format === 'csv') {
                        downloadCSV(data);
                    } else if (format === 'json') {
                        downloadJSON(data);
                    }
                };

                exportElement.addEventListener('change', exportHandler);
                AppState.pluginInstances.exportHandler = { element: exportElement, handler: exportHandler };
            }
        }

        function destroyExportOptions() {
            if (AppState.pluginInstances.exportHandler) {
                const { element, handler } = AppState.pluginInstances.exportHandler;
                if (element && handler) {
                    try {
                        element.removeEventListener('change', handler);
                    } catch (error) {
                        console.error('Export options destroy error:', error);
                    }
                }
                AppState.pluginInstances.exportHandler = null;
            }
        }

        // =========================== EVENT BINDING ===========================

        function bindGlobalEventListeners() {
            $(document).off("click", "#logoutBtn");
            $(document).off("click", "a.nav_js, .nav_js");
            $(document).off("shown.bs.tab", '[data-bs-toggle="tab"], [data-bs-toggle="pill"]');

            $(document).on("click", "#logoutBtn", function (e) {
                e.preventDefault();
                logout();
            });

            $(document).on("click", "a.nav_js, .nav_js", function (e) {
                e.preventDefault();
                $('.preloader').show();
                let route = $(this).attr("href") || $(this).data("route");
                if (route) {
                    if (route === "/") route = "";
                    navigateTo(route);
                }
            });

            // A DataTable initialized while its Bootstrap tab/pill pane is still
            // hidden (display:none) measures a near-zero container width and
            // locks that in permanently (most visibly with `responsive: true`).
            // Re-measure any DataTable inside a pane as soon as it's actually shown.
            $(document).on("shown.bs.tab", '[data-bs-toggle="tab"], [data-bs-toggle="pill"]', function (e) {
                const target = $(e.target).attr("data-bs-target") || $(e.target).attr("href");
                if (!target) return;

                $(target).find("table.dataTable").each(function () {
                    if ($.fn.DataTable.isDataTable(this)) {
                        const table = $(this).DataTable();
                        table.columns.adjust();
                        if (table.responsive && typeof table.responsive.recalc === 'function') {
                            table.responsive.recalc();
                        }
                    }
                });
            });
        }

        // =========================== UTILITY FUNCTIONS ===========================

        function displayCalendar() {
            const display = document.querySelector(".display");
            const days = document.querySelector(".days");

            if (!display || !days) return;

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const firstDayIndex = firstDay.getDay();
            const numberOfDays = lastDay.getDate();

            display.innerHTML = date.toLocaleString("en-US", { month: "long", year: "numeric" });
            days.innerHTML = '';

            for (let x = 1; x <= firstDayIndex; x++) {
                days.appendChild(document.createElement("div"));
            }

            for (let i = 1; i <= numberOfDays; i++) {
                let div = document.createElement("div");
                let currentDate = new Date(year, month, i);

                div.dataset.date = currentDate.toDateString();
                div.innerHTML = i;
                days.appendChild(div);

                if (
                    currentDate.getFullYear() === new Date().getFullYear() &&
                    currentDate.getMonth() === new Date().getMonth() &&
                    currentDate.getDate() === new Date().getDate()
                ) {
                    div.classList.add("current-date");
                }
            }
        }

        function createChart(chartId, chartColor) {
            let currentYear = new Date().getFullYear();

            var options = {
                series: [{ name: 'series1', data: [18, 25, 22, 40, 34, 55, 50, 60, 55, 65] }],
                chart: {
                    type: 'area',
                    width: 80,
                    height: 42,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 1, colors: [chartColor], lineCap: 'round' },
                fill: {
                    type: 'gradient',
                    colors: [chartColor],
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.5,
                        gradientToColors: [`${chartColor}00`],
                        opacityFrom: .5,
                        opacityTo: 0.3,
                        stops: [0, 100],
                    },
                },
                markers: { colors: [chartColor], strokeWidth: 2, size: 0, hover: { size: 8 } },
                xaxis: {
                    labels: { show: false },
                    categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`,
                        `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`],
                },
                yaxis: { labels: { show: false } }
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        // Pages that need a chart backed by real data (e.g. the admin
        // dashboard) set window.dashboardData.charts[chartId] before this
        // plugin runs. Falls back to placeholder demo data when a page
        // doesn't provide one, so this stays safe for any other route
        // reusing these chart ids without real data wired up.
        function getChartOverride(chartId) {
            return (window.dashboardData && window.dashboardData.charts && window.dashboardData.charts[chartId]) || null;
        }

        function createLineChart(chartId, chartColor) {
            const override = getChartOverride(chartId);

            var options = {
                series: override ? override.series : [
                    { name: 'Study', data: [8, 15, 9, 20, 10, 33, 13, 22, 8, 17, 10, 15] },
                    { name: 'Test', data: [8, 24, 18, 40, 18, 48, 22, 38, 18, 30, 20, 28] }
                ],
                chart: { type: 'area', width: '100%', height: 300, toolbar: { show: false } },
                colors: ['#3D7FF9', chartColor],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 1, colors: ["#3D7FF9", chartColor] },
                xaxis: {
                    categories: override ? override.categories
                        : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        function createRadialChart(chartId) {
            chartId = chartId || 'radialMultipleBar';
            const override = getChartOverride(chartId);

            const series = override ? override.series : [100, 60, 25];
            const labels = override ? override.labels : ['Completed', 'In Progress', 'Not Started'];

            var options = {
                series: series,
                chart: { height: 172, type: 'radialBar' },
                colors: ['#3D7FF9', '#27CFA7', '#020203'],
                plotOptions: {
                    radialBar: {
                        hollow: { size: '30%' },
                        dataLabels: {
                            total: {
                                show: true,
                                formatter: function () {
                                    return override ? (series[0] || 0) + '%' : '82%';
                                }
                            }
                        }
                    }
                },
                labels: labels
            };

            var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
            chart.render();
        }

        function downloadCSV(data) {
            const csv = data.map(row => Object.values(row).join(',')).join('\n');
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = exportFilenamePrefix + '_' + new Date().toISOString().split('T')[0] + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function downloadJSON(data) {
            const json = JSON.stringify(data, null, 2);
            const blob = new Blob([json], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = exportFilenamePrefix + '_' + new Date().toISOString().split('T')[0] + '.json';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function showErrorMessage(message) {
            if (window.Swal) {
                Swal.fire({ icon: 'error', title: 'Error', text: message, confirmButtonColor: errorConfirmColor });
            } else {
                alert(message);
            }
        }

        // =========================== INITIALIZATION ===========================
        $(document).ready(function () {

            // Record the initial route in history state so the first back-press
            // (popstate with no/void state) has somewhere valid to return to.
            history.replaceState({ route: restOfBaseUrl }, "", window.location.href);
            navigateTo(restOfBaseUrl, false);

            let inactivityTimer;

            function handleInactivityTimeout() {
                if (!warnBeforeLogout) {
                    logout();
                    return;
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Session Timeout',
                        text: 'You have been logged out due to inactivity.',
                        confirmButtonColor: '#487FFF',
                        allowOutsideClick: false
                    }).then(() => performLogout());
                } else {
                    alert('You have been logged out due to inactivity.');
                    performLogout();
                }
            }

            function resetInactivityTimer() {
                clearTimeout(inactivityTimer);
                inactivityTimer = setTimeout(handleInactivityTimeout, inactivityTimeoutMs);
            }

            ['load', 'mousemove', 'keypress', 'scroll', 'click', 'touchstart']
                .forEach(event => window.addEventListener(event, resetInactivityTimer, { passive: true }));

            resetInactivityTimer();
        });

        // =========================== HISTORY HANDLING ===========================
        window.onpopstate = function (event) {
            const route = (event.state && event.state.route !== undefined) ? event.state.route : restOfBaseUrl;
            navigateTo(route, false);
        };

        // =========================== ERROR HANDLERS ===========================
        window.addEventListener('error', e => console.error('Global Error:', e.error));
        window.addEventListener('unhandledrejection', e => console.error('Unhandled Promise Rejection:', e.reason));

        // =========================== CAPACITOR (MOBILE) BACK BUTTON ===========================
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.Capacitor) return;

            const Plugins = window.Capacitor.Plugins || {};
            const App = Plugins.App;
            const Toast = Plugins.Toast;
            if (!App) return;

            let lastBack = 0;

            App.addListener('backButton', () => {
                if (window.history.length > 1) {
                    window.history.back();
                    return;
                }

                const now = Date.now();
                if (now - lastBack < 2000) {
                    App.exitApp();
                } else {
                    lastBack = now;
                    if (Toast) {
                        Toast.show({ text: 'Press back again to exit', duration: 'short' });
                    }
                }
            });
        });

        window.navigateTo = navigateTo;

        console.log('SPA router initialized for ' + portalSegment);
    }

    window.SPARouter = { init: init };

})(window, document, jQuery);
