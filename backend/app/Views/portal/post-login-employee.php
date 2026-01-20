<!-- Page Main Wrapper -->
<div id="app"></div>

<script>
// Global variables to track active plugins and instances
let activePlugins = {};
let pluginInstances = {};
let currentRoute = '';

// Plugin configuration - Add your plugins here
const pluginConfigs = {
    dataTable: {
        selector: 'table.display, .datatable, #assignmentTable, #reportCardTable',
        routes: ['dashboard', 'students', 'assignments', '*'], // * means all routes
        init: initDataTable,
        destroy: destroyDataTable
    },
    calendar: {
        selector: '.display, .calendar-widget',
        routes: ['dashboard', 'calendar'],
        init: initCalendar,
        destroy: destroyCalendar
    },
    charts: {
        selector: '#complete-course, #earned-certificate, #course-progress, #community-support, #doubleLineChart, #radialMultipleBar',
        routes: ['dashboard', 'analytics'],
        init: initCharts,
        destroy: destroyCharts
    },
    quillEditor: {
        selector: '.quill-editor, #editor',
        routes: ['compose', 'edit', 'blog'],
        init: initQuillEditor,
        destroy: destroyQuillEditor
    },
    fileUpload: {
        selector: '.file-upload, input[type="file"].upload',
        routes: ['upload', 'profile', 'assignments'],
        init: initFileUpload,
        destroy: destroyFileUpload
    },
    plyr: {
        selector: '.plyr, video, audio',
        routes: ['courses', 'media', 'lessons'],
        init: initPlyr,
        destroy: destroyPlyr
    },
    fullCalendar: {
        selector: '#full-calendar, .full-calendar',
        routes: ['calendar', 'schedule'],
        init: initFullCalendar,
        destroy: destroyFullCalendar
    },
    jqueryUI: {
        selector: '.ui-datepicker, .ui-sortable, .ui-draggable',
        routes: ['*'], // Available on all routes
        init: initJQueryUI,
        destroy: destroyJQueryUI
    },
    vectorMap: {
        selector: '#world-map, .vector-map',
        routes: ['analytics', 'reports'],
        init: initVectorMap,
        destroy: destroyVectorMap
    },
    exportOptions: {
        selector: '#exportOptions',
        routes: ['students', 'reports', 'data'],
        init: initExportOptions,
        destroy: destroyExportOptions
    }
};

// Custom configurations for specific routes
const customConfigs = {
    // Example: Different DataTable config for different routes
    dataTable: {
        'students': {
            pageLength: 25,
            order: [
                [0, 'asc']
            ],
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'status'
                }
            ]
        },
        'assignments': {
            pageLength: 10,
            order: [
                [2, 'desc']
            ],
            searching: true
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

// Simple function to reload main.js
function reloadMainJS() {
    // Remove existing script
    $('#mainJsScript').remove();

    // Add new script with cache buster
    $('<script>')
        .attr('id', 'mainJsScript')
        .attr('src', baseUrl + 'assets/js/main.js?v=' + Date.now())
        .appendTo('head');

    console.log('main.js reloaded');
}

// Enhanced navigateTo function
function navigateTo(route, push = true) {
    var storage = window.localStorage;
    var token = storage.getItem("authToken");
    var tokenCookie = Cookies.get("authToken");
    var authToken = token || tokenCookie;

    // Clean up current plugins before navigation
    cleanupAllPlugins();

    $.ajax({
        url: baseUrlOfApp + route,
        method: "POST",
        headers: {
            'Authorization': 'Bearer ' + authToken
        },
        success: function(data) {
            // Insert new content
            $("#app").html(data);

            // Update current route
            currentRoute = route;

            // Initialize plugins for this route
            initializePluginsForRoute(route);

            // Re-bind global event listeners
            bindGlobalEventListeners();

            // Update browser history
            if (push) {
                let newUrl = baseUrlOfApp + route;
                if (route === "") newUrl = baseUrlOfApp + "/";
                history.pushState({
                    route: route
                }, "", newUrl);
            }

            $('.preloader').hide();
            console.log(`Navigation complete: ${route}`);
        },
        error: function() {
            // Cookies.remove('authToken');
            // localStorage.removeItem('authToken');
            // window.location.href = baseUrl + "pre-login";
            alert("Error loading page. Please try again.");
        },
        complete: function() {
            $('.preloader').hide();
        }
    });
}

// Main function to initialize plugins for current route
function initializePluginsForRoute(route) {
    console.log(`Initializing plugins for route: ${route}`);

    Object.keys(pluginConfigs).forEach(pluginName => {
        const config = pluginConfigs[pluginName];

        // Check if plugin should be loaded for this route
        if (shouldLoadPlugin(config.routes, route)) {
            // Check if required elements exist
            const elements = document.querySelectorAll(config.selector);
            if (elements.length > 0) {
                console.log(`Loading plugin: ${pluginName}`);
                config.init(route);
                activePlugins[pluginName] = true;
            }
        }
    });
}

// Check if plugin should be loaded for given route
function shouldLoadPlugin(pluginRoutes, currentRoute) {
    if (pluginRoutes.includes('*')) return true;
    if (pluginRoutes.includes(currentRoute)) return true;

    // Check for wildcard patterns
    return pluginRoutes.some(pattern => {
        if (pattern.includes('*')) {
            const regex = new RegExp(pattern.replace(/\*/g, '.*'));
            return regex.test(currentRoute);
        }
        return false;
    });
}

// Clean up all active plugins
function cleanupAllPlugins() {
    Object.keys(activePlugins).forEach(pluginName => {
        if (activePlugins[pluginName] && pluginConfigs[pluginName]) {
            console.log(`Cleaning up plugin: ${pluginName}`);
            pluginConfigs[pluginName].destroy();
            activePlugins[pluginName] = false;
        }
    });
}

// Get custom config for plugin and route
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
        }
    };

    const config = customConfig ? {
        ...defaultConfig,
        ...customConfig
    } : defaultConfig;

    $('table.display, .datatable, #assignmentTable').each(function() {
        if (!$.fn.DataTable.isDataTable(this)) {
            const table = $(this).DataTable(config);
            if (!pluginInstances.dataTables) pluginInstances.dataTables = [];
            pluginInstances.dataTables.push(table);
        }
    });
}

