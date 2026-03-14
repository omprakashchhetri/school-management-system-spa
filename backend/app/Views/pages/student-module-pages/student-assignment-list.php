<?php
/**
 * View: assignment-list.php
 *
 * Variables:
 * $assignments
 * $stats
 * $subjects
 */

function assignmentBadge(string $status): array
{
    return match ($status) {
        'submitted' => ['bg-success-50 text-success-600', 'bg-success-600', 'Submitted'],
        'overdue' => ['bg-danger-50 text-danger-600', 'bg-danger-600', 'Overdue'],
        default => ['bg-warning-50 text-warning-600', 'bg-warning-600', 'Pending'],
    };
}

$request = service('request');

$page = max(1, (int) ($request->getGet('assignment_page') ?? 1));
$from = (($page - 1) * 15) + 1;
$to = min($page * 15, $assignments['total']);

$currentSubject = $request->getGet('assignment_subject') ?? 'all';
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

                <li>
                    <span class="text-gray-500 fw-normal d-flex">
                        <i class="ph ph-caret-right"></i>
                    </span>
                </li>

                <li>
                    <span class="text-main-600 fw-normal text-15">
                        Assignments
                    </span>
                </li>
            </ul>
        </div>

        <!-- SUBJECT FILTER -->

        <form method="GET">

            <div class="flex-align gap-8">

                <select name="assignment_subject" class="form-control form-select py-10" onchange="this.form.submit()">

                    <option value="all">All Subjects</option>

                    <?php foreach ($subjects as $s): ?>

                        <option value="<?= $s['id'] ?>" <?= $currentSubject == $s['id'] ? 'selected' : '' ?>>

                            <?= esc($s['subject_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </form>

    </div>

    <!-- SUMMARY CARDS -->

    <div class="row gy-4 mb-24">

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-main-50">
                <span class="text-white bg-main-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-files"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $stats['total'] ?></h4>
                    <span class="fw-medium text-main-600 text-14">Total Assignments</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-success-50">
                <span class="text-white bg-success-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-check-circle"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $stats['submitted'] ?></h4>
                    <span class="fw-medium text-success-600 text-14">Submitted</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-warning-50">
                <span class="text-white bg-warning-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-clock"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $stats['pending'] ?></h4>
                    <span class="fw-medium text-warning-600 text-14">Pending</span>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-danger-50">
                <span class="text-white bg-danger-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-warning"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $stats['overdue'] ?></h4>
                    <span class="fw-medium text-danger-600 text-14">Overdue</span>
                </div>
            </div>
        </div>

    </div>

    <!-- ASSIGNMENT TABLE -->

    <div class="card overflow-hidden">

        <div class="card-body p-0">

            <?php if (empty($assignments['rows'])): ?>

                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-files" style="font-size:3rem;"></i>
                    <p class="mt-12 text-16 fw-medium">No assignments available.</p>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">

                            <tr>
                                <th>Subject</th>
                                <th>Assignment</th>
                                <th>Assigned</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($assignments['rows'] as $row):
                                [$badgeBg, $dotBg, $label] = assignmentBadge($row['status']);
                                ?>

                                <tr>

                                    <td class="fw-medium text-dark">
                                        <?= esc($row['subject_name']) ?>
                                    </td>

                                    <td class="fw-medium text-gray-300">
                                        <?= esc($row['topic']) ?>
                                    </td>

                                    <td>
                                        <?= date('d M Y', strtotime($row['assigned_date'])) ?>
                                    </td>

                                    <td class="<?= $row['status'] == 'overdue' ? 'text-danger fw-semibold' : '' ?>">
                                        <?= date('d M Y', strtotime($row['deadline_date'])) ?>
                                    </td>

                                    <td>

                                        <span
                                            class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">

                                            <span class="w-6 h-6 <?= $dotBg ?> rounded-circle"></span>

                                            <?= $label ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?php if (!empty($row['marks'])): ?>

                                            <?= $row['marks'] ?>             <?= !empty($row['grade']) ? '(' . $row['grade'] . ')' : '' ?>

                                        <?php else: ?>

                                            <span class="text-muted">–</span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a href="assignment/<?= $row['id'] ?>"
                                            class="btn btn-main py-4 px-10 text-13">

                                            <i class="ph ph-eye me-4"></i>
                                            View

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endif; ?>

        </div>

        <?php if (!empty($assignments['rows'])): ?>

            <div class="card-footer flex-between flex-wrap gap-8 py-16 px-24">

                <span class="text-gray-900 text-14">
                    Showing <strong><?= $from ?></strong>–<strong><?= $to ?></strong>
                    of <strong><?= $assignments['total'] ?></strong>
                    assignment(s)
                </span>

                <?= $assignments['pager'] ?>

            </div>

        <?php endif; ?>

    </div>

</div>