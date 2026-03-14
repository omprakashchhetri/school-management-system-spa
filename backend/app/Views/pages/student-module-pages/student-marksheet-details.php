<?php
$sd = $studentData;

function gradeBadge($grade)
{
    if ($grade == 'A+' || $grade == 'A')
        return 'bg-success-50 text-success-600';
    if ($grade == 'B+' || $grade == 'B')
        return 'bg-info-50 text-info-600';
    if ($grade == 'C')
        return 'bg-warning-50 text-warning-600';
    return 'bg-danger-50 text-danger-600';
}

$profileImg = !empty($sd['profile_image'])
    ? base_url('uploads/students/' . $sd['profile_image'])
    : 'https://ui-avatars.com/api/?name=' . urlencode($sd['firstname'] . ' ' . $sd['lastname']) . '&size=120';
?>

<div class="dashboard-body">

    <!-- BREADCRUMB -->

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">

        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">

                <li>
                    <a href="<?= base_url('student/dashboard') ?>"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>

                <li><span class="text-gray-500 d-flex"><i class="ph ph-caret-right"></i></span></li>

                <li>
                    <a href="<?= base_url('student/report-cards') ?>"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Marksheets</a>
                </li>

                <li><span class="text-gray-500 d-flex"><i class="ph ph-caret-right"></i></span></li>

                <li>
                    <span class="text-main-600 fw-normal text-15"><?= esc($exam['exam_title']) ?></span>
                </li>

            </ul>
        </div>

        <div class="flex-align gap-8">

            <button onclick="window.print()" class="btn bg-main-50 text-main-600 py-2 px-14 rounded-pill">
                <i class="ph ph-printer"></i> Print
            </button>

            <button class="btn bg-main-50 text-main-600 py-2 px-14 rounded-pill">
                <i class="ph ph-download-simple"></i> PDF
            </button>

        </div>

    </div>


    <!-- STUDENT CARD -->

    <div class="card mb-24">

        <div class="card-body">

            <div class="flex-between flex-wrap gap-16 mb-24">

                <div class="flex-align gap-16">

                    <img src="<?= $profileImg ?>" class="w-80 h-80 rounded-circle">

                    <div>

                        <h5 class="mb-8 fw-semibold text-gray-300">
                            <?= esc($sd['firstname'] . ' ' . $sd['lastname']) ?>
                        </h5>

                        <div class="flex-align gap-16 flex-wrap">

                            <span class="text-gray-500 text-15">
                                <i class="ph ph-identification-card"></i>
                                Roll No: <?= esc($sd['roll_no']) ?>
                            </span>

                            <span class="text-gray-500 text-15">
                                <i class="ph ph-graduation-cap"></i>
                                Class: <?= esc($sd['class_name']) ?> - <?= esc($sd['section_label']) ?>
                            </span>

                        </div>

                    </div>

                </div>

                <div class="text-end">

                    <span class="badge bg-success-50 text-success-600">Active Student</span>

                    <p class="text-gray-500 text-13">
                        Student ID: <?= esc($sd['admission_no']) ?>
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- PERFORMANCE STATS -->

    <div class="row g-3 mb-24">

        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <span class="text-gray-500">Percentage</span>

                    <h4><?= $exam['percentage'] ?>%</h4>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <span class="text-gray-500">Division</span>

                    <h4><?= $exam['division'] ?></h4>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card">

                <div class="card-body">

                    <span class="text-gray-500">Total Marks</span>

                    <h4><?= $exam['total_obtained'] ?> / <?= $exam['total_max'] ?></h4>

                </div>

            </div>

        </div>

    </div>


    <!-- SUBJECT TABLE -->

    <div class="card mb-24">

        <div class="card-header">

            <h6 class="fw-semibold text-gray-300"><?= $exam['exam_title'] ?> Results</h6>

        </div>

        <div class="card-body p-0 overflow-x-auto">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>Subject</th>

                        <th>Max Marks</th>

                        <th>Obtained</th>

                        <th>Percentage</th>

                        <th>Grade</th>

                        <th>Remarks</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($exam['subjects'] as $sub): ?>

                        <?php
                        $percent = $sub['max_marks'] > 0
                            ? round(($sub['obtained_marks'] / $sub['max_marks']) * 100, 1)
                            : 0;
                        ?>

                        <tr>

                            <td><?= esc($sub['subject_name']) ?></td>

                            <td><?= $sub['max_marks'] ?></td>

                            <td><?= $sub['obtained_marks'] ?></td>

                            <td><?= $percent ?>%</td>

                            <td>

                                <span class="badge <?= gradeBadge($sub['grade']) ?>">
                                    <?= $sub['grade'] ?>
                                </span>

                            </td>

                            <td><?= $sub['remarks'] ?></td>

                        </tr>

                    <?php endforeach; ?>


                    <tr class="bg-main-50 fw-bold">

                        <td>Total</td>

                        <td><?= $exam['total_max'] ?></td>

                        <td><?= $exam['total_obtained'] ?></td>

                        <td><?= $exam['percentage'] ?>%</td>

                        <td colspan="2"><?= $exam['division'] ?></td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <!-- SUBJECT PERFORMANCE -->

    <div class="card mb-24">

        <div class="card-header">

            <h6>Subject Performance</h6>

        </div>

        <div class="card-body">

            <?php foreach ($exam['subjects'] as $sub): ?>

                <?php
                $percent = $sub['max_marks'] > 0
                    ? round(($sub['obtained_marks'] / $sub['max_marks']) * 100, 1)
                    : 0;
                ?>

                <div class="mb-16">

                    <div class="flex-between mb-8">

                        <span><?= $sub['subject_name'] ?></span>

                        <span><?= $percent ?>%</span>

                    </div>

                    <div class="progress">

                        <div class="progress-bar bg-success" style="width:<?= $percent ?>%"></div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>


    <!-- ATTENDANCE SUMMARY -->

    <div class="card mb-24">

        <div class="card-header">

            <h6>Attendance Summary</h6>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-sm-3 text-center">

                    <h4><?= $attendanceSummary['present'] ?></h4>

                    <span>Present</span>

                </div>

                <div class="col-sm-3 text-center">

                    <h4><?= $attendanceSummary['absent'] ?></h4>

                    <span>Absent</span>

                </div>

                <div class="col-sm-3 text-center">

                    <h4><?= $attendanceSummary['late'] ?></h4>

                    <span>Late</span>

                </div>

                <div class="col-sm-3 text-center">

                    <h4><?= $attendanceSummary['total'] ?></h4>

                    <span>Total Days</span>

                </div>

            </div>

        </div>

    </div>


    <!-- EXAM HISTORY -->

    <div class="card">

        <div class="card-header">

            <h6>Exam History</h6>

        </div>

        <div class="card-body p-0 overflow-x-auto">

            <table class="table table-striped">

                <thead>

                    <tr>

                        <th>Exam</th>

                        <th>Marks</th>

                        <th>Percentage</th>

                        <th>Division</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($allExams as $id => $ex): ?>

                        <tr>

                            <td><?= $ex['exam_title'] ?></td>

                            <td><?= $ex['total_obtained'] ?> / <?= $ex['total_max'] ?></td>

                            <td><?= $ex['percentage'] ?>%</td>

                            <td><?= $ex['division'] ?></td>

                            <td>

                                <?php if ($id == array_search($exam, $allExams)): ?>

                                    <span class="badge bg-main-100 text-main-600">Current</span>

                                <?php else: ?>

                                    <a href="<?= base_url('student/marksheet/' . $id) ?>" class="btn btn-main btn-sm">View</a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>