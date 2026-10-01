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
                    <span class="text-main-600 fw-normal text-15">View Class Routine</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-outline-main text-sm btn-sm px-24 py-12 rounded-8" id="printRoutineBtn">
                <i class="ph ph-printer me-8"></i>
                Print Routine
            </button>
            <button class="nav_js btn btn-main text-sm btn-sm px-24 py-12 rounded-8" data-route="academic/create-class-routine">
                <i class="ph ph-calendar-plus me-8"></i>
                Add Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Filter Section Start -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3 align-items-end">
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
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                            id="sectionSelect">
                            <option value="" selected disabled>Choose Section</option>
                            <?php foreach ($sections as $section): ?>
                            <option value="<?= $section['id'] ?>"><?= esc($section['section_label']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-main w-100 py-16 rounded-4" id="viewRoutineBtn">
                        <i class="ph ph-magnifying-glass me-8"></i>
                        View Routine
                    </button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-main w-100 py-16 rounded-4" id="resetRoutineBtn">
                        <i class="ph ph-arrows-clockwise me-8"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <div id="routineContent">
        <div class="card">
            <div class="card-body text-center py-5">
                <span class="text-lg"><i class="ph ph-calendar-blank text-gray-400" style="font-size: 64px;"></i></span>
                <p class="text-gray-400 mt-3">Select a class and section, then click "View Routine".</p>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
    const baseUrl = jQuery('#globalBaseUrl').val();
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    function emptyState(message) {
        return `
            <div class="card">
                <div class="card-body text-center py-5">
                    <span class="text-lg"><i class="ph ph-calendar-blank text-gray-400" style="font-size: 64px;"></i></span>
                    <p class="text-gray-400 mt-3">${message}</p>
                </div>
            </div>
        `;
    }

    function renderRoutine(data, classLabel, sectionLabel) {
        const periods = data.periods || [];

        if (!data.has_routine || periods.length === 0) {
            $('#routineContent').html(emptyState(
                `No routine has been set up yet for ${classLabel} - Section ${sectionLabel}. Click "Add Routine" to create one.`
            ));
            return;
        }

        let html = '<div class="card mb-24"><div class="card-body"><div class="row g-3">';
        html += `
            <div class="col-md-4">
                <div class="flex-align gap-8">
                    <div class="w-44 h-44 flex-center bg-main-50 rounded-circle"><i class="ph ph-chalkboard-teacher text-main-600 text-xl"></i></div>
                    <div><span class="text-gray-400 text-sm">Class</span><h6 class="mb-0">${classLabel} - Section ${sectionLabel}</h6></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flex-align gap-8">
                    <div class="w-44 h-44 flex-center bg-success-50 rounded-circle"><i class="ph ph-clock text-success-600 text-xl"></i></div>
                    <div><span class="text-gray-400 text-sm">Total Periods</span><h6 class="mb-0">${periods.length} Periods/Day</h6></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="flex-align gap-8">
                    <div class="w-44 h-44 flex-center bg-info-50 rounded-circle"><i class="ph ph-calendar text-info-600 text-xl"></i></div>
                    <div><span class="text-gray-400 text-sm">Class Teacher</span><h6 class="mb-0">${data.class_teacher ? data.class_teacher : 'Not assigned'}</h6></div>
                </div>
            </div>
        `;
        html += '</div></div></div>';

        html += '<div class="card overflow-hidden"><div class="card-header"><h6 class="text-lg mb-0">Weekly Class Routine</h6></div>';
        html += '<div class="card-body p-0"><div class="table-responsive px-4"><table class="table table-striped mb-0" id="routineViewTable"><thead><tr>';
        html += '<th class="h6 text-gray-300 bg-main-50">Day</th>';
        periods.forEach((p, i) => {
            html += `<th class="h6 text-gray-300">${p.label}<br><small class="text-gray-200 fw-normal">${p.start_time.slice(0, 5)} - ${p.end_time.slice(0, 5)}</small></th>`;
        });
        html += '</tr></thead><tbody>';

        days.forEach(day => {
            html += `<tr><td class="bg-main-50"><span class="h6 mb-0 fw-semibold text-main-600">${day}</span></td>`;
            periods.forEach((p, i) => {
                const cell = (data.grid[day] || {})[i + 1];
                if (cell) {
                    html += `<td><div class="text-center py-2"><span class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">${cell.subject_name || '-'}</span><p class="text-xs text-gray-400 mb-0 mt-1">${cell.teacher_name || ''}</p></div></td>`;
                } else {
                    html += '<td><div class="text-center py-2 text-gray-300">&mdash;</div></td>';
                }
            });
            html += '</tr>';
        });

        html += '</tbody></table></div></div>';

        if (data.last_updated) {
            html += `<div class="card-footer"><div class="flex-between flex-wrap gap-8">
                ${data.class_teacher ? `<div class="text-gray-600"><i class="ph ph-info me-4"></i><span class="text-sm">Class Teacher: <strong>${data.class_teacher}</strong>${data.class_teacher_contact ? ' | Contact: <strong>' + data.class_teacher_contact + '</strong>' : ''}</span></div>` : '<div></div>'}
                <div class="text-gray-600 text-sm">Last Updated: <strong>${data.last_updated}</strong></div>
            </div></div>`;
        }

        html += '</div>';

        $('#routineContent').html(html);
    }

    $('#viewRoutineBtn').on('click', function () {
        const classId = $('#classSelect').val();
        const sectionId = $('#sectionSelect').val();

        if (!classId || !sectionId) {
            alert('Please select both a class and a section');
            return;
        }

        const classLabel = $('#classSelect option:selected').text();
        const sectionLabel = $('#sectionSelect option:selected').text();

        $('.preloader').show();
        $.ajax({
            url: baseUrl + 'post-login-employee/academic/get-class-routine',
            type: 'POST',
            data: { class_id: classId, section_id: sectionId },
            success: function (res) {
                renderRoutine(JSON.parse(res), classLabel, sectionLabel);
            },
            error: function () {
                $('#routineContent').html(emptyState('Something went wrong loading this routine. Please try again.'));
            },
            complete: function () {
                $('.preloader').hide();
            }
        });
    });

    $('#resetRoutineBtn').on('click', function () {
        $('#classSelect, #sectionSelect').prop('selectedIndex', 0);
        $('#routineContent').html(emptyState('Select a class and section, then click "View Routine".'));
    });

    $('#printRoutineBtn').on('click', function () {
        window.print();
    });
});
</script>
