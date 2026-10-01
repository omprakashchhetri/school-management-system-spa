<div class="dashboard-body">
    <div class="row gy-4">
        <div class="col-lg-9">
            <!-- Widgets Start -->
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= esc(number_format($totalStudents)) ?></h4>
                            <span class="text-gray-600">Total Students</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i
                                        class="ph-fill ph-users-three"></i></span>
                                <div id="community-support" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= esc(number_format($totalTeachers)) ?></h4>
                            <span class="text-gray-600">Total Teachers</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i
                                        class="ph-fill ph-book-open"></i></span>
                                <div id="complete-course" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= esc(number_format($totalClasses)) ?></h4>
                            <span class="text-gray-600">Total Classes</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i
                                        class="ph-fill ph-certificate"></i></span>
                                <div id="earned-certificate" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">₹<?= esc(number_format($totalDues, 2)) ?></h4>
                            <span class="text-gray-600">Total Dues</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl">
                                    <i class="ph-fill ph-money"></i></span>
                                <div id="course-progress" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Widgets End -->

            <!-- Top Course Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Fees: Generated vs Collected (last 6 months)</h4>
                        <div class="flex-align gap-16 flex-wrap">
                            <div class="flex-align flex-wrap gap-16">
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="w-8 h-8 rounded-circle bg-main-600"></span>
                                    <span class="text-13 text-gray-600">Generated</span>
                                </div>
                                <div class="flex-align flex-wrap gap-8">
                                    <span class="w-8 h-8 rounded-circle bg-main-two-600"></span>
                                    <span class="text-13 text-gray-600">Collected</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="doubleLineChart" class="tooltip-style y-value-left"></div>

                </div>
            </div>
            <!-- Fees Chart End -->

            <!-- Top Course Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Recent Admissions</h4>
                        <a href="student/list" class="nav_js
                            text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>

                    <?php if (empty($recentAdmissions)): ?>
                        <p class="text-gray-600 mb-0">No students admitted yet.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Admission Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentAdmissions as $student): ?>
                                        <tr>
                                            <td><?= esc(trim($student['firstname'] . ' ' . $student['lastname'])) ?></td>
                                            <td><?= esc(trim(($student['class_label'] ?? '-') . ' ' . ($student['section_label'] ?? ''))) ?></td>
                                            <td><?= esc($student['admission_date'] ? date('d M Y', strtotime($student['admission_date'])) : date('d M Y', strtotime($student['created_at']))) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Recent Admissions End -->
        </div>

        <div class="col-lg-3">
            <!-- Calendar Start -->
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left"><i class="ph ph-caret-left"></i></button>
                            <p class="display h6 mb-0">""</p>
                            <button type="button" class="calendar__arrow right"><i
                                    class="ph ph-caret-right"></i></button>
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
                </div>
            </div>
            <!-- Calendar End -->

            <!-- Pending Dues Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Pending Fee Dues</h4>
                        <a href="fees/fees-payments" class="nav_js
                            text-13 fw-medium text-main-600 hover-text-decoration-underline">See All</a>
                    </div>
                    <?php if (empty($pendingDues)): ?>
                        <p class="text-gray-600 mb-0">No outstanding dues.</p>
                    <?php else: ?>
                        <?php foreach ($pendingDues as $due): ?>
                            <?php
                                $daysLeft = (int) floor((strtotime($due['due_date']) - strtotime(date('Y-m-d'))) / 86400);
                                $dueLabel = $daysLeft < 0
                                    ? abs($daysLeft) . ' day' . (abs($daysLeft) === 1 ? '' : 's') . ' overdue'
                                    : ($daysLeft === 0 ? 'Due today' : 'Due in ' . $daysLeft . ' day' . ($daysLeft === 1 ? '' : 's'));
                            ?>
                            <div
                                class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                                <div class="flex-align flex-wrap gap-8">
                                    <span
                                        class="text-main-600 bg-main-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i
                                            class="ph-fill ph-money"></i></span>
                                    <div>
                                        <h6 class="mb-0"><?= esc(trim($due['firstname'] . ' ' . $due['lastname'])) ?></h6>
                                        <span class="text-13 text-gray-400">₹<?= esc(number_format((float) $due['outstanding'], 2)) ?> &middot; <?= esc($dueLabel) ?></span>
                                    </div>
                                </div>
                                <a href="fees/fees-payments" class="nav_js text-gray-900 hover-text-main-600"><i
                                        class="ph ph-caret-right"></i></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Pending Dues End -->

            <!-- Attendance Today Start -->
            <div class="card mt-24">
                <div class="card-header border-bottom border-gray-100">
                    <h5 class="mb-0">Today's Attendance</h5>
                </div>
                <div class="card-body">
                    <div id="radialMultipleBar"></div>

                    <div class="">
                        <h6 class="text-lg mb-16 text-center"> <span class="text-gray-400">Marked so far:</span> <?= esc($attendanceToday['totalToday']) ?></h6>
                        <div class="flex-between gap-8 flex-wrap">
                            <div class="flex-align flex-column">
                                <h6 class="mb-6"><?= esc($attendanceToday['present']) ?></h6>
                                <span class="w-30 h-3 rounded-pill bg-main-600"></span>
                                <span class="text-13 mt-6 text-gray-600">Present</span>
                            </div>
                            <div class="flex-align flex-column">
                                <h6 class="mb-6"><?= esc($attendanceToday['absent']) ?></h6>
                                <span class="w-30 h-3 rounded-pill bg-main-two-600"></span>
                                <span class="text-13 mt-6 text-gray-600">Absent</span>
                            </div>
                            <div class="flex-align flex-column">
                                <h6 class="mb-6"><?= esc($attendanceToday['notMarked']) ?></h6>
                                <span class="w-30 h-3 rounded-pill bg-gray-500"></span>
                                <span class="text-13 mt-6 text-gray-600">Not Marked</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Attendance Today End -->
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
                categories: <?= json_encode($feesChart['categories']) ?>,
                series: [
                    { name: 'Generated', data: <?= json_encode($feesChart['generated']) ?> },
                    { name: 'Collected', data: <?= json_encode($feesChart['collected']) ?> }
                ]
            },
            radialMultipleBar: {
                series: <?= json_encode([
                    $attendanceToday['totalToday'] > 0 ? round($attendanceToday['present'] / $attendanceToday['totalToday'] * 100) : 0,
                    $attendanceToday['totalToday'] > 0 ? round($attendanceToday['absent'] / $attendanceToday['totalToday'] * 100) : 0,
                ]) ?>,
                labels: ['Present', 'Absent']
            }
        }
    };
</script>