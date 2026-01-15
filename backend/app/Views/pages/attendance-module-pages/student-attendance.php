<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex">
                        <i class="ph ph-caret-right"></i>
                    </span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Mark Attendance</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">

                <!-- Class -->
                <div class="col-md-4">
                    <label class="form-label">Select Class</label>
                    <select id="classSelect" class="form-select">
                        <option value="">Select Class</option>
                        <?php if (!empty($classes)): ?>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= esc($c['class_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Section -->
                <div class="col-md-4">
                    <label class="form-label">Select Section</label>
                    <select id="sectionSelect" class="form-select">
                        <option value="">Select Section</option>
                        <?php if (!empty($sections)): ?>
                            <?php foreach ($sections as $s): ?>
                                <option value="<?= $s['id'] ?>">
                                    <?= esc($s['section_label']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Date -->
                <div class="col-md-4">
                    <label class="form-label">Select Date</label>
                    <input type="date" id="dateSelect" class="form-control py-8 rounded" value="<?= date('Y-m-d') ?>">
                </div>

            </div>
        </div>
    </div>


    <!-- Attendance Table Card -->
    <div class="card overflow-hidden">
        <div class="card-header">
            <h5 class="mb-0">Student Attendance</h5>
        </div>
        <div class="card-body p-0 px-10 pb-10">
            <!-- Attendance Metadata (shown only if attendance is taken) -->
            <div id="attendanceMeta" class="mb-16 d-none">

                <div class="d-flex align-items-start gap-12 p-12 rounded-8 bg-success-50">

                    <!-- Status Badge -->
                    <div class="d-flex align-items-center gap-6 text-success-700 fw-semibold">
                        <i class="ph ph-check-circle text-20"></i>
                        <span class="badge bg-success-600 text-white px-12 py-6 rounded-pill">
                            Attendance Taken
                        </span>
                    </div>

                    <!-- Metadata -->
                    <div class="d-flex flex-wrap gap-16 text-sm text-gray-600">

                        <div class="d-flex align-items-center gap-6">
                            <i class="ph ph-calendar-check text-success-600"></i>
                            <span>
                                <strong>Taken On:</strong>
                                <span id="attendanceTakenAt"></span>
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-6">
                            <i class="ph ph-user-circle text-success-600"></i>
                            <span>
                                <strong>Taken By:</strong>
                                <span id="attendanceTakenBy"></span>
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            <table class="table style-two table-border mb-0">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">Roll No</th>
                        <th class="h6 text-gray-300">Student Name</th>
                        <th class="h6 text-gray-300 text-center">
                            <div class="form-check d-inline-flex align-items-center justify-content-center w-100">
                                <input class="form-check-input border-gray-200 rounded-4 " type="checkbox"
                                    id="selectAllAttendance" />
                                <label class="form-check-label ms-2 w-auto" for="selectAllAttendance">
                                    Present
                                </label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="attendanceTableBody">
                    <!-- Dynamic rows will be appended here -->
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end py-10">
            <button type="button" id="saveAttendanceBtn"
                class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2 ms-auto">
                <i class="ph ph-floppy-disk me-4"></i>
                Save Attendance
            </button>
        </div>
    </div>

</div>

<!-- Page Script -->
<script src="<?= base_url() ?>assets/js/attendance-management.js"></script>