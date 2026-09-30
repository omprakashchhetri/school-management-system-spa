<div class="dashboard-body">
    <div class="row gy-4">
        <div class="col-lg-9">
            <!-- Widgets Start -->
            <div class="row gy-4">
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= (int) $classes_today_count ?></h4>
                            <span class="text-gray-600">Classes Today</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                    <i class="ph-fill ph-book-open"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= (int) $assigned_classes_count ?></h4>
                            <span class="text-gray-600">Assigned Classes</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl">
                                    <i class="ph-fill ph-chalkboard-teacher"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= (int) $pending_documents_count ?></h4>
                            <span class="text-gray-600">Pending Documents</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                    <i class="ph-fill ph-clipboard-text"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2"><?= $attendance_rate !== null ? esc($attendance_rate) . '%' : 'N/A' ?></h4>
                            <span class="text-gray-600">My Attendance</span>
                            <div class="flex-between gap-8 mt-16">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-success-600 text-white text-2xl">
                                    <i class="ph-fill ph-check-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->

            <!-- Today's Schedule Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Today's Schedule</h4>
                        <span class="text-13 text-gray-600"><?= esc(date('l, F j, Y')) ?></span>
                    </div>

                    <div class="table-responsive">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Time</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($today_schedule)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-gray-600">No classes scheduled for today.</td>
                                </tr>
                                <?php else: ?>
                                <?php foreach ($today_schedule as $period):
                                    $statusClass = [
                                        'Completed' => 'bg-success-50 text-success-600',
                                        'In Progress' => 'bg-main-50 text-main-600',
                                        'Upcoming' => 'bg-gray-100 text-gray-600',
                                    ][$period['status']] ?? 'bg-gray-100 text-gray-600';
                                ?>
                                <tr>
                                    <td><?= esc($period['label'] ?? '—') ?></td>
                                    <td>
                                        <?= esc(!empty($period['start_time']) ? date('h:i A', strtotime($period['start_time'])) : '—') ?>
                                        <?= !empty($period['end_time']) ? ' - ' . esc(date('h:i A', strtotime($period['end_time']))) : '' ?>
                                    </td>
                                    <td><?= esc(trim(($period['class_name'] ?? '') . ' ' . ($period['section_label'] ?? '')) ?: '—') ?></td>
                                    <td><?= esc($period['subject_name'] ?? '—') ?></td>
                                    <td><span class="<?= $statusClass ?> py-2 px-10 rounded-pill text-13"><?= esc($period['status']) ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Today's Schedule End -->

            <!-- Subject Allocation Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">My Subject Allocation</h4>
                    </div>

                    <?php if (empty($subject_summary)): ?>
                    <div class="alert alert-info mb-0">No subjects allocated to you yet.</div>
                    <?php else: ?>
                    <div class="row g-20">
                        <?php foreach ($subject_summary as $subject): ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card border border-gray-100">
                                <div class="card-body p-16">
                                    <div class="flex-between gap-8 mb-16">
                                        <span
                                            class="text-main-600 bg-main-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0">
                                            <i class="ph-fill ph-book-open"></i>
                                        </span>
                                        <span class="text-13 py-2 px-10 rounded-pill bg-main-50 text-main-600">
                                            <?= count($subject['classes']) ?> <?= count($subject['classes']) === 1 ? 'Class' : 'Classes' ?>
                                        </span>
                                    </div>
                                    <h5 class="mb-8"><?= esc($subject['subject_name']) ?></h5>
                                    <p class="text-13 text-gray-600 mb-16">
                                        Classes: <?= esc(implode(', ', $subject['classes'])) ?: '—' ?>
                                    </p>

                                    <div class="flex-align gap-8 flex-wrap">
                                        <div class="flex-align gap-4">
                                            <span class="text-sm text-main-600 d-flex"><i
                                                    class="ph ph-calendar-blank"></i></span>
                                            <span class="text-13 text-gray-600"><?= (int) $subject['periods_per_week'] ?> periods/week</span>
                                        </div>
                                        <div class="flex-align gap-4">
                                            <span class="text-sm text-main-600 d-flex"><i
                                                    class="ph ph-users"></i></span>
                                            <span class="text-13 text-gray-600"><?= (int) $subject['student_count'] ?> Students</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Subject Allocation End -->
        </div>

        <div class="col-lg-3">
            <!-- Calendar Start -->
            <div class="card">
                <div class="card-body">
                    <div class="calendar">
                        <div class="calendar__header">
                            <button type="button" class="calendar__arrow left"><i class="ph ph-caret-left"></i></button>
                            <p class="display h6 mb-0"></p>
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

            <!-- Admin Notices Start -->
            <div class="card mt-24">
                <div class="card-body">
                    <div class="mb-20 flex-between flex-wrap gap-8">
                        <h4 class="mb-0">Admin Notices</h4>
                    </div>
                    <div class="alert alert-info mb-0">Notices aren't set up yet.</div>
                </div>
            </div>
            <!-- Admin Notices End -->
        </div>
    </div>
</div>
