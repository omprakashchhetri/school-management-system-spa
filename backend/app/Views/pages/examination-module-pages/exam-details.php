<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?=('employee/dashboard') ?>"
                        class="nav_js text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <a href="<?=('examination/exam-list') ?>"
                        class="nav_js text-gray-200 fw-normal text-15 hover-text-main-600">Examinations</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Exam Details</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-outline-main text-sm btn-sm px-10 py-8 rounded-8 text-sm" id="editExamBtn">
                <i class="ph ph-pencil me-8"></i>
                Edit Routine
            </button>
            <button class="btn btn-danger text-sm btn-sm px-10 py-8 rounded-8 text-sm" id="deleteExamBtn">
                <i class="ph ph-trash me-8"></i>
                Delete Exam
            </button>
            <button class="btn btn-main text-sm btn-sm px-10 py-8 rounded-8 text-sm" id="printRoutineBtn">
                <i class="ph ph-printer me-8"></i>
                Print Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Exam Information Card Start -->
    <div class="card mb-24">
        <div class="card-header">
            <h6 class="text-lg mb-0">Examination Information</h6>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="mb-0">
                        <label class="text-gray-600 text-sm mb-8">Exam Title</label>
                        <h6 class="text-gray-900 mb-0" id="examTitle">-</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-0">
                        <label class="text-gray-600 text-sm mb-8">Start Date</label>
                        <h6 class="text-gray-900 mb-0" id="examStartDate">-</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-0">
                        <label class="text-gray-600 text-sm mb-8">End Date</label>
                        <h6 class="text-gray-900 mb-0" id="examEndDate">-</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-0">
                        <label class="text-gray-600 text-sm mb-8">Total Items</label>
                        <h6 class="text-gray-900 mb-0" id="totalItems">-</h6>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-0">
                        <label class="text-gray-600 text-sm mb-8">Description</label>
                        <p class="text-gray-900 mb-0" id="examDescription">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Exam Information Card End -->

    <!-- Statistics Cards Start -->
    <div class="row g-3 mb-24">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Total Dates</span>
                            <h5 class="text-gray-900 mb-0" id="statTotalDates">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-main-50 rounded-circle flex-center">
                            <i class="ph ph-calendar text-main-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Total Classes</span>
                            <h5 class="text-gray-900 mb-0" id="statTotalClasses">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-success-50 rounded-circle flex-center">
                            <i class="ph ph-users-three text-success-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Total Subjects</span>
                            <h5 class="text-gray-900 mb-0" id="statTotalSubjects">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-warning-50 rounded-circle flex-center">
                            <i class="ph ph-book-open text-warning-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Duration (Days)</span>
                            <h5 class="text-gray-900 mb-0" id="statDuration">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-purple-50 rounded-circle flex-center">
                            <i class="ph ph-clock text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistics Cards End -->

    <!-- Exam Routine Table Start -->
    <div class="card overflow-hidden">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">Examination Routine</h6>
            <div class="flex-align gap-8 flex-wrap">
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-funnel"></i></span>
                    <select class="form-control ps-8 pe-20 py-12 border-0 text-inherit rounded-4 text-sm"
                        id="filterClass">
                        <option value="">All Classes</option>
                        <!-- Will be populated dynamically -->
                    </select>
                </div>
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-layout"></i></span>
                    <select class="form-control ps-8 pe-20 py-12 border-0 text-inherit rounded-4 text-sm" id="viewMode">
                        <option value="grid">Grid View</option>
                        <option value="list">List View</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <!-- Grid View -->
            <div id="gridView" class="table-responsive">
                <table class="table table-hover mb-0" id="routineTableGrid">
                    <thead class="bg-main-50">
                        <tr>
                            <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 130px;">Date</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Day</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Time</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Max Marks</th>
                            <!-- Class columns will be added dynamically -->
                        </tr>
                    </thead>
                    <tbody id="routineTableBodyGrid">
                        <tr>
                            <td colspan="20" class="text-center py-32">
                                <i class="ph ph-spinner ph-spin text-gray-300" style="font-size: 48px;"></i>
                                <p class="text-gray-500 mt-8 mb-0">Loading exam routine...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- List View -->
            <div id="listView" class="table-responsive" style="display: none;">
                <table class="table table-hover mb-0" id="routineTableList">
                    <thead class="bg-main-50">
                        <tr>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">#</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Date & Time</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Class</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Subject</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Max Marks</th>
                        </tr>
                    </thead>
                    <tbody id="routineTableBodyList">
                        <tr>
                            <td colspan="5" class="text-center py-32">
                                <i class="ph ph-spinner ph-spin text-gray-300" style="font-size: 48px;"></i>
                                <p class="text-gray-500 mt-8 mb-0">Loading exam routine...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Exam Routine Table End -->
</div>

