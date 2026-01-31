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
                    <span class="text-main-600 fw-normal text-15">Students</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12" data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
                <i class="ph ph-plus me-8"></i>
                Add Student
            </button>
            <div
                class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-layout"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                    id="exportOptions">
                    <option value="" selected disabled>Export</option>
                    <option value="csv">CSV</option>
                    <option value="json">JSON</option>
                </select>
            </div>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Filters Section -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <select class="form-select" id="filterClass">
                        <option value="">All Classes</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Section</label>
                    <select class="form-select" id="filterSection">
                        <option value="">All Sections</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-flex gap-10">
                        <button type="button" class="btn py-10 btn-main w-100" id="applyFilterBtn">
                            <i class="ph ph-funnel me-8"></i>
                            Apply Filter
                        </button>
                        <button type="button" class="btn py-10 btn-outline-main w-100" id="resetFilterBtn">
                            <i class="ph ph-x me-8"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <table id="studentTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                    id="selectAll" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Student Name</th>
                        <th class="h6 text-gray-300">Roll No</th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Section</th>
                        <th class="h6 text-gray-300">Email</th>
                        <th class="h6 text-gray-300">Contact</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated via DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Admission No *</label>
                            <input type="text" class="form-control" id="admission_no" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Class *</label>
                            <select class="form-select" id="related_class" required>
                                <option value="">Select Class</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Section *</label>
                            <select class="form-select" id="related_section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="firstname" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status *</label>
                            <select id="status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Admitted">Admitted</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Dropped Out">Dropped Out</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                                <option value="Terminated">Terminated</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-select" id="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Blood Group</label>
                            <select class="form-select" id="blood_group">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Student Email</label>
                            <input type="email" class="form-control" id="student_email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Student Contact</label>
                            <input type="text" class="form-control" id="student_contact_no">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control" id="father_name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Father Contact</label>
                            <input type="text" class="form-control" id="father_contact_no">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mother Name</label>
                            <input type="text" class="form-control" id="mother_name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mother Contact</label>
                            <input type="text" class="form-control" id="mother_contact_no">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-main" id="saveStudentBtn">Save Student</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="edit_firstname" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="edit_middlename">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Admitted">Admitted</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Dropped Out">Dropped Out</option>
                                <option value="Transferred">Transferred</option>
                                <option value="Graduated">Graduated</option>
                                <option value="Terminated">Terminated</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-select" id="edit_gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_lastname">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Roll No *</label>
                            <input type="text" class="form-control" id="edit_roll_no" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Blood Group</label>
                            <select class="form-select" id="edit_blood_group">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Class *</label>
                            <select class="form-select" id="edit_related_class" required>
                                <option value="">Select Class</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Section *</label>
                            <select class="form-select" id="edit_related_section" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Student Email</label>
                            <input type="email" class="form-control" id="edit_student_email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Student Contact</label>
                            <input type="text" class="form-control" id="edit_student_contact_no">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-main" id="updateStudentBtn">Update Student</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/sweetalert/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('assets/js/student-list.js') ?>"></script>