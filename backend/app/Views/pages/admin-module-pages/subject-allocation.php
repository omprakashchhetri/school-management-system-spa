<div>Test</div>
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
                    <span class="text-main-600 fw-normal text-15">Assignments</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <button type="button"
            class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#addClassTeacherModal">
            <i class="ph ph-plus me-4"></i>
            Add Class Teacher
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
                        <th class="h6 text-gray-300">Class Teacher</th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Section</th>
                        <th class="h6 text-gray-300">Created At</th>
                        <th class="h6 text-gray-300">Updated At</th>
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
                            <span class="h6 mb-0 fw-medium text-gray-300">Nov 18, 2024</span>
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
    <!-- Modal Add Class Teacher -->
    <div class="modal fade" id="addClassTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Class Teacher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <div class="row">
                        <!-- Class Dropdown -->
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Class : </label>
                            <select id="classSelect" class="form-select radius-8">
                                <option value="">Select Class</option>
                                <?php foreach ($classesDetails as $class): ?>
                                <option value="<?= $class['id'] ?>">
                                    <?= $class['class_name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Section Dropdown -->
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Section : </label>
                            <select id="sectionSelect" class="form-select radius-8">
                                <option value="">Select Section</option>
                                <?php foreach ($sectionList as $section): ?>
                                <option value="<?= $section['id'] ?>">
                                    <?= $section['section_label'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Employee Dropdown -->
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Teacher : </label>
                            <select id="employeeSelect" class="form-select radius-8">
                                <option value="">Select Teacher</option>
                                <?php foreach ($employeeList as $employee): ?>
                                <option value="<?= $employee['id'] ?>">
                                    <?= $employee['firstname'] ?> <?= $employee['lastname'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="submit" id="saveNewSectionBtn"
                                class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editClassTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Class Teacher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Class : </label>
                            <select id="classSelect" class="form-select radius-8">
                                <option value="">Select Class</option>
                                <?php foreach ($classesDetails as $class): ?>
                                <option value="<?= $class['id'] ?>">
                                    <?= $class['class_name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Section Dropdown -->
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Section : </label>
                            <select id="sectionSelect" class="form-select radius-8">
                                <option value="">Select Section</option>
                                <?php foreach ($sectionList as $section): ?>
                                <option value="<?= $section['id'] ?>">
                                    <?= $section['section_label'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Employee Dropdown -->
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Teacher : </label>
                            <select id="employeeSelect" class="form-select radius-8">
                                <option value="">Select Teacher</option>
                                <?php foreach ($employeeList as $employee): ?>
                                <option value="<?= $employee['id'] ?>">
                                    <?= $employee['firstname'] ?> <?= $employee['lastname'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                            <button type="submit" id="editSectionBtn"
                                class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>assets/js/class-teacher-management.js"></script>