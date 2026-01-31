<!-- Page Main Wrapper -->
<div id="app"></div>

<script>
// =========================== CONFIGURATION ===========================
const baseUrl = "<?= base_url() ?>";
const baseUrlOfApp = window.location.href.split("post-login-employee/")[0] + "post-login-employee/";
const restOfBaseUrl = window.location.href.split("post-login-employee/")[1];

// =========================== AUTH BOOTSTRAP ===========================
const Auth = (function() {
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
    beforeSend: function(xhr) {
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

// =========================== PLUGIN CONFIGURATIONS ===========================

const pluginConfigs = {
    dataTable: {
        selector: 'table.display, .datatable, #assignmentTable, #reportCardTable, #documentsTable',
        routes: ['admin/dashboard', 'students', 'assignments', 'reports', '*'],
        init: initDataTable,
        destroy: destroyDataTable,
        priority: 1
    },
    fileUpload: {
        selector: '.fileUpload',
        routes: ['*'], // Available on all routes
        init: initFileUpload,
        destroy: destroyFileUpload,
        priority: 2
    },
    calendar: {
        selector: '.display, .calendar-widget',
        routes: ['admin/dashboard', 'calendar'],
        init: initCalendar,
        destroy: destroyCalendar,
        priority: 3
    },
    charts: {
        selector: '#complete-course, #earned-certificate, #course-progress, #community-support, #doubleLineChart, #radialMultipleBar',
        routes: ['admin/dashboard', 'analytics'],
        init: initCharts,
        destroy: destroyCharts,
        priority: 4
    },
    quillEditor: {
        selector: '.quill-editor, #editor',
        routes: ['compose', 'edit', 'blog', 'create-admission', 'admission-create'],
        init: initQuillEditor,
        destroy: destroyQuillEditor,
        priority: 5
    },
    plyr: {
        selector: '.plyr, video, audio',
        routes: ['courses', 'media', 'lessons'],
        init: initPlyr,
        destroy: destroyPlyr,
        priority: 6
    },
    fullCalendar: {
        selector: '#full-calendar, .full-calendar',
        routes: ['calendar', 'schedule'],
        init: initFullCalendar,
        destroy: destroyFullCalendar,
        priority: 7
    },
    jqueryUI: {
        selector: '.ui-datepicker, .ui-sortable, .ui-draggable',
        routes: ['*'],
        init: initJQueryUI,
        destroy: destroyJQueryUI,
        priority: 8
    },
    vectorMap: {
        selector: '#world-map, .vector-map',
        routes: ['analytics', 'reports'],
        init: initVectorMap,
        destroy: destroyVectorMap,
        priority: 9
    },
    exportOptions: {
        selector: '#exportOptions',
        routes: ['students', 'reports', 'data'],
        init: initExportOptions,
        destroy: destroyExportOptions,
        priority: 10
    }
};

// Custom configurations for specific routes
const customConfigs = {
    dataTable: {
        'students': {
            pageLength: 25,
            order: [
                [0, 'asc']
            ],
            responsive: true
        },
        'assignments': {
            pageLength: 10,
            order: [
                [2, 'desc']
            ],
            searching: true,
            responsive: true
        }
    },
    quillEditor: {
        'compose': {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['image', 'video']
                ]
            }
        },
        'edit': {
            theme: 'bubble',
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    ['link']
                ]
            }
        }
    }
};

// =========================== NAVIGATION ===========================
function navigateTo(route, push = true) {

    if (AppState.isNavigating) {
        AppState.navigationQueue.push({
            route,
            push
        });
        return;
    }

    AppState.isNavigating = true;

    $('.preloader').show();
    cleanupAllPlugins();

    $.ajax({
        url: baseUrlOfApp + route,
        method: "POST",
        timeout: 15000,

        success: function(data) {
            $("#app").html(data);
            AppState.currentRoute = route;

            setTimeout(() => {
                initializePluginsForRoute(route);
                bindGlobalEventListeners();

                if (push) {
                    let newUrl = baseUrlOfApp + route;
                    if (route === "") newUrl = baseUrlOfApp;
                    history.pushState({
                        route
                    }, "", newUrl);
                }
            }, 100);
        },

        error: function(xhr) {
            if (xhr.status === 401 || xhr.status === 403) {
                logout();
            } else {
                showErrorMessage('Error loading page. Please try again.');
            }
        },

        complete: function() {
            $('.preloader').hide();
            AppState.isNavigating = false;

            if (AppState.navigationQueue.length) {
                const next = AppState.navigationQueue.shift();
                setTimeout(() => navigateTo(next.route, next.push), 100);
            }
        }
    });
}

