<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Class Routine Builder</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main text-sm btn-sm px-24 py-12 rounded-8" id="saveRoutineBtn">
                <i class="ph ph-floppy-disk me-8"></i>
                Save Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Filter Section Start -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Select Class</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-chalkboard-teacher"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="classSelect">
                            <option value="" selected disabled>Choose Class</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7">Class 7</option>
                            <option value="8">Class 8</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Number of Periods</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-clock"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="periodCount">
                            <option value="" selected disabled>Select Periods</option>
                            <option value="4">4 Periods</option>
                            <option value="5">5 Periods</option>
                            <option value="6">6 Periods</option>
                            <option value="7">7 Periods</option>
                            <option value="8">8 Periods</option>
                            <option value="9">9 Periods</option>
                            <option value="10">10 Periods</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Period Duration (minutes)</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-timer"></i></span>
                        <input type="number" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                            id="periodDuration" placeholder="e.g., 45" min="30" max="90" value="45">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Lunch Break After Period</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-fork-knife"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="lunchBreak">
                            <option value="" selected>No Lunch Break</option>
                            <option value="1">After Period 1</option>
                            <option value="2">After Period 2</option>
                            <option value="3">After Period 3</option>
                            <option value="4">After Period 4</option>
                            <option value="5">After Period 5</option>
                            <option value="6">After Period 6</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Lunch Duration (minutes)</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-coffee"></i></span>
                        <input type="number" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                            id="lunchDuration" placeholder="e.g., 30" min="15" max="60" value="30">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Start Time</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-clock-clockwise"></i></span>
                        <input type="time" class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                            id="startTime" value="08:00">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-gray-900">&nbsp;</label>
                    <button class="btn btn-main w-100 py-16 rounded-4" id="generateRoutineBtn">
                        <i class="ph ph-magic-wand me-8"></i>
                        Generate Routine Structure
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <!-- Routine Table Section Start -->
    <div class="card overflow-hidden">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">Weekly Class Routine</h6>
            <div class="flex-align gap-8 flex-wrap">
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-layout"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                        id="exportOptions">
                        <option value="" selected disabled>Export</option>
                        <option value="csv">CSV</option>
                        <option value="json">JSON</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive" id="routineTableContainer">
                <div class="text-center py-5">
                    <span class="text-lg"><i class="ph ph-calendar-blank text-gray-400"
                            style="font-size: 64px;"></i></span>
                    <p class="text-gray-400 mt-3">Please configure the settings above and click "Generate Routine
                        Structure" to create your routine.</p>
                </div>
            </div>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <div class="flex-align gap-8">
                <button class="btn btn-danger text-sm btn-sm px-24 py-12 rounded-8" id="clearRoutineBtn" disabled>
                    <i class="ph ph-trash me-8"></i>
                    Clear Routine
                </button>
            </div>
            <span class="text-gray-900" id="routineStats">Ready to build routine</span>
        </div>
    </div>
    <!-- Routine Table Section End -->

    <!-- Subject List Card Start -->
    <div class="card mt-24">
        <div class="card-header">
            <h6 class="text-lg mb-0">Available Subjects</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="flex-align flex-wrap gap-8" id="subjectBadges">
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Mathematics</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">English</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Science</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Social Studies</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Hindi</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Computer Science</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Physical Education</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Art & Craft</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Music</span>
                        <span class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill">Drawing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subject List Card End -->
</div>

