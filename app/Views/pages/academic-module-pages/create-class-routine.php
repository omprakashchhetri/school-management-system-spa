<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="/post-login-employee/admin/dashboard" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
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
            <button class="btn btn-main text-sm btn-sm px-24 py-12 rounded-8" id="saveRoutineBtn" disabled>
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
                            <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>"><?= esc($class['class_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Select Section</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-users-three"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="sectionSelect">
                            <option value="" selected disabled>Choose Section</option>
                            <?php foreach ($sections as $section): ?>
                            <option value="<?= $section['id'] ?>"><?= esc($section['section_label']) ?></option>
                            <?php endforeach; ?>
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
</div>

<script id="routineSubjectsData" type="application/json"><?= json_encode($subjects) ?></script>
<script id="routineTeachersData" type="application/json"><?= json_encode(array_map(fn($t) => ['id' => $t['id'], 'name' => trim($t['firstname'] . ' ' . $t['lastname'])], $teachers)) ?></script>

<script>
$(function () {
    const subjects = JSON.parse(document.getElementById('routineSubjectsData').textContent);
    const teachers = JSON.parse(document.getElementById('routineTeachersData').textContent);
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const baseUrl = jQuery('#globalBaseUrl').val();

    function subjectOptions(selectedId) {
        let html = '<option value="">Subject</option>';
        subjects.forEach(s => {
            html += `<option value="${s.id}" ${String(s.id) === String(selectedId) ? 'selected' : ''}>${s.subject_name}</option>`;
        });
        return html;
    }

    function teacherOptions(selectedId) {
        let html = '<option value="">Teacher</option>';
        teachers.forEach(t => {
            html += `<option value="${t.id}" ${String(t.id) === String(selectedId) ? 'selected' : ''}>${t.name}</option>`;
        });
        return html;
    }

    function addMinutes(time, minutes) {
        const [hours, mins] = time.split(':').map(Number);
        const totalMinutes = hours * 60 + mins + minutes;
        const newHours = Math.floor(totalMinutes / 60) % 24;
        const newMins = totalMinutes % 60;
        return `${String(newHours).padStart(2, '0')}:${String(newMins).padStart(2, '0')}`;
    }

    function cellHtml(day, period, subjectId, teacherId) {
        return `
            <div class="period-cell" data-day="${day}" data-period="${period}">
                <select class="form-control py-6 px-8 border border-gray-100 rounded-4 text-11 subject-select mb-4">
                    ${subjectOptions(subjectId)}
                </select>
                <select class="form-control py-6 px-8 border border-gray-100 rounded-4 text-11 teacher-select">
                    ${teacherOptions(teacherId)}
                </select>
            </div>
        `;
    }

    function generateRoutineTable(periodCount, periodDuration, lunchBreak, lunchDuration, startTime, existingGrid) {
        existingGrid = existingGrid || {};
        let tableHTML = '<table class="table table-striped" id="routineTable"><thead><tr>';
        tableHTML += '<th class="h6 text-gray-300">Day</th>';

        let currentTime = startTime;
        for (let i = 1; i <= periodCount; i++) {
            const endTime = addMinutes(currentTime, periodDuration);
            tableHTML += `<th class="h6 text-gray-300">Period ${i}<br><small class="text-gray-200">${currentTime} - ${endTime}</small></th>`;
            currentTime = endTime;

            if (lunchBreak && parseInt(lunchBreak) === i) {
                const lunchEnd = addMinutes(currentTime, lunchDuration);
                tableHTML += `<th class="h6 text-gray-300 bg-warning-50">Lunch Break<br><small class="text-gray-200">${currentTime} - ${lunchEnd}</small></th>`;
                currentTime = lunchEnd;
            }
        }

        tableHTML += '</tr></thead><tbody>';

        days.forEach(day => {
            tableHTML += `<tr><td><span class="h6 mb-0 fw-medium text-gray-300">${day}</span></td>`;

            for (let i = 1; i <= periodCount; i++) {
                const existing = (existingGrid[day] || {})[i];
                tableHTML += `<td>${cellHtml(day, i, existing ? existing.subject_id : '', existing ? existing.teacher_id : '')}</td>`;

                if (lunchBreak && parseInt(lunchBreak) === i) {
                    tableHTML += '<td class="bg-warning-50 text-center"><span class="badge bg-warning-600 text-white py-8 px-16">Lunch</span></td>';
                }
            }

            tableHTML += '</tr>';
        });

        tableHTML += '</tbody></table>';

        $('#routineTableContainer').html(tableHTML);
        $('#clearRoutineBtn, #saveRoutineBtn').prop('disabled', false);
        updateRoutineStats();
    }

    function updateRoutineStats() {
        const periodCount = $('#periodCount').val();
        $('#routineStats').text(`${days.length} days x ${periodCount} periods = ${days.length * periodCount} total slots`);
    }

    $('#generateRoutineBtn').on('click', function () {
        const classId = $('#classSelect').val();
        const sectionId = $('#sectionSelect').val();
        const periodCount = parseInt($('#periodCount').val());
        const periodDuration = parseInt($('#periodDuration').val());
        const lunchBreak = $('#lunchBreak').val();
        const lunchDuration = parseInt($('#lunchDuration').val());
        const startTime = $('#startTime').val();

        if (!classId || !sectionId || !periodCount) {
            alert('Please select class, section, and number of periods');
            return;
        }

        // Prefill with any existing routine already saved for this class+section.
        $.ajax({
            url: baseUrl + 'post-login-employee/academic/get-class-routine',
            type: 'POST',
            data: { class_id: classId, section_id: sectionId },
            success: function (res) {
                res = JSON.parse(res);
                const existingGrid = {};
                if (res.has_routine) {
                    Object.keys(res.grid || {}).forEach(day => {
                        existingGrid[day] = {};
                        Object.keys(res.grid[day]).forEach(period => {
                            existingGrid[day][period] = {
                                subject_id: res.grid[day][period].subject_id,
                                teacher_id: res.grid[day][period].teacher_id,
                            };
                        });
                    });
                }
                generateRoutineTable(periodCount, periodDuration, lunchBreak, lunchDuration, startTime, existingGrid);
            },
            error: function () {
                generateRoutineTable(periodCount, periodDuration, lunchBreak, lunchDuration, startTime, {});
            }
        });
    });

    $('#clearRoutineBtn').on('click', function () {
        if (confirm('Are you sure you want to clear the entire routine?')) {
            $('#routineTableContainer').html(`
                <div class="text-center py-5">
                    <span class="text-lg"><i class="ph ph-calendar-blank text-gray-400" style="font-size: 64px;"></i></span>
                    <p class="text-gray-400 mt-3">Please configure the settings above and click "Generate Routine Structure" to create your routine.</p>
                </div>
            `);
            $('#clearRoutineBtn, #saveRoutineBtn').prop('disabled', true);
            $('#routineStats').text('Ready to build routine');
        }
    });

    $('#saveRoutineBtn').on('click', function () {
        const classId = $('#classSelect').val();
        const sectionId = $('#sectionSelect').val();

        const entries = [];
        $('.period-cell').each(function () {
            const $cell = $(this);
            const subject = $cell.find('.subject-select').val();
            const teacher = $cell.find('.teacher-select').val();
            if (subject && teacher) {
                entries.push({ day: $cell.data('day'), period: $cell.data('period'), subject, teacher });
            }
        });

        if (entries.length === 0) {
            alert('Fill in at least one period (subject + teacher) before saving.');
            return;
        }

        $('.preloader').show();
        $.ajax({
            url: baseUrl + 'post-login-employee/academic/save-class-routine',
            type: 'POST',
            data: {
                class_id: classId,
                section_id: sectionId,
                period_config: {
                    period_count: $('#periodCount').val(),
                    period_duration: $('#periodDuration').val(),
                    lunch_after: $('#lunchBreak').val(),
                    lunch_duration: $('#lunchDuration').val(),
                    start_time: $('#startTime').val(),
                },
                entries: entries,
            },
            success: function (res) {
                res = JSON.parse(res);
                alert(res.message || res.error);
            },
            error: function () {
                alert('Failed to save routine.');
            },
            complete: function () {
                $('.preloader').hide();
            }
        });
    });

    $('#exportOptions').on('change', function () {
        const format = $(this).val();
        if (!format) return;

        const classId = $('#classSelect option:selected').text();
        const sectionId = $('#sectionSelect option:selected').text();
        const rows = [];
        $('#routineTable tbody tr').each(function () {
            const day = $(this).find('td').first().text().trim();
            $(this).find('.period-cell').each(function () {
                const subject = $(this).find('.subject-select option:selected').text();
                const teacher = $(this).find('.teacher-select option:selected').text();
                if (subject && subject !== 'Subject') {
                    rows.push({ day, period: $(this).data('period'), subject, teacher });
                }
            });
        });

        let blob, filename;
        if (format === 'json') {
            blob = new Blob([JSON.stringify(rows, null, 2)], { type: 'application/json' });
            filename = `routine-${classId}-${sectionId}.json`;
        } else {
            const header = 'Day,Period,Subject,Teacher\n';
            const csv = rows.map(r => `${r.day},${r.period},${r.subject},${r.teacher}`).join('\n');
            blob = new Blob([header + csv], { type: 'text/csv' });
            filename = `routine-${classId}-${sectionId}.csv`;
        }

        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        link.click();
        URL.revokeObjectURL(link.href);

        $(this).val('');
    });
});
</script>
