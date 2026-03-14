<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?=('examination/exam-list') ?>"
                        class="nav_js text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15"><?= isset($exam['id']) ? 'Edit' : 'Create' ?>
                        Examination Routine</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <!-- Edit Current Exam Button (only visible in edit mode) -->
            <button class="btn btn-warning text-sm btn-sm px-10 py-8 rounded-8" id="editCurrentExamBtn"
                style="display: none;">
                <i class="ph ph-pencil me-8"></i>
                Edit Current Exam
            </button>

            <!-- Add New Exam Button (always visible) -->
            <button class="btn btn-outline-main text-sm btn-sm px-10 py-8 rounded-8" id="addExamBtn">
                <i class="ph ph-plus me-8"></i>
                Add New Exam
            </button>

            <button class="btn btn-main text-sm btn-sm px-10 py-8 rounded-8" id="saveRoutineBtn">
                <i class="ph ph-floppy-disk me-8"></i>
                Save Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Exam Selection Section Start -->
    <div class="card mb-24">
        <!-- Hidden inputs for configuration -->
        <input type="hidden" id="pageEditExamId" value="<?= $exam['id'] ?? '0' ?>">
        <input type="hidden" id="baseUrl" value="<?= base_url() ?>">
        <input type="hidden" id="classesData" value='<?= json_encode($classes ?? []) ?>'>
        <input type="hidden" id="subjectsData" value='<?= json_encode($subjects ?? []) ?>'>

        <div class="card-header">
            <h6 class="text-lg mb-0">Select Examination</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold text-gray-900">Select Exam <span
                            class="text-danger">*</span></label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-exam"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="examSelect">
                            <option value="" selected disabled>Choose Examination</option>
                            <!-- Will be populated from database -->
                        </select>
                    </div>
                </div>
            </div>
            <div id="examDetailsDisplay" class="mt-16" style="display: none;">
                <div class="bg-main-50 rounded-8 p-16">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <span class="text-gray-600 text-sm">Title:</span>
                            <span class="text-gray-900 fw-semibold ms-8" id="displayExamTitle">-</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-gray-600 text-sm">Start Date:</span>
                            <span class="text-gray-900 fw-semibold ms-8" id="displayStartDate">-</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-gray-600 text-sm">End Date:</span>
                            <span class="text-gray-900 fw-semibold ms-8" id="displayEndDate">-</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-gray-600 text-sm">Description:</span>
                            <span class="text-gray-900 fw-semibold ms-8" id="displayDescription">-</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Exam Selection Section End -->

    <!-- Routine Builder Section Start -->
    <div class="card overflow-hidden">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">Examination Routine</h6>
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-outline-main text-sm btn-sm px-24 py-12 rounded-8" id="addDateRowBtn">
                    <i class="ph ph-calendar-plus me-8"></i>
                    Add Date Row
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="routineTable">
                    <thead class="bg-main-50">
                        <tr>
                            <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 130px;">Date</th>
                            <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Day</th>
                            <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Time</th>
                            <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Max Marks</th>
                            <!-- Class columns will be dynamically added here -->
                            <th class="px-16 py-16 text-gray-900 fw-semibold text-center" style="min-width: 80px;">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody id="routineTableBody">
                        <tr class="empty-state">
                            <td colspan="20" class="text-center py-32">
                                <i class="ph ph-calendar-blank text-gray-300" style="font-size: 48px;"></i>
                                <p class="text-gray-500 mt-8 mb-0">Select an examination to begin creating the routine
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <span class="text-gray-600 text-sm">
                <i class="ph ph-info me-4"></i>
                Select subjects for each class in the corresponding column
            </span>
            <span class="text-gray-900">Total Rows: <span id="totalRows">0</span></span>
        </div>
    </div>
    <!-- Routine Builder Section End -->
</div>

<!-- Add/Edit Exam Modal -->
<div class="modal fade" id="addExamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examModalTitle">Add New Examination</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modalExamId" value="0">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold text-gray-900">Examination Title <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="newExamTitle"
                            placeholder="e.g., First Terminal Exam 2026">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold text-gray-900">Description</label>
                        <textarea class="form-control" id="newExamDescription" rows="2"
                            placeholder="Enter exam description..."></textarea>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold text-gray-900">Start Date <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="newExamStartDate">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold text-gray-900">End Date <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="newExamEndDate">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-gray" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-main" id="confirmAddExamBtn">
                    <span id="confirmExamBtnText">Create Exam</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/exam-routine.js') ?>"></script>