// =========================== GLOBAL AJAX 401 HANDLER ===========================
$(document).ajaxError(function(event, xhr) {
    if (xhr.status === 401) {
        logout();
    }
});

// =========================== LOGOUT ===========================
function logout() {
    cleanupAllPlugins();

    localStorage.removeItem('authToken');
    localStorage.removeItem('loginType');

    Cookies.remove('authToken', {
        path: '/'
    });
    Cookies.remove('loginType', {
        path: '/'
    });

    window.location.href = baseUrl + "pre-login/";
}


// =========================== PLUGIN MANAGEMENT ===========================

function initializePluginsForRoute(route) {
    console.log(`Initializing plugins for route: ${route}`);

    // Sort plugins by priority
    const sortedPlugins = Object.keys(pluginConfigs).sort((a, b) => {
        return (pluginConfigs[a].priority || 999) - (pluginConfigs[b].priority || 999);
    });

    sortedPlugins.forEach(pluginName => {
        const config = pluginConfigs[pluginName];

        // Check if plugin should be loaded for this route
        if (shouldLoadPlugin(config.routes, route)) {
            // Use setTimeout to ensure DOM is ready
            setTimeout(() => {
                try {
                    const elements = document.querySelectorAll(config.selector);
                    if (elements.length > 0) {
                        console.log(`Loading plugin: ${pluginName} (${elements.length} elements)`);
                        config.init(route);
                        AppState.activePlugins[pluginName] = true;
                    } else {
                        console.log(`Plugin ${pluginName} skipped - no matching elements`);
                    }
                } catch (error) {
                    console.error(`Error initializing plugin ${pluginName}:`, error);
                }
            }, 50 * (config.priority || 1)); // Stagger initialization
        }
    });
}

function shouldLoadPlugin(pluginRoutes, currentRoute) {
    if (pluginRoutes.includes('*')) return true;
    if (pluginRoutes.includes(currentRoute)) return true;

    // Check for wildcard patterns
    return pluginRoutes.some(pattern => {
        if (pattern.includes('*')) {
            const regex = new RegExp('^' + pattern.replace(/\*/g, '.*') + '$');
            return regex.test(currentRoute);
        }
        return false;
    });
}

