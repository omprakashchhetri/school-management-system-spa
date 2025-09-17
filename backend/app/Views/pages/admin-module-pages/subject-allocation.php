<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Subject Allocations</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <button type="button"
            class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#addSubjectAllocationModal">
            <i class="ph ph-plus me-4"></i>
            Allocate New Subject
        </button>
    </div>
    <!-- Breadcrumb Right End -->


    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <table id="classTeacherTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                    id="selectAll" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Teacher</th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Section</th>
                        <th class="h6 text-gray-300">Subject</th>
                        <th class="h6 text-gray-300">Created At</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="<?= base_url() ?>assets/images/thumbs/student-img1.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Jane Cooper</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">5</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">A</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">History</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Nov 18, 2024</span>
                        </td>

                        <td>
                            <a href="assignment.html#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                More</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Add Subject Allocation Modal -->
<div class="modal fade" id="addSubjectAllocationModal" tabindex="-1" aria-labelledby="addSubjectAllocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-top">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectAllocationLabel">Add Subject Allocation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <!-- Class -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Class</label>
                        <select id="class" class="form-select">
                            <option value="">Select Class</option>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Section -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Section</label>
                        <select id="section" class="form-select">
                            <option value="">Select Section</option>
                            <?php foreach ($sections as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= $s['section_label'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Teacher -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Teacher</label>
                        <select id="teacher" class="form-select">
                            <option value="">Select Teacher</option>
                            <?php foreach ($teachers as $t): ?>
                                <option value="<?= $t['id'] ?>"><?= $t['firstname'].' '.$t['lastname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Subject</label>
                        <select id="subject" class="form-select">
                            <option value="">Select Subject</option>
                            <?php foreach ($subjects as $sub): ?>
                                <option value="<?= $sub['id'] ?>"><?= $sub['subject_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" id="saveSubjectAllocationBtn" class="btn btn-primary px-4">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Subject Allocation Modal -->
<div class="modal fade" id="editSubjectAllocationModal" tabindex="-1" aria-labelledby="editSubjectAllocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-top">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectAllocationLabel">Edit Subject Allocation</h5>
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
                                <option value="<?= $t['id'] ?>"><?= $t['firstname'].' '.$t['lastname'] ?></option>
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

                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" id="updateSubjectAllocationBtn" class="btn btn-primary px-4">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?= base_url() ?>assets/js/subject-allocation.js"></script>