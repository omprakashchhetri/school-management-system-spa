<?php
/**
 * View: pages/student-module-pages/subject-list.php
 *
 * Variables:
 *   $subjects – rows from StudentsController::getStudentSubjects()
 */
?>

<div class="dashboard-body">

    <!-- ── Breadcrumb ────────────────────────────────────────────── -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-0">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?= base_url('student/dashboard') ?>"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">My Subjects</span></li>
            </ul>
        </div>
    </div>

    <!-- ── Subjects Card ─────────────────────────────────────────── -->
    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <?php if (empty($subjects)): ?>
                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-books" style="font-size:3rem;"></i>
                    <p class="mt-12 mb-0 text-16 fw-medium">No subjects assigned to your class yet.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-gray-300 ps-24">Subject</th>
                                <th class="h6 text-gray-300">Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subjects as $subject): ?>
                                <tr>
                                    <td class="ps-24">
                                        <div class="flex-align gap-12">
                                            <span class="w-40 h-40 bg-main-50 text-main-600 rounded-8 flex-center text-xl flex-shrink-0">
                                                <i class="ph ph-book-open"></i>
                                            </span>
                                            <span class="h6 mb-0 fw-semibold text-dark">
                                                <?= esc($subject['subject_name'] ?? '-') ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="h6 mb-0 fw-medium text-gray-300">
                                            <?= esc(trim(($subject['firstname'] ?? '') . ' ' . ($subject['lastname'] ?? '')) ?: '-') ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
