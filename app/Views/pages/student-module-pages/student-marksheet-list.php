<?php
/**
 * Variables:
 * $marksheets
 * $stats
 */

$request = service('request');
$currentExam = $request->getGet('exam_id') ?? 'all';

$page = max(1, (int) ($request->getGet('marksheet_page') ?? 1));
$from = (($page - 1) * 10) + 1;
$to = min($page * 10, $marksheets['total']);
?>

<div class="dashboard-body">

    <!-- Breadcrumb + Filter -->

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
                        Marksheets
                    </span>
                </li>

            </ul>
        </div>

        <form method="GET">

            <select name="exam_id" class="form-control form-select py-10" onchange="this.form.submit()">

                <option value="all">All Exams</option>

                <?php foreach ($stats['exams'] as $exam): ?>

                    <option value="<?= $exam['id'] ?>" <?= $currentExam == $exam['id'] ? 'selected' : '' ?>>

                        <?= esc($exam['exam_title']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </form>

    </div>


    <!-- COUNTERS -->

    <div class="row gy-4 mb-24">

        <div class="col-xxl-3 col-sm-6">

            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-main-50">

                <span class="text-white bg-main-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-clipboard-text"></i>
                </span>

                <div>
                    <h4 class="mb-0">
                        <?= $stats['total'] ?>
                    </h4>
                    <span class="fw-medium text-main-600 text-14">
                        Total Exams
                    </span>
                </div>

            </div>

        </div>


        <div class="col-xxl-3 col-sm-6">

            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-success-50">

                <span class="text-white bg-success-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-percent"></i>
                </span>

                <div>
                    <h4 class="mb-0">
                        <?= $stats['average'] ?>%
                    </h4>
                    <span class="fw-medium text-success-600 text-14">
                        Average Score
                    </span>
                </div>

            </div>

        </div>


        <div class="col-xxl-3 col-sm-6">

            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-info-50">

                <span class="text-white bg-info-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-trophy"></i>
                </span>

                <div>
                    <h4 class="mb-0">
                        <?= $stats['highest'] ?>%
                    </h4>
                    <span class="fw-medium text-info-600 text-14">
                        Highest Score
                    </span>
                </div>

            </div>

        </div>


        <div class="col-xxl-3 col-sm-6">

            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-warning-50">

                <span class="text-white bg-warning-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-chart-line"></i>
                </span>

                <div>
                    <h4 class="mb-0">
                        <?= $stats['latest'] ?>%
                    </h4>
                    <span class="fw-medium text-warning-600 text-14">
                        Latest Exam
                    </span>
                </div>

            </div>

        </div>

    </div>


    <!-- TABLE -->

    <div class="card overflow-hidden">

        <div class="card-body p-0">

            <?php if (empty($marksheets['rows'])): ?>

                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-clipboard-text" style="font-size:3rem;"></i>
                    <p class="mt-12 text-16 fw-medium">
                        No marksheets available.
                    </p>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">

                            <tr>
                                <th>Exam</th>
                                <th>Exam Dates</th>
                                <th>Percentage</th>
                                <th>Division</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($marksheets['rows'] as $row): ?>

                                <tr>

                                    <td class="fw-medium text-dark">
                                        <?= esc($row['exam_title']) ?>
                                    </td>

                                    <td class="text-gray-300">
                                        <?= date('d M Y', strtotime($row['exam_startdate'])) ?>
                                    </td>

                                    <td class="fw-semibold">
                                        <?= $row['percentage'] ?>%
                                    </td>

                                    <td>
                                        <?= esc($row['division']) ?>
                                    </td>

                                    <td>

                                        <a href="marksheet/<?= $row['exam_id'] ?>"
                                            class="btn btn-info py-4 px-10 text-13">

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


        <?php if (!empty($marksheets['rows'])): ?>

            <div class="card-footer flex-between flex-wrap gap-8 py-16 px-24">

                <span class="text-gray-900 text-14">

                    Showing <strong>
                        <?= $from ?>
                    </strong>–<strong>
                        <?= $to ?>
                    </strong>

                    of <strong>
                        <?= $marksheets['total'] ?>
                    </strong>

                </span>

                <?= $marksheets['pager'] ?>

            </div>

        <?php endif; ?>

    </div>

</div>