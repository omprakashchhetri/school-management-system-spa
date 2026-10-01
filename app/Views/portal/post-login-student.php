<!-- Page Main Wrapper -->
<div id="app"></div>

<!-- Bootstrap Bundle Js is already loaded once by templates/header-student -->
<!-- Phosphor Js -->
<script src="<?= base_url() ?>assets/js/phosphor-icon.js"></script>
<!-- File Upload -->
<script src="<?= base_url() ?>assets/js/file-upload.js"></script>
<!-- Plyr -->
<script src="<?= base_url() ?>assets/js/plyr.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<!-- Full Calendar -->
<script src="<?= base_url() ?>assets/js/full-calendar.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- Editor Quill -->
<script src="<?= base_url() ?>assets/js/editor-quill.js"></script>
<!-- Apex Charts -->
<script src="<?= base_url() ?>assets/js/apexcharts.min.js"></script>
<!-- jVectorMap -->
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-2.0.5.min.js"></script>
<!-- jVectorMap World -->
<script src="<?= base_url() ?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- Main JS -->
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script src="<?= base_url() ?>assets/js/spa-router.js"></script>
<script>
    SPARouter.init({
        portalSegment: 'post-login-student',
        baseUrl: "<?= base_url() ?>",
        confirmLogout: true,
        warnBeforeLogout: true,
        errorConfirmColor: '#487FFF',
        exportFilenamePrefix: 'student_export',
        exportTableIds: ['assignmentTable', 'gradesTable', 'attendanceTable'],
        chartConfigs: [
            { id: 'complete-course', color: '#2FB2AB', type: 'area' },
            { id: 'earned-certificate', color: '#27CFA7', type: 'area' },
            { id: 'course-progress', color: '#6142FF', type: 'area' },
            { id: 'community-support', color: '#FA902F', type: 'area' },
            { id: 'performanceChart', color: '#3D7FF9', type: 'area' },
            { id: 'attendanceChart', color: '#27CFA7', type: 'area' },
            { id: 'doubleLineChart', color: '#27CFA7', type: 'line' },
            { id: 'radialMultipleBar', color: null, type: 'radial' }
        ],
        pluginConfigs: {
            dataTable: {
                selector: 'table.display, .datatable, #assignmentTable, #reportCardTable, #documentsTable, #gradesTable, #attendanceTable',
                routes: ['dashboard', 'student/assignments', 'student/grades', 'student/attendance', 'student/schedule', '*'],
                priority: 1
            },
            fileUpload: {
                selector: '.fileUpload',
                routes: ['*'],
                priority: 2
            },
            calendar: {
                selector: '.display, .calendar-widget',
                routes: ['dashboard', 'student/calendar', 'student/schedule'],
                priority: 3
            },
            charts: {
                selector: '#complete-course, #earned-certificate, #course-progress, #community-support, #doubleLineChart, #radialMultipleBar, #performanceChart, #attendanceChart',
                routes: ['dashboard', 'student/analytics', 'student/performance'],
                priority: 4
            },
            quillEditor: {
                selector: '.quill-editor, #editor',
                routes: ['student/assignments', 'student/submit', 'student/notes'],
                priority: 5
            },
            plyr: {
                selector: '.plyr, video, audio',
                routes: ['student/courses', 'student/media', 'student/lessons', 'student/library'],
                priority: 6
            },
            fullCalendar: {
                selector: '#full-calendar, .full-calendar',
                routes: ['student/calendar', 'student/schedule', 'student/events'],
                priority: 7
            },
            jqueryUI: {
                selector: '.ui-datepicker, .ui-sortable, .ui-draggable',
                routes: ['*'],
                priority: 8
            },
            vectorMap: {
                selector: '#world-map, .vector-map',
                routes: ['student/analytics', 'student/reports'],
                priority: 9
            },
            exportOptions: {
                selector: '#exportOptions',
                routes: ['student/grades', 'student/reports', 'student/attendance'],
                priority: 10
            }
        },
        customConfigs: {
            dataTable: {
                'student/assignments': {
                    pageLength: 10,
                    order: [[2, 'desc']],
                    responsive: true
                },
                'student/grades': {
                    pageLength: 25,
                    order: [[0, 'asc']],
                    responsive: true
                },
                'student/attendance': {
                    pageLength: 15,
                    order: [[1, 'desc']],
                    responsive: true
                }
            },
            quillEditor: {
                'student/assignments': {
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
                'student/notes': {
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