function destroyDataTable() {
    if (pluginInstances.dataTables) {
        pluginInstances.dataTables.forEach(table => {
            if (table && typeof table.destroy === 'function') {
                table.destroy();
            }
        });
        pluginInstances.dataTables = [];
    }
}

function initCalendar(route) {
    if (document.querySelector('.display') && document.querySelector('.days')) {
        let display = document.querySelector(".display");
        let days = document.querySelector(".days");
        let previous = document.querySelector(".left");
        let next = document.querySelector(".right");

        if (previous && next) {
            // Store event handlers for cleanup
            const prevHandler = () => {
                days.innerHTML = "";
                if (month < 0) {
                    month = 11;
                    year = year - 1;
                }
                month = month - 1;
                date.setMonth(month);
                displayCalendar();
            };

            const nextHandler = () => {
                days.innerHTML = "";
                if (month > 11) {
                    month = 0;
                    year = year + 1;
                }
                month = month + 1;
                date.setMonth(month);
                displayCalendar();
            };

            previous.addEventListener("click", prevHandler);
            next.addEventListener("click", nextHandler);

            // Store handlers for cleanup
            pluginInstances.calendarHandlers = {
                prevHandler,
                nextHandler,
                previous,
                next
            };

            displayCalendar();
        }
    }
}

function destroyCalendar() {
    if (pluginInstances.calendarHandlers) {
        const {
            prevHandler,
            nextHandler,
            previous,
            next
        } = pluginInstances.calendarHandlers;
        if (previous && next) {
            previous.removeEventListener("click", prevHandler);
            next.removeEventListener("click", nextHandler);
        }
        pluginInstances.calendarHandlers = null;
    }
}

function initCharts(route) {
    // Initialize different charts based on elements present
    if (document.querySelector('#complete-course')) {
        createChart('complete-course', '#2FB2AB');
    }
    if (document.querySelector('#earned-certificate')) {
        createChart('earned-certificate', '#27CFA7');
    }
    if (document.querySelector('#course-progress')) {
        createChart('course-progress', '#6142FF');
    }
    if (document.querySelector('#community-support')) {
        createChart('community-support', '#FA902F');
    }
    if (document.querySelector('#doubleLineChart')) {
        createLineChart('doubleLineChart', '#27CFA7');
    }
    if (document.querySelector('#radialMultipleBar')) {
        createRadialChart();
    }
}

function destroyCharts() {
    // ApexCharts cleanup
    if (window.ApexCharts) {
        const chartElements = ['#complete-course', '#earned-certificate', '#course-progress',
            '#community-support', '#doubleLineChart', '#radialMultipleBar'
        ];

        chartElements.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                // ApexCharts stores chart instance in element
                if (element.chart) {
                    element.chart.destroy();
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
        if (!element.classList.contains('ql-container')) {
            const quill = new Quill(element, config);
            if (!pluginInstances.quillEditors) pluginInstances.quillEditors = [];
            pluginInstances.quillEditors.push(quill);
        }
    });
}

