<?php
/**
 * View: attendance-list.php
 *
 * Variables:
 * $attendance
 * $summary
 */

function attendanceBadge(string $status): array
{
    return match (strtolower($status)) {
        'present' => ['bg-success-50 text-success-600', 'bg-success-600', 'Present'],
        'absent' => ['bg-danger-50 text-danger-600', 'bg-danger-600', 'Absent'],
        'late' => ['bg-warning-50 text-warning-600', 'bg-warning-600', 'Late'],
        default => ['bg-secondary-50 text-secondary-600', 'bg-secondary-600', 'Unknown'],
    };
}

$page = max(1, (int) (service('request')->getGet('attendance_page') ?? 1));
$from = (($page - 1) * 20) + 1;
$to = min($page * 20, $attendance['total']);
?>

<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-0">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?= base_url('student/dashboard') ?>"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">
                        Home
                    </a>
                </li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Attendance</span></li>
            </ul>
        </div>
    </div>

    <!-- SUMMARY CARDS -->

    <div class="row gy-4 mb-24">

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-main-50">
                <span class="text-white bg-main-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-calendar"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $summary['total'] ?></h4>
                    <span class="fw-medium text-main-600 text-14">Total Days</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-success-50">
                <span class="text-white bg-success-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-check-circle"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $summary['present'] ?></h4>
                    <span class="fw-medium text-success-600 text-14">Present</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-danger-50">
                <span class="text-white bg-danger-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-x-circle"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $summary['absent'] ?></h4>
                    <span class="fw-medium text-danger-600 text-14">Absent</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-warning-50">
                <span class="text-white bg-warning-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-percent"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $summary['percentage'] ?>%</h4>
                    <span class="fw-medium text-warning-600 text-14">Attendance %</span>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE -->

    <div class="card overflow-hidden">
        <div class="card-body p-0">

            <?php if (empty($attendance['rows'])): ?>

                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-calendar-blank" style="font-size:3rem;"></i>
                    <p class="mt-12 text-16 fw-medium">No attendance records found.</p>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Type</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($attendance['rows'] as $row):
                                [$badgeBg, $dotBg, $label] = attendanceBadge($row['status']);
                                ?>

                                <tr>

                                    <td class="fw-medium">
                                        <?= date('d M Y', strtotime($row['date'])) ?>
                                    </td>

                                    <td>
                                        <?= date('l', strtotime($row['date'])) ?>
                                    </td>

                                    <td>
                                        <span
                                            class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">
                                            <span class="w-6 h-6 <?= $dotBg ?> rounded-circle"></span>
                                            <?= $label ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= !empty($row['punch_in']) ? date('h:i A', strtotime($row['punch_in'])) : '–' ?>
                                    </td>

                                    <td>
                                        <?= !empty($row['punch_out']) ? date('h:i A', strtotime($row['punch_out'])) : '–' ?>
                                    </td>

                                    <td>
                                        <?= esc(ucfirst($row['attendance_type'] ?? '–')) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            <?php endif; ?>

        </div>

        <?php if (!empty($attendance['rows'])): ?>

            <div class="card-footer flex-between flex-wrap gap-8 py-16 px-24">

                <span class="text-gray-900 text-14">
                    Showing <strong><?= $from ?></strong>–<strong><?= $to ?></strong>
                    of <strong><?= $attendance['total'] ?></strong>
                </span>

                <?= $attendance['pager'] ?>

            </div>

        <?php endif; ?>

    </div>

</div>