<script>
$(document).ready(function() {
    const examId = <?= $examDetails['exam']['id'] ?? 0 ?>;
    let examData = null;
    let examItems = [];
    let classes = [];
    let subjects = [];

    // Load initial data
    loadExamDetails();

    // Load exam details
    function loadExamDetails() {
        $.ajax({
            url: baseUrl + 'post-login-employee/data/examination/get-exam-details',
            method: 'POST',
            dataType: 'json',
            data: {
                exam_id: examId
            },
            success: function(response) {
                if (response.error) {
                    showToast(response.error, 'error');
                    return;
                }

                examData = response.exam;
                examItems = response.exam.exam_items || [];
                classes = response.classes || [];
                subjects = response.subjects || [];

                displayExamInfo();
                displayStatistics();
                populateClassFilter();
                renderRoutineGrid();
                renderRoutineList();
            },
            error: function(xhr, status, error) {
                console.error('Error loading exam details:', error);
                showToast('Error loading exam details', 'error');
            }
        });
    }

    // Display exam information
    function displayExamInfo() {
        $('#examTitle').text(examData.exam_title);
        $('#examStartDate').text(formatDate(examData.exam_startdate));
        $('#examEndDate').text(formatDate(examData.exam_enddate));
        $('#examDescription').text(examData.exam_description || 'No description provided');
        $('#totalItems').text(examItems.length);
    }

    // Display statistics
    function displayStatistics() {
        // Get unique dates
        const uniqueDates = [...new Set(examItems.map(item => item.exam_date))];
        $('#statTotalDates').text(uniqueDates.length);

        // Get unique classes
        const uniqueClasses = [...new Set(examItems.map(item => item.related_class))];
        $('#statTotalClasses').text(uniqueClasses.length);

        // Get unique subjects
        const uniqueSubjects = [...new Set(examItems.map(item => item.related_subject))];
        $('#statTotalSubjects').text(uniqueSubjects.length);

        // Calculate duration
        const startDate = new Date(examData.exam_startdate);
        const endDate = new Date(examData.exam_enddate);
        const duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        $('#statDuration').text(duration);
    }

    // Populate class filter
    function populateClassFilter() {
        let options = '<option value="">All Classes</option>';
        classes.forEach(function(cls) {
            options += `<option value="${cls.id}">${cls.class_name}</option>`;
        });
        $('#filterClass').html(options);
    }

    // Render routine in grid view
    function renderRoutineGrid() {
        // Build header with class columns
        let headerHtml = `
            <tr>
                <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 130px;">Date</th>
                <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Day</th>
                <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Time</th>
                <th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Max Marks</th>
        `;

        classes.forEach(function(cls) {
            headerHtml +=
                `<th class="px-24 py-16 text-gray-900 fw-semibold" style="min-width: 150px;">${cls.class_name}</th>`;
        });

        headerHtml += `</tr>`;
        $('#routineTableGrid thead').html(headerHtml);

        // Group items by date, time, and marks
        const grouped = {};
        examItems.forEach(item => {
            const key = `${item.exam_date}_${item.exam_time}_${item.max_marks}`;
            if (!grouped[key]) {
                grouped[key] = {
                    exam_date: item.exam_date,
                    exam_time: item.exam_time,
                    max_marks: item.max_marks,
                    subjects: {}
                };
            }
            grouped[key].subjects[item.related_class] = {
                subject_id: item.related_subject,
                subject_name: item.subject_name
            };
        });

        // Convert to array and sort
        const rows = Object.values(grouped).sort((a, b) => {
            const dateCompare = new Date(a.exam_date) - new Date(b.exam_date);
            if (dateCompare !== 0) return dateCompare;
            return a.exam_time.localeCompare(b.exam_time);
        });

        if (rows.length === 0) {
            const colspan = 4 + classes.length;
            $('#routineTableBodyGrid').html(`
                <tr>
                    <td colspan="${colspan}" class="text-center py-32">
                        <i class="ph ph-calendar-x text-gray-300" style="font-size: 48px;"></i>
                        <p class="text-gray-500 mt-8 mb-0">No routine items found</p>
                    </td>
                </tr>
            `);
            return;
        }

        let html = '';
        rows.forEach(function(row) {
            const date = new Date(row.exam_date);
            const dayName = date.toLocaleDateString('en-US', {
                weekday: 'long'
            });
            const formattedDate = date.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit',
                year: 'numeric'
            });

            html += `<tr>`;
            html +=
                `<td class="px-24 py-16"><span class="fw-medium text-gray-900">${formattedDate}</span></td>`;
            html += `<td class="px-24 py-16"><span class="text-gray-600">${dayName}</span></td>`;
            html +=
                `<td class="px-24 py-16"><span class="text-gray-600"><i class="ph ph-clock me-4"></i>${formatTime(row.exam_time)}</span></td>`;
            html += `<td class="px-24 py-16"><span class="text-gray-900">${row.max_marks}</span></td>`;

            // Subject cells for each class
            classes.forEach(function(cls) {
                const subjectData = row.subjects[cls.id];
                if (subjectData) {
                    html += `<td class="px-24 py-16">
                        <span class="badge bg-success-50 text-success-600 px-16 py-8">
                            ${subjectData.subject_name}
                        </span>
                    </td>`;
                } else {
                    html += `<td class="px-24 py-16">
                        <span class="text-gray-400 text-sm">No Exam</span>
                    </td>`;
                }
            });

            html += `</tr>`;
        });

        $('#routineTableBodyGrid').html(html);
    }

    // Render routine in list view
    function renderRoutineList() {
        if (examItems.length === 0) {
            $('#routineTableBodyList').html(`
                <tr>
                    <td colspan="5" class="text-center py-32">
                        <i class="ph ph-calendar-x text-gray-300" style="font-size: 48px;"></i>
                        <p class="text-gray-500 mt-8 mb-0">No routine items found</p>
                    </td>
                </tr>
            `);
            return;
        }

        // Sort items
        const sortedItems = [...examItems].sort((a, b) => {
            const dateCompare = new Date(a.exam_date) - new Date(b.exam_date);
            if (dateCompare !== 0) return dateCompare;
            const timeCompare = a.exam_time.localeCompare(b.exam_time);
            if (timeCompare !== 0) return timeCompare;
            return a.class_name.localeCompare(b.class_name);
        });

        let html = '';
        sortedItems.forEach(function(item, index) {
            const date = new Date(item.exam_date);
            const formattedDate = date.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit',
                year: 'numeric',
                weekday: 'short'
            });

            html += `
                <tr>
                    <td class="px-24 py-16">${index + 1}</td>
                    <td class="px-24 py-16">
                        <div class="fw-medium text-gray-900">${formattedDate}</div>
                        <div class="text-gray-600 text-sm mt-4">
                            <i class="ph ph-clock me-4"></i>${formatTime(item.exam_time)}
                        </div>
                    </td>
                    <td class="px-24 py-16">
                        <span class="badge bg-main-50 text-main-600 px-16 py-8">
                            ${item.class_name}
                        </span>
                    </td>
                    <td class="px-24 py-16">
                        <span class="text-gray-900">${item.subject_name}</span>
                    </td>
                    <td class="px-24 py-16">
                        <span class="text-gray-900">${item.max_marks}</span>
                    </td>
                </tr>
            `;
        });

        $('#routineTableBodyList').html(html);
    }

    // View mode toggle
    $('#viewMode').change(function() {
        const mode = $(this).val();
        if (mode === 'grid') {
            $('#gridView').show();
            $('#listView').hide();
        } else {
            $('#gridView').hide();
            $('#listView').show();
        }
    });

    // Class filter
    $('#filterClass').change(function() {
        const classId = $(this).val();

        if (!classId) {
            // Show all
            renderRoutineList();
            return;
        }

        // Filter items by class
        const filteredItems = examItems.filter(item => item.related_class == classId);

        // Temporarily replace examItems for rendering
        const originalItems = examItems;
        examItems = filteredItems;
        renderRoutineList();
        examItems = originalItems;
    });

    // Edit button
    $('#editExamBtn').click(function() {
        navigateTo('examination/edit-exam-routine/' + examId);
    });

    // Delete button
    $('#deleteExamBtn').click(function() {
        if (confirm(
                'Are you sure you want to delete this exam and all its routine items? This action cannot be undone.'
            )) {
            $(this).prop('disabled', true).html(
                '<i class="ph ph-spinner ph-spin me-8"></i>Deleting...');

            $.ajax({
                url: baseUrl + 'post-login-employee/data/examination/delete-exam',
                method: 'POST',
                dataType: 'json',
                data: {
                    exam_id: examId
                },
                success: function(response) {
                    if (response.error) {
                        showToast(response.error, 'error');
                    } else {
                        showToast(response.message || 'Exam deleted successfully',
                            'success');
                        setTimeout(function() {
                            navigateTo('examination/exam-list');
                        }, 500);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting exam:', error);
                    showToast('Failed to delete exam', 'error');
                },
                complete: function() {
                    $('#deleteExamBtn').prop('disabled', false).html(
                        '<i class="ph ph-trash me-8"></i>Delete Exam');
                }
            });
        }
    });

    // Print button
    $('#printRoutineBtn').click(function() {
        // window.print();
    });

    // Helper functions
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', {
            month: 'short',
            day: '2-digit',
            year: 'numeric'
        });
    }

    function formatTime(time24) {
        const [hours, minutes] = time24.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const hour12 = hour % 12 || 12;
        return `${hour12}:${minutes} ${ampm}`;
    }

    function showToast(message, type = 'info') {
        if (typeof toastr !== 'undefined') {
            toastr[type](message);
        } else {
            alert(message);
        }
    }
});
</script>