<?php
/**
 * View: assignment-details.php
 *
 * Variables:
 * $assignment
 */

if (!$assignment) {
    echo '<div class="dashboard-body"><div class="card p-40 text-center">Assignment not found.</div></div>';
    return;
}

$status = 'pending';

if (!empty($assignment['upload_answers'])) {
    $status = 'submitted';
}

if (empty($assignment['upload_answers']) && strtotime($assignment['deadline_date']) < time()) {
    $status = 'overdue';
}

function assignmentStatusBadge($status)
{
    return match ($status) {
        'submitted' => ['bg-success-50 text-success-600', 'bg-success-600', 'Submitted'],
        'overdue' => ['bg-danger-50 text-danger-600', 'bg-danger-600', 'Overdue'],
        default => ['bg-warning-50 text-warning-600', 'bg-warning-600', 'Pending']
    };
}

[$badgeBg, $dotBg, $label] = assignmentStatusBadge($status);

$fileUrl = !empty($assignment['upload_answers'])
    ? base_url('uploads/assignments/' . $assignment['upload_answers'])
    : null;
?>

<div class="dashboard-body">

    <!-- Breadcrumb -->

    <div class="breadcrumb mb-24">

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
                <a href="<?= base_url('student/assignments') ?>"
                    class="text-gray-200 fw-normal text-15 hover-text-main-600">
                    Assignments
                </a>
            </li>

            <li>
                <span class="text-gray-500 fw-normal d-flex">
                    <i class="ph ph-caret-right"></i>
                </span>
            </li>

            <li>
                <span class="text-main-600 fw-normal text-15">
                    Assignment Details
                </span>
            </li>

        </ul>

    </div>


    <div class="row gy-24">

        <!-- LEFT SIDE -->

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header border-bottom">

                    <h4 class="mb-4">
                        <?= esc($assignment['topic']) ?>
                    </h4>

                    <p class="text-gray-600 text-14">
                        Subject: <strong><?= esc($assignment['subject_name']) ?></strong>
                    </p>

                </div>


                <div class="card-body">

                    <div class="row gy-16 mb-24">

                        <div class="col-sm-4">
                            <span class="text-gray-500 text-13">Assigned Date</span>
                            <h6>
                                <?= date('d M Y', strtotime($assignment['created_at'])) ?>
                            </h6>
                        </div>

                        <div class="col-sm-4">
                            <span class="text-gray-500 text-13">Due Date</span>
                            <h6 class="<?= $status == 'overdue' ? 'text-danger' : '' ?>">
                                <?= date('d M Y', strtotime($assignment['deadline_date'])) ?>
                            </h6>
                        </div>

                        <div class="col-sm-4">
                            <span class="text-gray-500 text-13">Status</span>
                            <br>

                            <span
                                class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">
                                <span class="w-6 h-6 <?= $dotBg ?> rounded-circle"></span>
                                <?= $label ?>
                            </span>

                        </div>

                    </div>


                    <!-- DESCRIPTION -->

                    <?php if (!empty($assignment['description'])): ?>

                        <div class="mb-24">

                            <h6 class="mb-8">Assignment Description</h6>

                            <div class="p-16 bg-light rounded-6">

                                <?= nl2br(esc($assignment['description'])) ?>

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- ATTACHMENT -->

                    <?php if (!empty($assignment['attachment'])): ?>

                        <div class="mb-24">

                            <h6 class="mb-8">Attachment</h6>

                            <a href="<?= base_url('uploads/assignments/' . $assignment['attachment']) ?>" target="_blank"
                                class="btn btn-outline-main py-6 px-16">

                                <i class="ph ph-download me-6"></i>
                                Download Attachment

                            </a>

                        </div>

                    <?php endif; ?>


                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->

        <div class="col-lg-4">


            <!-- SUBMISSION CARD -->

            <div class="card mb-24">

                <div class="card-header border-bottom">

                    <h5 class="mb-0">Your Submission</h5>

                </div>

                <div class="card-body">

                    <?php if ($status == 'submitted'): ?>

                        <div class="text-center">

                            <span class="text-success d-block text-48 mb-12">
                                <i class="ph ph-check-circle"></i>
                            </span>

                            <p class="fw-semibold mb-12">
                                Assignment Submitted
                            </p>

                            <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-info py-6 px-16">

                                <i class="ph ph-eye me-4"></i>
                                View File

                            </a>

                        </div>

                    <?php else: ?>

                        <form action="<?= base_url('student/assignment-submit/' . $assignment['id']) ?>" method="POST"
                            enctype="multipart/form-data">

                            <?= csrf_field() ?>

                            <div class="mb-16">

                                <label class="form-label mb-6">
                                    Upload Your Answer
                                </label>

                                <input type="file" name="assignment_file" class="form-control py-10" required>

                                <small class="text-gray-400">
                                    Allowed: PDF, DOC, DOCX, JPG
                                </small>

                            </div>

                            <button type="submit" class="btn btn-main w-100 py-8">

                                <i class="ph ph-upload me-6"></i>
                                Submit Assignment

                            </button>

                        </form>

                    <?php endif; ?>

                </div>

            </div>


            <!-- RESULT CARD -->

            <?php if (!empty($assignment['marks'])): ?>

                <div class="card">

                    <div class="card-header border-bottom">

                        <h5 class="mb-0">
                            Evaluation
                        </h5>

                    </div>

                    <div class="card-body text-center">

                        <h2 class="text-main-600 mb-4">
                            <?= $assignment['marks'] ?>
                        </h2>

                        <p class="mb-8">
                            Grade: <strong><?= esc($assignment['grade']) ?></strong>
                        </p>

                        <?php if (!empty($assignment['submitted_at'])): ?>

                            <p class="text-gray-500 text-13">

                                Submitted on

                                <?= date('d M Y h:i A', strtotime($assignment['submitted_at'])) ?>

                            </p>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>


        </div>

    </div>

</div>