function cleanupAllPlugins() {
    console.log('Cleaning up all plugins...');

    Object.keys(AppState.activePlugins).forEach(pluginName => {
        if (AppState.activePlugins[pluginName] && pluginConfigs[pluginName]) {
            try {
                console.log(`Cleaning up plugin: ${pluginName}`);
                pluginConfigs[pluginName].destroy();
                AppState.activePlugins[pluginName] = false;
            } catch (error) {
                console.error(`Error cleaning up plugin ${pluginName}:`, error);
            }
        }
    });

    // Clear all plugin instances
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
        destroy: true // Allow re-initialization
    };

    const config = customConfig ? {
        ...defaultConfig,
        ...customConfig
    } : defaultConfig;

    $('table.display, .datatable, #assignmentTable, #reportCardTable').each(function() {
        try {
            // Destroy existing DataTable if present
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
    // Initialize file upload plugin for each .fileUpload element
    $('.fileUpload').each(function() {
        try {
            const inputName = $(this).data('input-name') || '[]';
            $(this).fileUpload({
                inputName: inputName
            });
            console.log('File upload initialized for element with name:', inputName);
        } catch (error) {
            console.error('File upload initialization error:', error);
        }
    });
}

function destroyFileUpload() {
    // Clean up file upload instances
    $('.fileUpload').each(function() {
        try {
            $(this).empty(); // Clear the content
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

        AppState.pluginInstances.calendarHandlers = {
            prevHandler,
            nextHandler,
            previous,
            next
        };

        displayCalendar();
    }
}

function destroyCalendar() {
    if (AppState.pluginInstances.calendarHandlers) {
        const {
            prevHandler,
            nextHandler,
            previous,
            next
        } = AppState.pluginInstances.calendarHandlers;
        if (previous && next) {
            previous.removeEventListener("click", prevHandler);
            next.removeEventListener("click", nextHandler);
        }
        AppState.pluginInstances.calendarHandlers = null;
    }
}

function initCharts(route) {
    const chartConfigs = [{
            id: 'complete-course',
            color: '#2FB2AB',
            type: 'area'
        },
        {
            id: 'earned-certificate',
            color: '#27CFA7',
            type: 'area'
        },
        {
            id: 'course-progress',
            color: '#6142FF',
            type: 'area'
        },
        {
            id: 'community-support',
            color: '#FA902F',
            type: 'area'
        },
        {
            id: 'doubleLineChart',
            color: '#27CFA7',
            type: 'line'
        },
        {
            id: 'radialMultipleBar',
            color: null,
            type: 'radial'
        }
    ];

    chartConfigs.forEach(config => {
        const element = document.querySelector(`#${config.id}`);
        if (element) {
            try {
                if (config.type === 'area') {
                    createChart(config.id, config.color);
                } else if (config.type === 'line') {
                    createLineChart(config.id, config.color);
                } else if (config.type === 'radial') {
                    createRadialChart();
                }
            } catch (error) {
                console.error(`Error creating chart ${config.id}:`, error);
            }
        }
    });
}

function destroyCharts() {
    if (window.ApexCharts) {
        const chartElements = ['#complete-course', '#earned-certificate', '#course-progress',
            '#community-support', '#doubleLineChart', '#radialMultipleBar'
        ];

        chartElements.forEach(selector => {
            const element = document.querySelector(selector);
            if (element && element.chart) {
                try {
                    element.chart.destroy();
                } catch (error) {
                    console.error(`Error destroying chart ${selector}:`, error);
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
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }]
            ]
        }
    };

    const config = customConfig ? {
        ...defaultConfig,
        ...customConfig
    } : defaultConfig;

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
    $('#full-calendar, .full-calendar').each(function() {
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
    $('#full-calendar, .full-calendar').each(function() {
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
        $('.ui-datepicker').each(function() {
            if (!$(this).hasClass('hasDatepicker')) {
                $(this).datepicker();
            }
        });

        $('.ui-sortable').each(function() {
            if (!$(this).hasClass('ui-sortable')) {
                $(this).sortable();
            }
        });

        $('.ui-draggable').each(function() {
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
    $('#world-map, .vector-map').each(function() {
        try {
            $(this).vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent'
            });
        } catch (error) {
            console.error('Vector map initialization error:', error);
        }
    });
}

function destroyVectorMap() {
    $('#world-map, .vector-map').each(function() {
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
        const exportHandler = function() {
            const format = this.value;
            const table = document.getElementById('assignmentTable');
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
        AppState.pluginInstances.exportHandler = {
            element: exportElement,
            handler: exportHandler
        };
    }
}

function destroyExportOptions() {
    if (AppState.pluginInstances.exportHandler) {
        const {
            element,
            handler
        } = AppState.pluginInstances.exportHandler;
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
    // Unbind first to prevent duplicates
    $(document).off("click", "#logoutBtn");
    $(document).off("click", "a.nav_js, .nav_js");

    // Re-bind logout button
    $(document).on("click", "#logoutBtn", function(e) {
        e.preventDefault();
        logout();
    });

    // Re-bind navigation links
    $(document).on("click", "a.nav_js, .nav_js", function(e) {
        e.preventDefault();
        $('.preloader').show();
        let route = $(this).attr("href") || $(this).data("route");
        if (route) {
            if (route === "/") route = "";
            navigateTo(route);
        }
    });

    console.log('Global event listeners bound');
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

    let formattedDate = date.toLocaleString("en-US", {
        month: "long",
        year: "numeric"
    });

    display.innerHTML = formattedDate;
    days.innerHTML = '';

    for (let x = 1; x <= firstDayIndex; x++) {
        const div = document.createElement("div");
        days.appendChild(div);
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
        series: [{
            name: 'series1',
            data: [18, 25, 22, 40, 34, 55, 50, 60, 55, 65],
        }],
        chart: {
            type: 'area',
            width: 80,
            height: 42,
            sparkline: {
                enabled: true
            },
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 1,
            colors: [chartColor],
            lineCap: 'round'
        },
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
        markers: {
            colors: [chartColor],
            strokeWidth: 2,
            size: 0,
            hover: {
                size: 8
            }
        },
        xaxis: {
            labels: {
                show: false
            },
            categories: [`Jan ${currentYear}`, `Feb ${currentYear}`, `Mar ${currentYear}`,
                `Apr ${currentYear}`, `May ${currentYear}`, `Jun ${currentYear}`
            ],
        },
        yaxis: {
            labels: {
                show: false
            }
        }
    };

    var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
}

function createLineChart(chartId, chartColor) {
    var options = {
        series: [{
                name: 'Study',
                data: [8, 15, 9, 20, 10, 33, 13, 22, 8, 17, 10, 15]
            },
            {
                name: 'Test',
                data: [8, 24, 18, 40, 18, 48, 22, 38, 18, 30, 20, 28]
            }
        ],
        chart: {
            type: 'area',
            width: '100%',
            height: 300,
            toolbar: {
                show: false
            }
        },
        colors: ['#3D7FF9', chartColor],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 1,
            colors: ["#3D7FF9", chartColor]
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        }
    };
    let lastBackPress = 0;

    document.addEventListener("backbutton", function (e) {

        const now = Date.now();

        if (window.history.length > 1) {
            e.preventDefault();
            window.history.back();
        } else {
            if (now - lastBackPress < 2000) {
                navigator.app.exitApp();
            } else {
                lastBackPress = now;
                alert("Press back again to exit");
            }
        }

    }, false);


    var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
}

function createRadialChart() {
    var options = {
        series: [100, 60, 25],
        chart: {
            height: 172,
            type: 'radialBar'
        },
        colors: ['#3D7FF9', '#27CFA7', '#020203'],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '30%'
                },
                dataLabels: {
                    total: {
                        show: true,
                        formatter: function() {
                            return '82%'
                        }
                    }
                }
            }
        },
        labels: ['Completed', 'In Progress', 'Not Started']
    };

    var chart = new ApexCharts(document.querySelector("#radialMultipleBar"), options);
    chart.render();
}

function downloadCSV(data) {
    const csv = data.map(row => Object.values(row).join(',')).join('\n');
    const blob = new Blob([csv], {
        type: 'text/csv'
    });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'export.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function downloadJSON(data) {
    const json = JSON.stringify(data, null, 2);
    const blob = new Blob([json], {
        type: 'application/json'
    });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'export.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function showErrorMessage(message) {
    if (window.Swal) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonColor: '#d33'
        });
    } else {
        alert(message);
    }
}

// =========================== INITIALIZATION ===========================
$(document).ready(function() {

    navigateTo(restOfBaseUrl, false);

    // Inactivity timer (10 mins)
    let inactivityTimer;

    function resetInactivityTimer() {
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(logout, 600000);
    }

    ['load', 'mousemove', 'keypress', 'scroll', 'click', 'touchstart']
    .forEach(event => window.addEventListener(event, resetInactivityTimer));

    resetInactivityTimer();
});

// =========================== HISTORY HANDLING ===========================
window.onpopstate = function(event) {
    if (event.state && event.state.route !== undefined) {
        navigateTo(event.state.route, false);
    }
};

// =========================== VISIBILITY ===========================
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        // Optional refresh logic
    }
});

// =========================== ERROR HANDLERS ===========================
window.addEventListener('error', e => console.error(e.error));
window.addEventListener('unhandledrejection', e => console.error(e.reason));

console.log('SPA script loaded');
</script>
<script>
document.addEventListener('DOMContentLoaded', async () => {

    if (!window.Capacitor) return;

    const {
        App
    } = await import('@capacitor/app');

    let lastBack = 0;

    App.addListener('backButton', () => {

        // SPA navigation available → go back in history
        if (window.history.length > 1) {
            window.history.back();
            return;
        }

        // Home screen → double back to exit
        const now = Date.now();

        if (now - lastBack < 2000) {
            App.exitApp();
        } else {
            lastBack = now;
            showToast('Press back again to exit');
        }

    });

    async function showToast(msg) {
        try {
            const {
                Toast
            } = await import('@capacitor/toast');
            Toast.show({
                text: msg,
                duration: 'short'
            });
        } catch (e) {
            console.log(msg);
        }
    }

});
</script>