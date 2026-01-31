<?php
$employee = $employeeDetails['employee'] ?? null;
$subjectAllocations = $employeeDetails['subject_allocations'] ?? [];
$classTeacherAssignments = $employeeDetails['class_teacher_assignments'] ?? [];
$documents = $employeeDetails['documents'] ?? [];
$attendanceRecords = $employeeDetails['attendance_records'] ?? [];
$attendanceStats = $employeeDetails['attendance_stats'] ?? [];

if (!$employee) {
    echo '<div class="alert alert-danger">Employee not found</div>';
    return;
}

$fullName = trim($employee['firstname'] . ' ' . $employee['middlename'] . ' ' . $employee['lastname']);
$profileImage = !empty($employee['profile_image']) 
    ? base_url('uploads/employees/' . $employee['profile_image']) 
    : base_url('assets/images/thumbs/setting-profile-img.jpg');
?>

<div class="dashboard-body">
    <input type="hidden" name="employeeId" id="employeeId" value="<?= esc($employee['id']) ?>">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li>
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li>
                <a href="<?= base_url('admin/employee-list') ?>"
                    class="text-gray-200 fw-normal text-15 hover-text-main-600">Employees</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li>
                <span class="text-main-600 fw-normal text-15">Employee Details</span>
            </li>
        </ul>
    </div>
    <!-- Breadcrumb End -->

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="cover-img position-relative">
                <label for="coverImageUpload"
                    class="btn border-gray-200 text-gray-200 fw-normal hover-bg-gray-400 rounded-pill py-4 px-14 position-absolute inset-block-start-0 inset-inline-end-0 mt-24 me-24"
                    style="cursor: pointer;">
                    <i class="ph ph-camera me-4"></i>
                    Edit Cover
                </label>
                <input type="file" id="coverImageUpload" accept=".png, .jpg, .jpeg, .gif" style="display: none;" />
                <div class="avatar-preview">
                    <div id="coverImagePreview" style="
                    background-image: url('<?=base_url()?>assets/images/thumbs/setting-cover-img.png');
                    background-size: cover;
                    background-position: center;
                    height: 200px;
                    width: 100%;
                "></div>
                </div>
            </div>

            <div class="setting-profile px-24">
                <div class="flex-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap mb-20 gap-24">
                        <div class="position-relative">
                            <img src="<?= $profileImage ?>" alt="" id="profileImageDisplay"
                                class="w-120 h-120 rounded-circle border border-white object-fit-cover"
                                style="object-fit: cover;" />
                            <label for="profileImageUpload"
                                class="position-absolute bg-main-600 text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="
                                cursor: pointer;
                                width: 36px;
                                height: 36px;
                                bottom: 0;
                                right: 0;
                                border: 2px solid white;
                            " title="Change Profile Picture">
                                <i class="ph ph-camera text-lg"></i>
                            </label>
                            <input type="file" id="profileImageUpload" accept=".png, .jpg, .jpeg, .gif"
                                style="display: none;" />
                        </div>
                        <div>
                            <h4 class="mb-8" id="employeeFullName"><?= esc($fullName) ?></h4>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-briefcase"></i></span>
                                    <span
                                        class="text-gray-600 d-flex text-15"><?= esc($employee['role_name'] ?? 'N/A') ?></span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-identification-card"></i></span>
                                    <span
                                        class="text-gray-600 d-flex text-15">EMP-<?= str_pad($employee['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-calendar-dots"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Joined
                                        <?= date('F Y', strtotime($employee['created_at'])) ?></span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span
                                        class="badge badge-sm bg-success-50 text-success-600 d-flex text-15">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav common-tab style-two nav-pills mb-0 flex-nowrap overflow-x-auto pb-5" id="pills-tab"
                    role="tablist">
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                            aria-selected="true">
                            Personal Details
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-professional-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-professional" type="button" role="tab"
                            aria-controls="pills-professional" aria-selected="false">
                            Professional Info
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-subjects-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-subjects" type="button" role="tab" aria-controls="pills-subjects"
                            aria-selected="false">
                            Subject Allocation
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-classes-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-classes" type="button" role="tab" aria-controls="pills-classes"
                            aria-selected="false">
                            Class Teacher
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents"
                            aria-selected="false">
                            Documents
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Personal Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Personal Information</h4>
                            <p class="text-gray-600 text-15">Employee personal details and contact information</p>
                        </div>
                        <button type="button" id="editPersonalBtn" class="btn btn-outline-main rounded-pill py-9">
                            <i class="ph ph-pencil-simple me-8"></i>
                            Edit Personal Info
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="personalInfoForm">
                        <div class="row gy-4">
                            <div class="col-sm-4 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">First Name</label>
                                <input type="text" class="form-control-plaintext py-11" id="fname"
                                    value="<?= esc($employee['firstname']) ?>" placeholder="Enter First Name"
                                    required />
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <label for="mname" class="form-label mb-8 h6">Middle Name</label>
                                <input type="text" class="form-control-plaintext py-11" id="mname"
                                    value="<?= esc($employee['middlename'] ?? '') ?>" placeholder="Enter Middle Name" />
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <label for="lname" class="form-label mb-8 h6">Last Name</label>
                                <input type="text" class="form-control-plaintext py-11" id="lname"
                                    value="<?= esc($employee['lastname']) ?>" placeholder="Enter Last Name" required />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Primary Email</label>
                                <input type="email" class="form-control-plaintext py-11" id="email"
                                    value="<?= esc($employee['email1']) ?>" placeholder="Enter Email" required />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="email2" class="form-label mb-8 h6">Secondary Email</label>
                                <input type="email" class="form-control-plaintext py-11" id="email2"
                                    value="<?= esc($employee['email2'] ?? '') ?>" placeholder="Enter Secondary Email" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Primary Phone Number</label>
                                <input type="tel" class="form-control-plaintext py-11" id="phone"
                                    value="<?= esc($employee['contact_number1']) ?>" placeholder="Enter Phone Number"
                                    required />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="phone2" class="form-label mb-8 h6">Secondary Phone Number</label>
                                <input type="tel" class="form-control-plaintext py-11" id="phone2"
                                    value="<?= esc($employee['contact_number2'] ?? '') ?>"
                                    placeholder="Enter Secondary Phone" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="street" class="form-label mb-8 h6">Street Address</label>
                                <input type="text" class="form-control-plaintext py-11" id="street"
                                    value="<?= esc($employee['street'] ?? '') ?>" placeholder="Enter Street Address" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="city" class="form-label mb-8 h6">City</label>
                                <input type="text" class="form-control-plaintext py-11" id="city"
                                    value="<?= esc($employee['city'] ?? '') ?>" placeholder="Enter City" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="district" class="form-label mb-8 h6">District</label>
                                <input type="text" class="form-control-plaintext py-11" id="district"
                                    value="<?= esc($employee['district'] ?? '') ?>" placeholder="Enter District" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="pincode" class="form-label mb-8 h6">Pincode</label>
                                <input type="text" class="form-control-plaintext py-11" id="pincode"
                                    value="<?= esc($employee['pincode'] ?? '') ?>" placeholder="Enter Pincode" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="country" class="form-label mb-8 h6">Country</label>
                                <input type="text" class="form-control-plaintext py-11" id="country"
                                    value="<?= esc($employee['country'] ?? '') ?>" placeholder="Enter Country" />
                            </div>
                            <div class="col-12 personal-form-actions" style="display: none;">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="button"
                                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9 btn-cancel-personal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Personal Details Tab End -->

        <!-- Professional Info Tab Start -->
        <div class="tab-pane fade" id="pills-professional" role="tabpanel" aria-labelledby="pills-professional-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Professional Information</h4>
                            <p class="text-gray-600 text-15">Employment details and qualifications</p>
                        </div>
                        <button type="button" id="editProfessionalBtn" class="btn btn-outline-main rounded-pill py-9">
                            <i class="ph ph-pencil-simple me-8"></i>
                            Edit Professional Info
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="professionalInfoForm">
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="emp_id" class="form-label mb-8 h6">Employee ID</label>
                                <input type="text" class="form-control-plaintext py-11" id="emp_id"
                                    value="EMP-<?= str_pad($employee['id'], 4, '0', STR_PAD_LEFT) ?>" readonly />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="role_id" class="form-label mb-8 h6">Role/Designation</label>
                                <select class="form-control form-select py-11" id="role_id" required disabled>
                                    <?php 
                            $rolesModel = model('RolesModel');
                            $roles = $rolesModel->where('deleted_at', null)->findAll();
                            foreach ($roles as $role): 
                            ?>
                                    <option value="<?= $role['id'] ?>"
                                        <?= ($role['id'] == $employee['role_id']) ? 'selected' : '' ?>>
                                        <?= esc($role['role_name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="join_date" class="form-label mb-8 h6">Joining Date</label>
                                <input type="date" class="form-control-plaintext py-11" id="join_date"
                                    value="<?= date('Y-m-d', strtotime($employee['created_at'])) ?>" readonly />
                                <small class="text-muted">Joining date cannot be modified</small>
                            </div>
                            <div class="col-12 professional-form-actions" style="display: none;">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="button"
                                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9 btn-cancel-professional">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Professional Info Tab End -->

        <!-- Subject Allocation Tab Start -->
        <div class="tab-pane fade" id="pills-subjects" role="tabpanel" aria-labelledby="pills-subjects-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-2 text-dark">Subject Allocations</h4>
                            <p class="text-gray-600 text-15 mb-0">
                                Subjects and classes currently assigned to this teacher
                            </p>
                        </div>
                        <button class="btn btn-main rounded-pill py-8 px-16" data-bs-toggle="modal"
                            data-bs-target="#addSubjectAllocationModal">
                            <i class="ph ph-plus me-8"></i>
                            Assign Subject
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($subjectAllocations)): ?>
                    <div class="alert alert-info">No subject allocations found for this teacher.</div>
                    <?php else: ?>
                    <div class="row gy-4">
                        <?php foreach ($subjectAllocations as $allocation): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card border border-gray-100 shadow-sm h-100">
                                <div
                                    class="card-header border-bottom border-gray-100 bg-main-50 d-flex align-items-center py-10">
                                    <i class="ph ph-book-open text-main-600 me-8 fs-5"></i>
                                    <h6 class="mb-0 text-main-600"><?= esc($allocation['subject_name']) ?> -
                                        <?= esc($allocation['class_name']) ?><?= esc($allocation['section_label']) ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Class:</span>
                                                <span class="text-dark"><?= esc($allocation['class_name']) ?></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Section:</span>
                                                <span class="text-dark"><?= esc($allocation['section_label']) ?></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Assigned:</span>
                                                <span
                                                    class="text-dark"><?= date('M d, Y', strtotime($allocation['created_at'])) ?></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8 mt-16">
                                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-pencil-line me-6"></i> Edit
                                                </button>
                                                <button
                                                    class="btn btn-danger rounded-pill py-6 px-12 text-13 delete-subject-allocation-js"
                                                    data-id="<?= esc($allocation['id']) ?>">
                                                    <i class="ph ph-trash me-6"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Subject Allocation Tab End -->

        <!-- Class Teacher Tab Start -->
        <div class="tab-pane fade" id="pills-classes" role="tabpanel" aria-labelledby="pills-classes-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Class Teacher Assignments</h4>
                            <p class="text-gray-600 text-15">
                                Classes where this teacher serves as the primary class teacher
                            </p>
                        </div>
                        <button class="btn btn-main rounded-pill py-9">
                            <i class="ph ph-plus me-8"></i>
                            Assign Class
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($classTeacherAssignments)): ?>
                    <div class="alert alert-info">No class teacher assignments found for this teacher.</div>
                    <?php else: ?>
                    <div class="row gy-4">
                        <?php foreach ($classTeacherAssignments as $assignment): ?>
                        <div class="col-lg-6">
                            <div class="card border border-main-300 bg-main-25">
                                <div class="card-header border-bottom border-main-200 bg-main-50">
                                    <div class="flex-between">
                                        <h6 class="mb-0 text-main-600">Class
                                            <?= esc($assignment['class_name']) ?><?= esc($assignment['section_label']) ?>
                                            - Primary Class Teacher</h6>
                                        <span
                                            class="text-success-600 bg-success-100 py-1 px-8 rounded-pill text-13">Active</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Total Students:</span>
                                                <span
                                                    class="text-gray-900 fw-semibold"><?= $assignment['student_count'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Assigned Since:</span>
                                                <span
                                                    class="text-gray-900"><?= date('F Y', strtotime($assignment['created_at'])) ?></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-between mt-16">
                                                <div class="flex-align gap-8">
                                                    <button
                                                        class="btn btn-outline-main rounded-pill py-6 px-12 text-13">View
                                                        Students</button>
                                                    <button
                                                        class="btn btn-outline-info rounded-pill py-6 px-12 text-13">Class
                                                        Details</button>
                                                </div>
                                                <button class="btn btn-danger rounded-pill py-6 px-12 text-13">Remove
                                                    Assignment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Class Teacher Tab End -->

        <!-- Documents Tab Start -->
        <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Employee Documents</h4>
                            <p class="text-gray-600 text-15">Important documents and certificates</p>
                        </div>
                        <button type="button" class="btn btn-main rounded-pill py-9" data-bs-toggle="modal"
                            data-bs-target="#uploadDocumentModal">
                            <i class="ph ph-upload me-8"></i>
                            Upload Document
                        </button>
                    </div>
                </div>
                <div class="card-body p-0 overflow-x-auto">
                    <?php if (empty($documents)): ?>
                    <div class="p-24">
                        <div class="alert alert-info">No documents uploaded for this employee.</div>
                    </div>
                    <?php else: ?>
                    <table class="table table-striped" id="documentsTable">
                        <thead>
                            <tr>
                                <th class="h6 text-gray-600">Document Type</th>
                                <th class="h6 text-gray-600">Document Name</th>
                                <th class="h6 text-gray-600">Upload Date</th>
                                <th class="h6 text-gray-600 text-center">Status</th>
                                <th class="h6 text-gray-600 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documents as $doc): ?>
                            <tr data-document-id="<?= $doc['id'] ?>">
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg">
                                            <i class="ph ph-file-text"></i>
                                        </span>
                                        <span
                                            class="text-dark fw-semibold"><?= esc($doc['document_type'] ?? 'Document') ?></span>
                                    </div>
                                </td>
                                <td class="text-dark"><?= esc($doc['document_name']) ?></td>
                                <td class="text-dark"><?= date('F d, Y', strtotime($doc['created_at'])) ?></td>
                                <td class="text-center">
                                    <?php
                                $statusClass = 'warning';
                                $statusText = 'Pending';
                                if (isset($doc['status'])) {
                                    if ($doc['status'] === 'verified') {
                                        $statusClass = 'success';
                                        $statusText = 'Verified';
                                    } elseif ($doc['status'] === 'rejected') {
                                        $statusClass = 'danger';
                                        $statusText = 'Rejected';
                                    }
                                }
                                ?>
                                    <span
                                        class="text-<?= $statusClass ?>-600 bg-<?= $statusClass ?>-100 py-2 px-10 rounded-pill document-status">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <a href="<?= base_url('uploads/employees/documents/' . $doc['file']) ?>"
                                            class="btn btn-info py-6 px-12 text-13" target="_blank">
                                            <i class="ph ph-download me-4"></i>
                                            Download
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-main py-6 px-12 text-13 dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item update-status-js" href="javascript:void(0)"
                                                        data-document-id="<?= $doc['id'] ?>" data-status="verified">
                                                        <i class="ph ph-check-circle text-success me-2"></i>
                                                        Verify
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item update-status-js" href="javascript:void(0)"
                                                        data-document-id="<?= $doc['id'] ?>" data-status="pending">
                                                        <i class="ph ph-clock text-warning me-2"></i>
                                                        Set Pending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item update-status-js" href="javascript:void(0)"
                                                        data-document-id="<?= $doc['id'] ?>" data-status="rejected">
                                                        <i class="ph ph-x-circle text-danger me-2"></i>
                                                        Reject
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-danger py-6 px-12 text-13 delete-document-js"
                                            data-document-id="<?= $doc['id'] ?>">
                                            <i class="ph ph-trash me-4"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Documents Tab End -->

        <!-- Upload Document Modal -->
        <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadDocumentForm">
                            <div class="mb-20">
                                <label for="documentType" class="form-label mb-8 h6">Document Type <span
                                        class="text-danger">*</span></label>
                                <select class="form-control form-select py-11" id="documentType" required>
                                    <option value="">Select Document Type</option>
                                    <option value="ID Card">ID Card Copy</option>
                                    <option value="Education Certificate">Education Certificate</option>
                                    <option value="Teaching License">Teaching License</option>
                                    <option value="Experience Certificate">Experience Certificate</option>
                                    <option value="Resume/CV">Resume/CV</option>
                                    <option value="Medical Certificate">Medical Certificate</option>
                                    <option value="Police Clearance">Police Clearance</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-20">
                                <label for="documentName" class="form-label mb-8 h6">Document Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control py-11" id="documentName"
                                    placeholder="e.g., John Smith ID Card" required />
                            </div>
                            <div class="mb-20">
                                <label for="documentFile" class="form-label mb-8 h6">Choose File <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control py-11" id="documentFile"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required />
                                <small class="text-muted">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-main rounded-pill py-9"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-main rounded-pill py-9" id="uploadDocumentBtn">
                            <i class="ph ph-upload me-8"></i>
                            Upload Document
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Subject Allocation Modal -->
        <div class="modal fade" id="addSubjectAllocationModal" tabindex="-1" aria-labelledby="addSubjectAllocationLabel"
            aria-hidden="true">
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
                                <select id="classSubAllo" class="form-select">
                                    <option value="">Select Class</option>
                                    <?php foreach ($classes as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Section -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Section</label>
                                <select id="sectionSubAllo" class="form-select">
                                    <option value="">Select Section</option>
                                    <?php foreach ($sections as $s): ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['section_label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Teacher -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Teacher</label>
                                <select id="teacherSubAllo" class="form-select">
                                    <option value="">Select Teacher</option>
                                    <?php foreach ($teachers as $t): ?>
                                    <option value="<?= $t['id'] ?>"
                                        <?= $t['id'] == $employee['id'] ? 'selected' : '' ?>>
                                        <?= $t['firstname'].' '.$t['lastname'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Subject -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Subject</label>
                                <select id="subjectSubAllo" class="form-select">
                                    <option value="">Select Subject</option>
                                    <?php foreach ($subjects as $sub): ?>
                                    <option value="<?= $sub['id'] ?>"><?= $sub['subject_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="mt-10">
                                    <button type="button" id="saveSubjectAllocationBtn"
                                        class="btn btn-primary px-4 w-100">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include SweetAlert2 if not already included -->
<script src="<?= base_url('assets/plugins/sweetalert/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('assets/js/employee-details.js') ?>"></script>