<script>
$(document).ready(function() {
    // Global variables - Fixed subject list
    const subjects = ['Mathematics', 'English', 'Science', 'Social Studies', 'Hindi', 'Computer Science',
        'Physical Education', 'Art & Craft', 'Music', 'Drawing'
    ];
    let routine = {};
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    // Generate routine structure
    $('#generateRoutineBtn').on('click', function() {
        const classSelect = $('#classSelect').val();
        const periodCount = parseInt($('#periodCount').val());
        const periodDuration = parseInt($('#periodDuration').val());
        const lunchBreak = $('#lunchBreak').val();
        const lunchDuration = parseInt($('#lunchDuration').val());
        const startTime = $('#startTime').val();

        if (!classSelect || !periodCount) {
            alert('Please select class and number of periods');
            return;
        }

        generateRoutineTable(periodCount, periodDuration, lunchBreak, lunchDuration, startTime);
        $('#clearRoutineBtn').prop('disabled', false);
    });

    // Generate routine table
    function generateRoutineTable(periodCount, periodDuration, lunchBreak, lunchDuration, startTime) {
        let tableHTML = '<table class="table table-striped dataTable" id="routineTable"><thead><tr>';
        tableHTML += '<th class="h6 text-gray-300">Day</th>';

        // Calculate time for each period
        let currentTime = startTime;
        for (let i = 1; i <= periodCount; i++) {
            const endTime = addMinutes(currentTime, periodDuration);
            tableHTML +=
                `<th class="h6 text-gray-300">Period ${i}<br><small class="text-gray-200">${currentTime} - ${endTime}</small></th>`;
            currentTime = endTime;

            // Add lunch break column if applicable
            if (lunchBreak && parseInt(lunchBreak) === i) {
                const lunchEnd = addMinutes(currentTime, lunchDuration);
                tableHTML +=
                    `<th class="h6 text-gray-300 bg-warning-50">Lunch Break<br><small class="text-gray-200">${currentTime} - ${lunchEnd}</small></th>`;
                currentTime = lunchEnd;
            }
        }

        tableHTML += '</tr></thead><tbody>';

        // Generate rows for each day
        $.each(days, function(index, day) {
            tableHTML += `<tr><td><span class="h6 mb-0 fw-medium text-gray-300">${day}</span></td>`;

            for (let i = 1; i <= periodCount; i++) {
                tableHTML += `
                    <td>
                        <div class="period-cell" data-day="${day}" data-period="${i}">
                            <button class="btn btn-sm btn-outline-main w-100 py-5 px-5 text-10 add-period-btn">
                                <i class="ph ph-plus me-4"></i> Add Subject
                            </button>
                        </div>
                    </td>
                `;

                // Add lunch break cell if applicable
                if (lunchBreak && parseInt(lunchBreak) === i) {
                    tableHTML +=
                        '<td class="bg-warning-50 text-center"><span class="badge bg-warning-600 text-white py-8 px-16">Lunch</span></td>';
                }
            }

            tableHTML += '</tr>';
        });

        tableHTML += '</tbody></table>';

        $('#routineTableContainer').html(tableHTML);
        updateRoutineStats();
    }

    // Add subject to period - Using event delegation
    $(document).on('click', '.add-period-btn', function() {
        const $cell = $(this).closest('.period-cell');
        const day = $cell.data('day');
        const period = $cell.data('period');

        const selectHTML = `
            <div class="flex-align gap-4">
                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-12 subject-select" style="max-width: 110px;">
                    <option value="" selected>Select Subject</option>
                    ${subjects.map(subject => `<option value="${subject}">${subject}</option>`).join('')}
                </select>
                <button class="btn btn-sm btn-danger-50 text-danger-600 delete-period-btn p-5" title="Remove">
                    <i class="ph ph-trash"></i>
                </button>
            </div>
        `;

        $cell.html(selectHTML);
    });

    // Delete subject from period - Using event delegation
    $(document).on('click', '.delete-period-btn', function() {
        const $cell = $(this).closest('.period-cell');
        const day = $cell.data('day');
        const period = $cell.data('period');

        const addBtnHTML = `
            <button class="btn btn-sm btn-outline-main w-100 py-5 px-5 text-10 add-period-btn">
                <i class="ph ph-plus me-4"></i> Add Subject
            </button>
        `;

        $cell.html(addBtnHTML);
    });

    // Add minutes to time string
    function addMinutes(time, minutes) {
        const [hours, mins] = time.split(':').map(Number);
        const totalMinutes = hours * 60 + mins + minutes;
        const newHours = Math.floor(totalMinutes / 60) % 24;
        const newMins = totalMinutes % 60;
        return `${String(newHours).padStart(2, '0')}:${String(newMins).padStart(2, '0')}`;
    }

    // Update routine statistics
    function updateRoutineStats() {
        const periodCount = $('#periodCount').val();
        $('#routineStats').text(
            `${days.length} days × ${periodCount} periods = ${days.length * periodCount} total slots`);
    }

    // Clear routine
    $('#clearRoutineBtn').on('click', function() {
        if (confirm('Are you sure you want to clear the entire routine?')) {
            $('#routineTableContainer').html(`
                <div class="text-center py-5">
                    <span class="text-lg"><i class="ph ph-calendar-blank text-gray-400" style="font-size: 64px;"></i></span>
                    <p class="text-gray-400 mt-3">Please configure the settings above and click "Generate Routine Structure" to create your routine.</p>
                </div>
            `);
            $('#clearRoutineBtn').prop('disabled', true);
            $('#routineStats').text('Ready to build routine');
        }
    });

    // Save routine
    $('#saveRoutineBtn').on('click', function() {
        const routineData = {};
        let hasData = false;

        $('.period-cell').each(function() {
            const $cell = $(this);
            const day = $cell.data('day');
            const period = $cell.data('period');
            const $select = $cell.find('.subject-select');

            if ($select.length > 0) {
                const subject = $select.val();

                if (!routineData[day]) {
                    routineData[day] = {};
                }
                routineData[day][`period_${period}`] = subject || 'Empty';
                hasData = true;
            }
        });

        if (!hasData) {
            alert('Please generate a routine first!');
            return;
        }

        console.log('Routine Data:', routineData);
        alert('Routine saved successfully! Check console for data.');
    });

    // Export functionality
    $('#exportOptions').on('change', function() {
        const format = $(this).val();
        if (format) {
            alert(`Exporting routine as ${format.toUpperCase()}...`);
            $(this).val('');
        }
    });
});
</script>