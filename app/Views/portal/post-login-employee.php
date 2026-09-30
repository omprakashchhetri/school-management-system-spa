<!-- Page Main Wrapper -->
<div id="app"></div>

<script src="<?= base_url() ?>assets/js/spa-router.js"></script>
<script>
    SPARouter.init({
        portalSegment: 'post-login-employee',
        baseUrl: "<?= base_url() ?>",
        confirmLogout: false,
        warnBeforeLogout: false,
        errorConfirmColor: '#d33',
        exportFilenamePrefix: 'export',
        exportTableIds: ['assignmentTable'],
        chartConfigs: [
            { id: 'complete-course', color: '#2FB2AB', type: 'area' },
            { id: 'earned-certificate', color: '#27CFA7', type: 'area' },
            { id: 'course-progress', color: '#6142FF', type: 'area' },
            { id: 'community-support', color: '#FA902F', type: 'area' },
            { id: 'doubleLineChart', color: '#27CFA7', type: 'line' },
            { id: 'radialMultipleBar', color: null, type: 'radial' }
        ],
        pluginConfigs: {
            dataTable: {
                selector: 'table.display, .datatable, #assignmentTable, #reportCardTable, #documentsTable',
                routes: ['admin/dashboard', 'students', 'assignments', 'reports', '*'],
                priority: 1
            },
            fileUpload: {
                selector: '.fileUpload',
                routes: ['*'],
                priority: 2
            },
            calendar: {
                selector: '.display, .calendar-widget',
                routes: ['admin/dashboard', 'employee/dashboard', 'calendar'],
                priority: 3
            },
            charts: {
                selector: '#complete-course, #earned-certificate, #course-progress, #community-support, #doubleLineChart, #radialMultipleBar',
                routes: ['admin/dashboard', 'analytics'],
                priority: 4
            },
            quillEditor: {
                selector: '.quill-editor, #editor',
                routes: ['compose', 'edit', 'blog', 'create-admission', 'admission-create'],
                priority: 5
            },
            plyr: {
                selector: '.plyr, video, audio',
                routes: ['courses', 'media', 'lessons'],
                priority: 6
            },
            fullCalendar: {
                selector: '#full-calendar, .full-calendar',
                routes: ['calendar', 'schedule'],
                priority: 7
            },
            jqueryUI: {
                selector: '.ui-datepicker, .ui-sortable, .ui-draggable',
                routes: ['*'],
                priority: 8
            },
            vectorMap: {
                selector: '#world-map, .vector-map',
                routes: ['analytics', 'reports'],
                priority: 9
            },
            exportOptions: {
                selector: '#exportOptions',
                routes: ['students', 'reports', 'data'],
                priority: 10
            }
        },
        customConfigs: {
            dataTable: {
                'students': {
                    pageLength: 25,
                    order: [[0, 'asc']],
                    responsive: true
                },
                'assignments': {
                    pageLength: 10,
                    order: [[2, 'desc']],
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
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
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
        }
    });
</script>