<div class="dashboard-body">
    <div class="row gy-4">
        <div class="col-lg-9">
            <!-- Grettings Box Start -->
            <div class="grettings-box position-relative rounded-16 bg-main-600 overflow-hidden gap-16 flex-wrap z-1">
                <img src="<?=base_url()?>assets/images/bg/grettings-pattern.png" alt=""
                    class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 opacity-6" />
                <div class="row gy-4">
                    <div class="col-sm-7">
                        <div class="grettings-box__content py-xl-4">
                            <h2 class="text-white mb-0">Hello, <?= esc($studentData['firstname']) ?>!</h2>
                            <p class="text-15 fw-light mt-4 text-white">
                                Class <?= esc(trim(($studentData['class_name'] ?? '-') . ' ' . ($studentData['section_label'] ?? ''))) ?>
                            </p>
                            <p class="text-lg fw-light mt-24 text-white">
                                Attendance: <?= esc($attendanceSummary['percentage']) ?>% &middot;
                                Assignments pending: <?= esc($assignmentStats['pending']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 d-sm-block d-none">
                        <div class="text-center h-100 d-flex justify-content-center align-items-end">
                            <img src="<?=base_url()?>assets/images/thumbs/gretting-img.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grettings Box End -->

            <!-- Attendance Trend Card Start -->
            <div class="card mt-24 overflow-hidden">
                <div class="card-header">
                    <div class="mb-0 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Attendance (last 6 months)</h4>
                        <div class="flex-align flex-wrap gap-16">
                            <div class="flex-align flex-wrap gap-8">
                                <span class="w-8 h-8 rounded-circle bg-main-two-600"></span>
                                <span class="text-13 text-gray-600">Present</span>
                            </div>
                            <div class="flex-align flex-wrap gap-8">
                                <span class="w-8 h-8 rounded-circle bg-main-two-200"></span>
                                <span class="text-13 text-gray-600">Absent</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="doubleLineChart" class="tooltip-style y-value-left"></div>
                </div>
            </div>
            <!-- Attendance Trend Card End -->

            <!-- Table Start -->
            <div class="card mt-24 overflow-hidden">
                <div class="card-header">
                    <div class="mb-0 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Your Assignments</h4>
                        <a href="assignments"
                            class="text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-x-auto scroll-sm scroll-sm-horizontal">
                    <?php if (empty($assignments['rows'])): ?>
                        <p class="text-gray-600 mb-0 p-16">No assignments yet.</p>
                    <?php else: ?>
                        <table class="table style-two mb-0">
                            <thead>
                                <tr>
                                    <th>Subject / Topic</th>
                                    <th>Deadline</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assignments['rows'] as $assignment): ?>
                                    <?php
                                        $statusStyles = [
                                            'submitted' => ['bg-success-50', 'text-success-600', 'bg-success-600', 'Submitted'],
                                            'overdue'   => ['bg-danger-50', 'text-danger-600', 'bg-danger-600', 'Overdue'],
                                            'pending'   => ['bg-warning-50', 'text-warning-600', 'bg-warning-600', 'Pending'],
                                        ];
                                        [$badgeBg, $badgeText, $dotBg, $badgeLabel] = $statusStyles[$assignment['status']] ?? $statusStyles['pending'];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="flex-align gap-8">
                                                <div class="w-40 h-40 rounded-circle bg-main-600 flex-center flex-shrink-0 text-white">
                                                    <i class="ph ph-notebook"></i>
                                                </div>
                                                <div class="">
                                                    <h6 class="mb-0"><?= esc($assignment['topic']) ?></h6>
                                                    <div class="table-list">
                                                        <span class="text-13 text-gray-600"><?= esc($assignment['subject_name'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-13 text-gray-600">
                                                <?= esc(date('d M Y', strtotime($assignment['deadline_date']))) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="flex-align justify-content-center gap-16">
                                                <span
                                                    class="text-13 py-2 px-8 <?= $badgeBg ?> <?= $badgeText ?> d-inline-flex align-items-center gap-8 rounded-pill">
                                                    <span class="w-6 h-6 <?= $dotBg ?> rounded-circle flex-shrink-0"></span>
                                                    <?= $badgeLabel ?>
                                                </span>
                                                <a href="assignment/<?= esc($assignment['id']) ?>"
                                                    class="text-gray-900 hover-text-main-600 text-md d-flex"><i
                                                        class="ph ph-caret-right"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Table End -->
        </div>
        <div class="col-lg-3">
            <!-- Calendar Start -->
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <p class="display h6 mb-0">""</p>
                            <button type="button" class="calendar__arrow right">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>

                        <div class="calendar__week week">
                            <div class="calendar__week-text">Su</div>
                            <div class="calendar__week-text">Mo</div>
                            <div class="calendar__week-text">Tu</div>
                            <div class="calendar__week-text">We</div>
                            <div class="calendar__week-text">Th</div>
                            <div class="calendar__week-text">Fr</div>
                            <div class="calendar__week-text">Sa</div>
                        </div>
                        <div class="days"></div>
                    </div>

                    <!-- Today's classes start -->
                    <div class="">
                        <div class="mt-24 mb-8">
                            <div class="flex-align mb-8 gap-16">
                                <span class="text-sm text-gray-300 flex-shrink-0">Today's Classes</span>
                                <span class="border border-gray-50 border-dashed flex-grow-1"></span>
                            </div>

                            <?php if (empty($todaySchedule)): ?>
                                <p class="text-13 text-gray-600 mb-0">No classes scheduled today.</p>
                            <?php else: ?>
                                <?php foreach ($todaySchedule as $period): ?>
                                    <div class="event-item bg-gray-50 rounded-8 p-16 mb-12">
                                        <div class="flex-between gap-4">
                                            <div class="flex-align gap-8">
                                                <span class="icon d-flex w-44 h-44 bg-white rounded-8 flex-center text-2xl"><i
                                                        class="ph ph-book-open"></i></span>
                                                <div class="">
                                                    <h6 class="mb-2"><?= esc($period['subject_name'] ?? '-') ?></h6>
                                                    <span class="text-13">
                                                        <?= esc($period['start_time'] ? date('h:i A', strtotime($period['start_time'])) : '') ?>
                                                        -
                                                        <?= esc($period['end_time'] ? date('h:i A', strtotime($period['end_time'])) : '') ?>
                                                        &middot; <?= esc(trim(($period['firstname'] ?? '') . ' ' . ($period['lastname'] ?? ''))) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Today's classes end -->
                </div>
            </div>
            <!-- Calendar End -->

            <!-- Attendance Breakdown Card Start -->
            <div class="card mt-24">
                <div class="card-header border-bottom border-gray-100 flex-between gap-8 flex-wrap">
                    <h5 class="mb-0">Attendance Overview</h5>
                </div>
                <div class="card-body">
                    <div class="flex-center">
                        <div id="radialMultipleBar" class="w-auto d-inline-block"></div>
                    </div>

                    <div class="flex-between gap-8 flex-wrap mt-24">
                        <div class="flex-align flex-column">
                            <span class="w-12 h-12 bg-white border border-3 border-main-600 rounded-circle"></span>
                            <span class="text-13 my-4 text-main-600">Present</span>
                            <h6 class="mb-0"><?= esc($attendanceSummary['present']) ?></h6>
                        </div>
                        <div class="flex-align flex-column">
                            <span class="w-12 h-12 bg-white border border-3 border-main-two-600 rounded-circle"></span>
                            <span class="text-13 my-4 text-main-two-600">Absent</span>
                            <h6 class="mb-0"><?= esc($attendanceSummary['absent']) ?></h6>
                        </div>
                        <div class="flex-align flex-column">
                            <span class="w-12 h-12 bg-white border border-3 border-warning-600 rounded-circle"></span>
                            <span class="text-13 my-4 text-warning-600">Late</span>
                            <h6 class="mb-0"><?= esc($attendanceSummary['late']) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Attendance Breakdown Card End -->

            <!-- Fees Summary card Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Fees</h4>
                        <a href="fees"
                            class="text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                    <div
                        class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                        <div class="flex-align flex-wrap gap-8">
                            <span
                                class="text-success-600 bg-success-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i
                                    class="ph-fill ph-check-circle"></i></span>
                            <div>
                                <h6 class="mb-0">Paid</h6>
                                <span class="text-13 text-gray-500 fw-medium"><?= esc($feeStats['paid']) ?> cycle(s)</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                        <div class="flex-align flex-wrap gap-8">
                            <span
                                class="text-warning-600 bg-warning-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i
                                    class="ph-fill ph-clock"></i></span>
                            <div>
                                <h6 class="mb-0">Pending</h6>
                                <span class="text-13 text-gray-500 fw-medium"><?= esc($feeStats['pending']) ?> cycle(s)</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1">
                        <div class="flex-align flex-wrap gap-8">
                            <span
                                class="text-danger-600 bg-danger-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i
                                    class="ph-fill ph-warning-circle"></i></span>
                            <div>
                                <h6 class="mb-0">Overdue</h6>
                                <span class="text-13 text-gray-500 fw-medium"><?= esc($feeStats['overdue']) ?> cycle(s)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fees Summary card End -->
        </div>
    </div>
</div>

<script>
    // Real numbers for the doubleLineChart / radialMultipleBar widgets
    // above, read by createLineChart()/createRadialChart() in
    // spa-router.js. Only this page defines chart ids by these names, so
    // this can't affect any other route's charts.
    window.dashboardData = {
        charts: {
            doubleLineChart: {
                categories: <?= json_encode($attendanceMonthly['categories']) ?>,
                series: [
                    { name: 'Present', data: <?= json_encode($attendanceMonthly['present']) ?> },
                    { name: 'Absent', data: <?= json_encode($attendanceMonthly['absent']) ?> }
                ]
            },
            radialMultipleBar: {
                series: <?= json_encode([
                    $attendanceSummary['total'] > 0 ? round($attendanceSummary['present'] / $attendanceSummary['total'] * 100) : 0,
                    $attendanceSummary['total'] > 0 ? round($attendanceSummary['absent'] / $attendanceSummary['total'] * 100) : 0,
                ]) ?>,
                labels: ['Present', 'Absent']
            }
        }
    };
</script>
