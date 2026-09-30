<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="/post-login-employee/admin/dashboard" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Employees</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <button type="button"
            class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            <i class="ph ph-plus me-4"></i>
            Add Employee
        </button>
        <!-- Breadcrumb Right End -->
    </div>

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <table id="employeeTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                    id="selectAll" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Name</th>
                        <th class="h6 text-gray-300">Email</th>
                        <th class="h6 text-gray-300">Phone Number</th>
                        <th class="h6 text-gray-300">Role</th>
                        <th class="h6 text-gray-300">Created At</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows are rendered client-side by employee-list.js (DataTables server-side processing). -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <!-- Firstname -->
                        <div class="col-12 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" id="firstname" class="form-control" placeholder="Enter first name">
                        </div>

                        <!-- Lastname -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="lastname" class="form-control" placeholder="Enter last name">
                        </div>

                        <!-- Email -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="email1" class="form-control" placeholder="Enter email">
                        </div>

                        <!-- Contact -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="contact_number1" class="form-control"
                                placeholder="Enter phone number">
                        </div>

                        <!-- Role -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Role</label>
                            <select id="role_id" class="form-select">
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="saveEmployeeBtn" class="btn btn-primary px-4">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <!-- Firstname -->
                        <div class="col-12 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" id="edit_firstname" class="form-control">
                        </div>

                        <!-- Lastname -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="edit_lastname" class="form-control">
                        </div>

                        <!-- Email -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="edit_email1" class="form-control">
                        </div>

                        <!-- Contact -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="edit_contact_number1" class="form-control">
                        </div>

                        <!-- Role -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Role</label>
                            <select id="edit_role_id" class="form-select">
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="updateEmployeeBtn" class="btn btn-primary px-4">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/employee-list.js"></script>