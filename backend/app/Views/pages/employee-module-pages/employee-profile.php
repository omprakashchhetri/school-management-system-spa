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
    <input type="hidden" name="pageType" id="pageType" value="profile">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li>
                <a href="<?= base_url('employee/dashboard') ?>"
                    class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li>
                <span class="text-main-600 fw-normal text-15">My Profile</span>
            </li>
        </ul>
    </div>
    <!-- Breadcrumb End -->

    <!-- Profile Header Card -->
    <div class="card overflow-hidden shadow-sm">
        <div class="card-body p-0">
            <!-- Cover Image -->
            <div class="cover-img position-relative">
                <label for="coverImageUpload"
                    class="btn border-gray-200 text-white fw-normal hover-bg-gray-700 rounded-pill py-8 px-16 position-absolute inset-block-start-0 inset-inline-end-0 mt-24 me-24"
                    style="cursor: pointer; background: rgba(0,0,0,0.5);">
                    <i class="ph ph-camera me-4"></i>
                    Change Cover
                </label>
                <input type="file" id="coverImageUpload" accept=".png, .jpg, .jpeg, .gif" style="display: none;" />
                <div class="avatar-preview">
                    <div id="coverImagePreview" style="
                        background-image: url('<?=base_url()?>assets/images/thumbs/setting-cover-img.png');
                        background-size: cover;
                        background-position: center;
                        height: 180px;
                        width: 100%;
                    "></div>
                </div>
            </div>

            <!-- Profile Info Section -->
            <div class="setting-profile px-24">
                <div class="flex-between flex-wrap gap-24">
                    <div class="d-flex align-items-end flex-wrap gap-24 mt-md-3" style="margin-top: -50px;">
                        <!-- Profile Image -->
                        <div class="position-relative">
                            <img src="<?= $profileImage ?>" alt="" id="profileImageDisplay"
                                class="w-120 h-120 rounded-circle border-4 border object-fit-cover shadow-lg"
                                style="object-fit: cover;" />
                            <label for="profileImageUpload"
                                class="position-absolute bg-main-600 text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm hover-bg-main-700"
                                style="
                                    cursor: pointer;
                                    width: 44px;
                                    height: 44px;
                                    bottom: 5px;
                                    right: 5px;
                                    border: 3px solid white;
                                    transition: all 0.3s;
                                " title="Change Profile Picture">
                                <i class="ph ph-camera text-xl"></i>
                            </label>
                            <input type="file" id="profileImageUpload" accept=".png, .jpg, .jpeg, .gif"
                                style="display: none;" />
                        </div>

                        <!-- Name & Basic Info -->
                        <div class="mt-3">
                            <h3 class="mb-8 text-gray-900" id="employeeFullName"><?= esc($fullName) ?></h3>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-main-600 d-flex text-lg"><i
                                            class="ph-fill ph-briefcase"></i></span>
                                    <span
                                        class="text-gray-700 d-flex text-15 fw-medium"><?= esc($employee['role_name'] ?? 'N/A') ?></span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-main-600 d-flex text-lg"><i
                                            class="ph-fill ph-identification-card"></i></span>
                                    <span
                                        class="text-gray-700 d-flex text-15">EMP-<?= str_pad($employee['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-main-600 d-flex text-lg"><i
                                            class="ph-fill ph-calendar-dots"></i></span>
                                    <span class="text-gray-700 d-flex text-15">Joined
                                        <?= date('F Y', strtotime($employee['created_at'])) ?></span>
                                </div>
                            </div>
                            <div class="mt-12">
                                <span class="badge bg-success-50 text-success-600 py-6 px-16 text-13 fw-medium">
                                    <i class="ph-fill ph-check-circle me-4"></i>
                                    Active Employee
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <ul class="nav common-tab style-two nav-pills mb-0 flex-nowrap overflow-x-auto mt-24 pt-10 border-top"
                    id="pills-tab" role="tablist">
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                            aria-selected="true">
                            <i class="ph ph-user me-8"></i>
                            Personal Details
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-professional-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-professional" type="button" role="tab"
                            aria-controls="pills-professional" aria-selected="false">
                            <i class="ph ph-briefcase me-8"></i>
                            Professional Info
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-subjects-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-subjects" type="button" role="tab" aria-controls="pills-subjects"
                            aria-selected="false">
                            <i class="ph ph-book-open me-8"></i>
                            My Subjects
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-classes-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-classes" type="button" role="tab" aria-controls="pills-classes"
                            aria-selected="false">
                            <i class="ph ph-chalkboard-teacher me-8"></i>
                            Class Teacher
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents"
                            aria-selected="false">
                            <i class="ph ph-file-text me-8"></i>
                            My Documents
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Personal Details Tab -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <h5 class="mb-0 text-gray-900">
                        <i class="ph ph-user-circle me-8 text-main-600"></i>
                        Personal Information
                    </h5>
                </div>
                <div class="card-body p-24">
                    <div class="row g-2">
                        <!-- Full Name -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-user"></i>
                                    Full Name
                                </label>
                                <h6 class="mb-0 text-gray-900"><?= esc($fullName) ?></h6>
                            </div>
                        </div>

                        <!-- Primary Email -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-envelope"></i>
                                    Primary Email
                                </label>
                                <h6 class="mb-0 text-gray-900 text-break"><?= esc($employee['email1']) ?></h6>
                            </div>
                        </div>

                        <!-- Primary Phone -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-phone"></i>
                                    Primary Phone
                                </label>
                                <h6 class="mb-0 text-gray-900"><?= esc($employee['contact_number1']) ?></h6>
                            </div>
                        </div>

                        <?php if (!empty($employee['email2'])): ?>
                        <!-- Secondary Email -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-envelope-simple"></i>
                                    Secondary Email
                                </label>
                                <h6 class="mb-0 text-gray-900 text-break"><?= esc($employee['email2']) ?></h6>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($employee['contact_number2'])): ?>
                        <!-- Secondary Phone -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-device-mobile"></i>
                                    Secondary Phone
                                </label>
                                <h6 class="mb-0 text-gray-900"><?= esc($employee['contact_number2']) ?></h6>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- Date of Birth -->

                        <!-- Street Address -->
                        <div class="col-lg-6 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-map-pin"></i>
                                    Street Address
                                </label>
                                <h6 class="mb-0 text-gray-900">
                                    <?= !empty($employee['street']) ? esc($employee['street']) : 'Not provided' ?></h6>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="col-lg-3 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-buildings"></i>
                                    City
                                </label>
                                <h6 class="mb-0 text-gray-900">
                                    <?= !empty($employee['city']) ? esc($employee['city']) : 'Not provided' ?></h6>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-lg-3 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-map-trifold"></i>
                                    District
                                </label>
                                <h6 class="mb-0 text-gray-900">
                                    <?= !empty($employee['district']) ? esc($employee['district']) : 'Not provided' ?>
                                </h6>
                            </div>
                        </div>

                        <!-- Pincode -->
                        <div class="col-lg-3 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-hash"></i>
                                    Pincode
                                </label>
                                <h6 class="mb-0 text-gray-900">
                                    <?= !empty($employee['pincode']) ? esc($employee['pincode']) : 'Not provided' ?>
                                </h6>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-lg-3 col-md-6">
                            <div class="p-16 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-globe"></i>
                                    Country
                                </label>
                                <h6 class="mb-0 text-gray-900">
                                    <?= !empty($employee['country']) ? esc($employee['country']) : 'Not provided' ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Info Tab -->
        <div class="tab-pane fade" id="pills-professional" role="tabpanel" aria-labelledby="pills-professional-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <h5 class="mb-0 text-gray-900">
                        <i class="ph ph-briefcase me-8 text-main-600"></i>
                        Professional Information
                    </h5>
                </div>
                <div class="card-body p-24">
                    <div class="row g-2">
                        <!-- Employee ID -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-20 bg-main-50 rounded-8 border border-main-200">
                                <label class="text-13 text-main-600 mb-8 d-flex align-items-center gap-6 fw-medium">
                                    <i class="ph-fill ph-identification-card"></i>
                                    Employee ID
                                </label>
                                <h5 class="mb-0 text-main-600">EMP-<?= str_pad($employee['id'], 4, '0', STR_PAD_LEFT) ?>
                                </h5>
                            </div>
                        </div>

                        <!-- Role/Designation -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-20 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-user-circle-gear"></i>
                                    Role/Designation
                                </label>
                                <h6 class="mb-0 text-gray-900"><?= esc($employee['role_name'] ?? 'N/A') ?></h6>
                            </div>
                        </div>

                        <!-- Joining Date -->
                        <div class="col-lg-4 col-md-6">
                            <div class="p-20 bg-light-100 rounded-8">
                                <label class="text-13 text-gray-600 mb-8 d-flex align-items-center gap-6">
                                    <i class="ph ph-calendar-check"></i>
                                    Joining Date
                                </label>
                                <h6 class="mb-0 text-gray-900"><?= date('F d, Y', strtotime($employee['created_at'])) ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subject Allocation Tab -->
        <div class="tab-pane fade" id="pills-subjects" role="tabpanel" aria-labelledby="pills-subjects-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <h5 class="mb-0 text-gray-900">
                        <i class="ph ph-book-open me-8 text-main-600"></i>
                        My Subject Allocations
                    </h5>
                </div>
                <div class="card-body p-24">
                    <?php if (empty($subjectAllocations)): ?>
                    <div class="alert alert-info mb-0">
                        <i class="ph ph-info me-8"></i>
                        No subject allocations found.
                    </div>
                    <?php else: ?>
                    <div class="row g-20">
                        <?php foreach ($subjectAllocations as $allocation): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card border border-main-100 h-100 hover-shadow transition-2">
                                <div class="card-body p-20">
                                    <!-- Subject Icon & Name -->
                                    <div class="flex-align gap-12 mb-16">
                                        <span
                                            class="text-main-600 bg-main-50 w-48 h-48 rounded-circle flex-center text-2xl flex-shrink-0">
                                            <i class="ph-fill ph-book-bookmark"></i>
                                        </span>
                                        <div>
                                            <h6 class="mb-4 text-gray-900"><?= esc($allocation['subject_name']) ?></h6>
                                            <span class="text-13 text-gray-600">
                                                Class
                                                <?= esc($allocation['class_name']) ?><?= esc($allocation['section_label']) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Details -->
                                    <div class="pt-16 border-top border-gray-100">
                                        <div class="flex-align gap-6 mb-8">
                                            <i class="ph ph-chalkboard text-main-600"></i>
                                            <span class="text-13 text-gray-700">Section: <span
                                                    class="fw-medium"><?= esc($allocation['section_label']) ?></span></span>
                                        </div>
                                        <div class="flex-align gap-6">
                                            <i class="ph ph-calendar text-main-600"></i>
                                            <span class="text-13 text-gray-700">Since:
                                                <?= date('M Y', strtotime($allocation['created_at'])) ?></span>
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

        <!-- Class Teacher Tab -->
        <div class="tab-pane fade" id="pills-classes" role="tabpanel" aria-labelledby="pills-classes-tab" tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <h5 class="mb-0 text-gray-900">
                        <i class="ph ph-chalkboard-teacher me-8 text-main-600"></i>
                        Class Teacher Assignments
                    </h5>
                </div>
                <div class="card-body p-24">
                    <?php if (empty($classTeacherAssignments)): ?>
                    <div class="alert alert-info mb-0">
                        <i class="ph ph-info me-8"></i>
                        No class teacher assignments found.
                    </div>
                    <?php else: ?>
                    <div class="row g-20">
                        <?php foreach ($classTeacherAssignments as $assignment): ?>
                        <div class="col-lg-4">
                            <div class="card border border-main-200 bg-main-25 hover-shadow transition-2">
                                <div class="card-body p-24">
                                    <!-- Class Header -->
                                    <div class="flex-between mb-20 pb-20 border-bottom border-main-100">
                                        <div>
                                            <h5 class="mb-6 text-main-600">
                                                Class
                                                <?= esc($assignment['class_name']) ?><?= esc($assignment['section_label']) ?>
                                            </h5>
                                            <span class="text-13 text-gray-600">Primary Class Teacher</span>
                                        </div>
                                        <span
                                            class="bg-success-50 text-success-600 py-6 px-16 rounded-pill text-13 fw-medium">
                                            <i class="ph-fill ph-check-circle me-4"></i>
                                            Active
                                        </span>
                                    </div>

                                    <!-- Class Stats -->
                                    <div class="row g-16">
                                        <div class="col-6">
                                            <div class="p-16 bg-white rounded-8">
                                                <div class="flex-align gap-8 mb-6">
                                                    <i class="ph-fill ph-users-three text-main-600 text-xl"></i>
                                                    <span class="text-13 text-gray-600">Total Students</span>
                                                </div>
                                                <h5 class="mb-0 text-gray-900"><?= $assignment['student_count'] ?? 0 ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-16 bg-white rounded-8">
                                                <div class="flex-align gap-8 mb-6">
                                                    <i class="ph-fill ph-calendar-check text-main-600 text-xl"></i>
                                                    <span class="text-13 text-gray-600">Assigned Since</span>
                                                </div>
                                                <h6 class="mb-0 text-gray-900">
                                                    <?= date('M Y', strtotime($assignment['created_at'])) ?></h6>
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

        <!-- Documents Tab -->
        <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <div class="flex-between flex-wrap gap-16">
                        <h5 class="mb-0 text-gray-900">
                            <i class="ph ph-file-text me-8 text-main-600"></i>
                            My Documents
                        </h5>
                        <button type="button" class="btn btn-main rounded-pill py-9" data-bs-toggle="modal"
                            data-bs-target="#uploadDocumentModal">
                            <i class="ph ph-upload me-8"></i>
                            Upload Document
                        </button>
                    </div>
                </div>
                <div class="card-body p-24">
                    <?php if (empty($documents)): ?>
                    <div class="alert alert-info mb-0">
                        <i class="ph ph-info me-8"></i>
                        No documents uploaded yet. Click "Upload Document" to add your files.
                    </div>
                    <?php else: ?>
                    <div class="row g-20">
                        <?php foreach ($documents as $doc): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6" data-document-id="<?= $doc['id'] ?>">
                            <div class="card border border-gray-100 h-100 hover-shadow transition-2">
                                <div class="card-body p-20">
                                    <!-- Document Icon & Status -->
                                    <div class="flex-between gap-8 mb-16">
                                        <span
                                            class="text-main-600 bg-main-50 w-48 h-48 rounded-circle flex-center text-2xl flex-shrink-0">
                                            <i class="ph-fill ph-file-pdf"></i>
                                        </span>
                                        <?php
                                        $statusClass = 'warning';
                                        $statusText = 'Pending';
                                        $statusIcon = 'ph-clock';
                                        if (isset($doc['status'])) {
                                            if ($doc['status'] === 'verified') {
                                                $statusClass = 'success';
                                                $statusText = 'Verified';
                                                $statusIcon = 'ph-check-circle';
                                            } elseif ($doc['status'] === 'rejected') {
                                                $statusClass = 'danger';
                                                $statusText = 'Rejected';
                                                $statusIcon = 'ph-x-circle';
                                            }
                                        }
                                        ?>
                                        <span
                                            class="text-<?= $statusClass ?>-600 bg-<?= $statusClass ?>-100 py-4 px-12 rounded-pill text-13 fw-medium document-status">
                                            <i class="ph-fill <?= $statusIcon ?> me-4"></i>
                                            <?= $statusText ?>
                                        </span>
                                    </div>

                                    <!-- Document Type -->
                                    <h6 class="mb-6 text-gray-900"><?= esc($doc['document_type'] ?? 'Document') ?></h6>

                                    <!-- Document Name -->
                                    <p class="text-13 text-gray-600 mb-16 text-break"><?= esc($doc['document_name']) ?>
                                    </p>

                                    <!-- Upload Date -->
                                    <div class="flex-align gap-6 mb-20 pb-20 border-bottom border-gray-100">
                                        <i class="ph ph-calendar-blank text-main-600"></i>
                                        <span
                                            class="text-13 text-gray-600"><?= date('M d, Y', strtotime($doc['created_at'])) ?></span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex-align gap-8">
                                        <a href="<?= base_url('uploads/employees/documents/' . $doc['file']) ?>"
                                            class="btn btn-outline-main flex-grow-1 py-8 px-12 text-13" target="_blank"
                                            download>
                                            <i class="ph ph-download me-6"></i>
                                            Download
                                        </a>
                                        <button class="btn btn-danger py-8 px-12 text-13 delete-document-js"
                                            data-document-id="<?= $doc['id'] ?>" title="Delete Document">
                                            <i class="ph ph-trash"></i>
                                        </button>
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
    </div>
</div>

<!-- Upload Document Modal -->
<div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDocumentModalLabel">
                    <i class="ph ph-upload me-8 text-main-600"></i>
                    Upload Document
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadDocumentForm">
                    <div class="mb-20">
                        <label for="documentType" class="form-label mb-8 h6">
                            Document Type <span class="text-danger">*</span>
                        </label>
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
                        <label for="documentName" class="form-label mb-8 h6">
                            Document Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control py-11" id="documentName"
                            placeholder="e.g., Mathematics Teaching Certificate" required />
                    </div>
                    <div class="mb-20">
                        <label for="documentFile" class="form-label mb-8 h6">
                            Choose File <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control py-11" id="documentFile"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required />
                        <small class="text-muted">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-gray-400 rounded-pill py-9" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-main rounded-pill py-9" id="uploadDocumentBtn">
                    <i class="ph ph-upload me-8"></i>
                    Upload Document
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Include Scripts -->
<script src="<?= base_url('assets/plugins/sweetalert/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('assets/js/employee-details.js') ?>"></script>