function destroyQuillEditor() {
    if (pluginInstances.quillEditors) {
        pluginInstances.quillEditors.forEach(quill => {
            if (quill && quill.container) {
                const toolbar = quill.container.previousSibling;
                if (toolbar && toolbar.classList.contains('ql-toolbar')) {
                    toolbar.remove();
                }
                quill.container.innerHTML = '';
            }
        });
        pluginInstances.quillEditors = [];
    }
}

function initFileUpload(route) {
    // Initialize your file upload plugin here
    document.querySelectorAll('.file-upload, input[type="file"].upload').forEach(element => {
        // Example file upload initialization
        element.addEventListener('change', handleFileUpload);
    });
}

function destroyFileUpload() {
    document.querySelectorAll('.file-upload, input[type="file"].upload').forEach(element => {
        element.removeEventListener('change', handleFileUpload);
    });
}

function handleFileUpload(event) {
    // Your file upload logic here
    console.log('File selected:', event.target.files);
}

function initPlyr(route) {
    const players = Plyr.setup('.plyr, video, audio');
    pluginInstances.plyrPlayers = players;
}

function destroyPlyr() {
    if (pluginInstances.plyrPlayers) {
        pluginInstances.plyrPlayers.forEach(player => {
            if (player && typeof player.destroy === 'function') {
                player.destroy();
            }
        });
        pluginInstances.plyrPlayers = [];
    }
}

function initFullCalendar(route) {
    $('#full-calendar, .full-calendar').each(function() {
        $(this).fullCalendar({
            // Your FullCalendar configuration
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            }
        });
    });
}

function destroyFullCalendar() {
    $('#full-calendar, .full-calendar').each(function() {
        if ($(this).hasClass('fc')) {
            $(this).fullCalendar('destroy');
        }
    });
}

function initJQueryUI(route) {
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
}

function destroyJQueryUI() {
    $('.ui-datepicker.hasDatepicker').datepicker('destroy');
    $('.ui-sortable').sortable('destroy');
    $('.ui-draggable').draggable('destroy');
}

function initVectorMap(route) {
    $('#world-map, .vector-map').each(function() {
        $(this).vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent'
        });
    });
}

function destroyVectorMap() {
    $('#world-map, .vector-map').each(function() {
        if ($(this).children('.jvectormap-container').length) {
            $(this).empty();
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
        pluginInstances.exportHandler = {
            element: exportElement,
            handler: exportHandler
        };
    }
}

function destroyExportOptions() {
    if (pluginInstances.exportHandler) {
        const {
            element,
            handler
        } = pluginInstances.exportHandler;
        if (element && handler) {
            element.removeEventListener('change', handler);
        }
        pluginInstances.exportHandler = null;
    }
}

// =========================== UTILITY FUNCTIONS ===========================

function bindGlobalEventListeners() {
    // Re-bind logout button
    $(document).off("click", "#logoutBtn").on("click", "#logoutBtn", logout);

    // Re-bind navigation links
    $(document).off("click", "a.nav_js, .nav_js").on("click", "a.nav_js, .nav_js", function(e) {
        e.preventDefault();
        $('.preloader').show();
        let route = $(this).attr("href") || $(this).data("route");
        if (route) {
            if (route == "/") route = "";
            navigateTo(route);
        }
    });
}

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
}
// =========================== INITIALIZATION ===========================
// Base URL Configuration - REQUIRED
const baseUrl = "<?=base_url()?>";
const baseUrlOfApp = window.location.href.split("post-login-employee/")[0] + "post-login-employee/";
const restOfBaseUrl = window.location.href.split("post-login-employee/")[1];

// Global variables for calendar
let date = new Date();
let year = date.getFullYear();
let month = date.getMonth();

// Document ready
$(document).ready(function() {
    var storage = window.localStorage;
    var token = storage.getItem("authToken");
    var tokenCookie = Cookies.get("authToken");

    if (!token && !tokenCookie) {
        window.location.href = baseUrl + "pre-login/";
        return;
    }

    let path = restOfBaseUrl || "";
    navigateTo(path, false);

    // Inactivity timer
    let inactivityTimer;

    function resetInactivityTimer() {
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(logout, 10000000);
    }

    ['load', 'mousemove', 'keypress', 'scroll', 'click', 'touchstart'].forEach(event => {
        window.addEventListener(event, resetInactivityTimer);
    });
});

function logout() {
    cleanupAllPlugins(); // Clean up before logout
    Cookies.remove('authToken');
    localStorage.removeItem('authToken');
    window.location.href = baseUrl + "pre-login";
}

// Handle browser back/forward
window.onpopstate = function(event) {
    if (event.state && event.state.route !== undefined) {
        navigateTo(event.state.route, false);
    }
};
</script>