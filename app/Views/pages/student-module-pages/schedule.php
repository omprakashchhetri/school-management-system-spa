<?php
/**
 * View: pages/student-module-pages/schedule.php
 *
 * Variables:
 *   $schedule – rows from StudentsController::getStudentSchedule()
 *               (day, label, start_time, end_time, subject_name, firstname, lastname)
 */

$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

$byDay = array_fill_keys($days, []);
foreach ($schedule as $period) {
    if (isset($byDay[$period['day']])) {
        $byDay[$period['day']][] = $period;
    }
}

$today = date('l');
?>

<div class="dashboard-body">

    <!-- ── Breadcrumb ────────────────────────────────────────────── -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-0">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?= base_url('post-login-student/dashboard') ?>"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Class Schedule</span></li>
            </ul>
        </div>
    </div>

    <?php if (empty($schedule)): ?>
        <div class="card">
            <div class="card-body text-center py-60 text-gray-400">
                <i class="ph ph-calendar-blank" style="font-size:3rem;"></i>
                <p class="mt-12 mb-0 text-16 fw-medium">No timetable has been set for your class yet.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="row gy-4">
            <?php foreach ($days as $day): ?>
                <div class="col-lg-6">
                    <div class="card h-100<?= $day === $today ? ' border border-main-600' : '' ?>">
                        <div class="card-header border-bottom border-gray-100 flex-between gap-8">
                            <h5 class="mb-0"><?= esc($day) ?></h5>
                            <?php if ($day === $today): ?>
                                <span class="text-13 py-2 px-8 bg-main-50 text-main-600 rounded-pill">Today</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if (empty($byDay[$day])): ?>
                                <p class="text-13 text-gray-500 mb-0">No classes.</p>
                            <?php else: ?>
                                <?php foreach ($byDay[$day] as $period): ?>
                                    <div class="event-item bg-gray-50 rounded-8 p-16 mb-12">
                                        <div class="flex-between gap-4">
                                            <div class="flex-align gap-8">
                                                <span class="icon d-flex w-44 h-44 bg-white rounded-8 flex-center text-2xl"><i
                                                        class="ph ph-book-open"></i></span>
                                                <div>
                                                    <h6 class="mb-2"><?= esc($period['subject_name'] ?? '-') ?></h6>
                                                    <span class="text-13">
                                                        <?= esc($period['start_time'] ? date('h:i A', strtotime($period['start_time'])) : '') ?>
                                                        -
                                                        <?= esc($period['end_time'] ? date('h:i A', strtotime($period['end_time'])) : '') ?>
                                                        &middot; <?= esc(trim(($period['firstname'] ?? '') . ' ' . ($period['lastname'] ?? '')) ?: '-') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
