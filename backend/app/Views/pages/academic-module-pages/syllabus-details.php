<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li><span class="text-gray-500 d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Syllabus</span>
                </li>
                <li><span class="text-gray-500 d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Syllabus Details</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Syllabus Details Card -->
    <div class="card mb-24">
        <div class="card-body">

            <h5 class="mb-16">Syllabus Information</h5>

            <div class="row">

                <div class="col-md-6 mb-16">
                    <label class="form-label text-gray-400">Class</label>
                    <p class="fw-medium text-gray-800">
                        <?= esc($syllabusDetails['class_name']) ?>
                    </p>
                </div>

                <div class="col-md-6 mb-16">
                    <label class="form-label text-gray-400">Section</label>
                    <p class="fw-medium text-gray-800">
                        <?= esc($syllabusDetails['section_label']) ?>
                    </p>
                </div>

                <div class="col-md-6 mb-16">
                    <label class="form-label text-gray-400">Subject</label>
                    <p class="fw-medium text-gray-800">
                        <?= esc($syllabusDetails['subject_name']) ?>
                    </p>
                </div>

                <div class="col-md-6 mb-16">
                    <label class="form-label text-gray-400">Teacher</label>
                    <p class="fw-medium text-gray-800">
                        <?= esc($syllabusDetails['teacher_name']) ?>
                    </p>
                </div>

                <div class="col-md-6 mb-16">
                    <label class="form-label text-gray-400">Uploaded On</label>
                    <p class="fw-medium text-gray-800">
                        <?= date('M d, Y', strtotime($syllabusDetails['created_at'])) ?>
                    </p>
                </div>

            </div>
        </div>
    </div>


    <!-- Description Card -->
    <div class="card mb-24">
        <div class="card-body">
            <h5 class="mb-12">Description</h5>

            <?php if (!empty($syllabusDetails['description'])): ?>
                <p class="text-gray-600">
                    <?= esc($syllabusDetails['description']) ?>
                </p>
            <?php else: ?>
                <p class="text-gray-400 fst-italic">
                    No description provided.
                </p>
            <?php endif; ?>

        </div>
    </div>


    <?php
    $fileName = $syllabusDetails['uploaded_syllabus_file'];
    $fileUrl = base_url('uploads/syllabus/' . $fileName);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    ?>

    <div class="card mb-24">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-12">
                <div class="bg-main-50 text-main-600 rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 48px; height: 48px;">
                    <i class="ph ph-file-text text-24"></i>
                </div>

                <div>
                    <p class="mb-0 fw-medium text-gray-800">
                        <?= esc($fileName) ?>
                    </p>
                    <small class="text-gray-400">
                        <?= strtoupper($fileExt) ?> File
                    </small>
                </div>
            </div>

            <div class="d-flex gap-8">
                <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-outline-main btn-sm px-16">
                    <i class="ph ph-eye me-4"></i> View
                </a>
                <a href="<?= $fileUrl ?>" download class="btn btn-main btn-sm px-16">
                    <i class="ph ph-download me-4"></i> Download
                </a>
            </div>

        </div>
    </div>


    <!-- Action Buttons -->
    <div class="d-flex gap-12">
        <button class="btn btn-warning px-20 edit-syllabus-js" data-id="<?= $syllabusDetails['id'] ?>"
            data-class-id="<?= $syllabusDetails['related_class'] ?>"
            data-section-id="<?= $syllabusDetails['related_section'] ?>"
            data-teacher-id="<?= $syllabusDetails['related_teacher'] ?>"
            data-subject-id="<?= $syllabusDetails['related_subject'] ?>"
            data-description="<?= esc($syllabusDetails['description'], 'attr') ?>">
            <i class="ph ph-pencil-simple me-4"></i>
            Edit Syllabus
        </button>


        <button class="btn btn-danger px-20 delete-syllabus-js" data-id="<?= $syllabusDetails['id'] ?>">
            <i class="ph ph-trash me-4"></i>
            Delete Syllabus
        </button>

    </div>

    <div class="modal fade" id="editSyllabusModal" tabindex="-1" aria-labelledby="editSyllabusLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSyllabusLabel">Edit Syllabus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Class -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Class</label>
                            <select id="edit_class" class="form-select">
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Section -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Section</label>
                            <select id="edit_section" class="form-select">
                                <option value="">Select Section</option>
                                <?php foreach ($sections as $s): ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['section_label'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Teacher -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Teacher</label>
                            <select id="edit_teacher" class="form-select">
                                <option value="">Select Teacher</option>
                                <?php foreach ($teachers as $t): ?>
                                    <option value="<?= $t['id'] ?>">
                                        <?= $t['firstname'] . ' ' . $t['lastname'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Subject -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Subject</label>
                            <select id="edit_subject" class="form-select">
                                <option value="">Select Subject</option>
                                <?php foreach ($subjects as $sub): ?>
                                    <option value="<?= $sub['id'] ?>"><?= $sub['subject_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Replace File -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Replace Syllabus File</label>
                            <input type="file" id="edit_syllabus_file" class="form-control">
                            <small class="text-muted">
                                Leave empty to keep existing file
                            </small>
                        </div>

                        <!-- Description -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="edit_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="updateSyllabusBtn" class="btn btn-primary px-4">
                                Update
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Script -->
<script src="<?= base_url() ?>assets/js/syllabus-list.js"></script>