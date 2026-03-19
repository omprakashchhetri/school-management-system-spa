<?php
/**
 * View: pages/student-module-pages/student-details.php
 *
 * Variables available:
 *  $studentData        – associative array from students + classes + sections JOIN
 *  $attendance         – ['rows'=>[], 'total'=>int, 'pager'=>string]
 *  $attendanceSummary  – ['total','present','absent','late','percentage']
 *  $fees               – ['rows'=>[], 'total'=>int, 'pager'=>string]
 *  $assignments        – ['rows'=>[], 'total'=>int, 'pager'=>string]
 *  $assignmentStats    – ['total','submitted','pending','overdue']
 *  $assignmentSubjects – [['id','subject_name'], ...]
 *  $marks              – ['rows'=>[], 'total'=>int, 'pager'=>string]
 *  $marksByExam        – [exam_id => ['exam_title','subjects',[...],'total_obtained','total_max','percentage','division']]
 *  $documents          – ['rows'=>[], 'total'=>int, 'pager'=>string]
 */

// ── Helpers ──────────────────────────────────────────────────────────────────

/** Badge classes for attendance status */
function attendanceBadge(string $status): string {
    return match(strtolower($status)) {
        'present' => 'bg-success',
        'absent'  => 'bg-danger',
        'late'    => 'bg-warning text-dark',
        default   => 'bg-secondary',
    };
}

/** Badge classes for assignment status */
function assignmentBadge(string $status): array {
    return match($status) {
        'submitted' => ['text-success-600 bg-success-100', 'Submitted'],
        'overdue'   => ['text-danger-600 bg-danger-100',   'Overdue'],
        default     => ['text-warning-600 bg-warning-100', 'Pending'],
    };
}

/** Badge classes for fee status */
function feeBadge(string $status): string {
    return match(strtolower($status)) {
        'paid'    => 'bg-success',
        'partial' => 'bg-info',
        'overdue' => 'bg-danger',
        default   => 'bg-warning text-dark',
    };
}

/** Badge classes for document status */
function documentStatusBadge(string $status): array {
    return match(strtolower($status)) {
        'verified' => ['text-success-600 bg-success-100', 'Verified'],
        'rejected' => ['text-danger-600 bg-danger-100',   'Rejected'],
        default    => ['text-warning-600 bg-warning-100', 'Pending'],
    };
}

/** Grade badge colour */
function gradeBadgeClass(string $grade): string {
    return match(true) {
        in_array($grade, ['A+', 'A']) => 'bg-success-100 text-success-600',
        in_array($grade, ['B+', 'B']) => 'bg-info-100 text-info-600',
        $grade === 'C'                => 'bg-warning-100 text-warning-600',
        $grade === 'F'                => 'bg-danger-100 text-danger-600',
        default                       => 'bg-secondary-100 text-secondary-600',
    };
}

$sd = $studentData; // shorthand
?>

<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="dashboard" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><a href="profile" class="text-gray-200 fw-normal text-15 hover-text-main-600">Students</a></li>
            <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
            <li><span class="text-main-600 fw-normal text-15">Student Details</span></li>
        </ul>
    </div>

    <!-- ═══════════════════════════════════════════
         PROFILE HEADER CARD
    ════════════════════════════════════════════ -->
    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="cover-img position-relative">
                <label for="coverImageUpload"
                    class="btn border-gray-200 text-gray-200 fw-normal hover-bg-gray-400 rounded-pill py-4 px-14 position-absolute inset-block-start-0 inset-inline-end-0 mt-24 me-24">
                    Edit Cover
                </label>
                <div class="avatar-upload">
                    <input type="file" id="coverImageUpload" accept=".png, .jpg, .jpeg" />
                    <div class="avatar-preview">
                        <div id="coverImagePreview"
                            style="background-image: url('https://images.unsplash.com/photo-1599454100789-b211e369bd04?q=80&w=1306&auto=format&fit=crop');"></div>
                    </div>
                </div>
            </div>

            <div class="setting-profile px-24" style="margin-top: -50px;">
                <div class="flex-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap mb-20 gap-24">
                        <?php
                        $profileImg = !empty($sd['profile_image'])
                            ? base_url('uploads/students/' . $sd['profile_image'])
                            : 'https://ui-avatars.com/api/?name=' . urlencode(($sd['firstname'] ?? '') . ' ' . ($sd['lastname'] ?? '')) . '&background=random&size=120';
                        ?>
                        <img src="<?= esc($profileImg) ?>"
                             alt="<?= esc($sd['firstname']) ?>"
                             class="w-120 h-120 rounded-circle border border-white object-fit-cover" />
                        <div>
                            <h4 class="mb-8">
                                <?= esc($sd['firstname']) ?>
                                <?= !empty($sd['middlename']) ? esc($sd['middlename']) . ' ' : '' ?>
                                <?= esc($sd['lastname']) ?>
                            </h4>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-student"></i></span>
                                    <span class="text-gray-600 text-15">
                                        Grade <?= esc($sd['class_name'] ?? '–') ?> – <?= esc($sd['section_label'] ?? '–') ?>
                                    </span>
                                </div>
                                <?php if (!empty($sd['admission_no'])): ?>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-identification-card"></i></span>
                                    <span class="text-gray-600 text-15"><?= esc($sd['admission_no']) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($sd['admission_date'])): ?>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-calendar-dots"></i></span>
                                    <span class="text-gray-600 text-15">
                                        Enrolled <?= date('M Y', strtotime($sd['admission_date'])) ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                                <div class="flex-align gap-6">
                                    <span class="badge badge-sm bg-success-50 text-success-600 text-15">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab navigation -->
                <ul class="nav common-tab style-two nav-pills mb-0 flex-nowrap overflow-x-auto pb-5" id="pills-tab" role="tablist">
                    <?php
                    $tabs = [
                        ['details',     'Personal Details'],
                        ['fees',        'Fees History'],
                        ['attendance',  'Attendance'],
                        ['assignments', 'Assignments'],
                        ['marksheets',  'Marksheets'],
                        ['documents',   'Documents'],
                    ];
                    foreach ($tabs as $i => [$key, $label]):
                    ?>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link <?= $i === 0 ? 'active' : '' ?>"
                                id="pills-<?= $key ?>-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#pills-<?= $key ?>"
                                type="button" role="tab"
                                aria-controls="pills-<?= $key ?>"
                                aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                            <?= $label ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div><!-- /.setting-profile -->
        </div>
    </div><!-- /.card (header) -->


    <div class="tab-content" id="pills-tabContent">

        <!-- ═══════════════════════════════════════════
             TAB 1 – PERSONAL DETAILS
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
             aria-labelledby="pills-details-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Personal Information</h4>
                    <p class="text-gray-600 text-15">Student personal details and contact information</p>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">First Name</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['firstname']) ?>" placeholder="First Name"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Middle Name</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['middlename'] ?? '') ?>" placeholder="Middle Name"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Last Name</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['lastname']) ?>" placeholder="Last Name"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Roll Number</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['roll_no'] ?? '') ?>" placeholder="Roll No"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Email</label>
                                <input type="email" class="form-control py-11"
                                       value="<?= esc($sd['student_email'] ?? '') ?>" placeholder="Email"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Phone Number</label>
                                <input type="tel" class="form-control py-11"
                                       value="<?= esc($sd['student_contact_no'] ?? '') ?>" placeholder="Phone"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Admission Date</label>
                                <input type="date" class="form-control py-11"
                                       value="<?= esc($sd['admission_date'] ?? '') ?>"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Blood Group</label>
                                <?php $bg = $sd['blood_group'] ?? ''; ?>
                                <select class="form-control form-select py-11" readonly disabled>
                                    <option value="">Select Blood Group</option>
                                    <?php foreach (['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $g): ?>
                                    <option value="<?= $g ?>" <?= $bg === $g ? 'selected' : '' ?>><?= $g ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Religion</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['student_religion'] ?? '') ?>" placeholder="Religion"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Caste</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['student_caste'] ?? '') ?>" placeholder="Caste"  readonly disabled/>
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-8 h6">Address</label>
                                <textarea class="form-control py-11" rows="2" placeholder="Address" readonly disabled><?= esc(
                                    implode(', ', array_filter([
                                        $sd['street']   ?? '',
                                        $sd['city']     ?? '',
                                        $sd['district'] ?? '',
                                        $sd['pincode']  ?? '',
                                        $sd['country']  ?? '',
                                    ]))
                                ) ?></textarea>
                            </div>

                            <!-- Parent / Guardian -->
                            <div class="col-12 mt-8">
                                <h6 class="text-main-600 mb-16 border-bottom pb-8">Parent / Guardian Details</h6>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Father's Name</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['father_name'] ?? '') ?>" placeholder="Father's Name"  readonly disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Father's Contact</label>
                                <input type="tel" class="form-control py-11"
                                       value="<?= esc($sd['father_contact_no'] ?? '') ?>" placeholder="Father Phone"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Mother's Name</label>
                                <input type="text" class="form-control py-11"
                                       value="<?= esc($sd['mother_name'] ?? '') ?>" placeholder="Mother's Name"  readonly disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label mb-8 h6">Mother's Contact</label>
                                <input type="tel" class="form-control py-11"
                                       value="<?= esc($sd['mother_contact_no'] ?? '') ?>" placeholder="Mother Phone"  readonly disabled/>
                            </div>

                            
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /#pills-details -->


        <!-- ═══════════════════════════════════════════
             TAB 2 – FEES HISTORY
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade" id="pills-fees" role="tabpanel"
             aria-labelledby="pills-fees-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-8">
                        <div>
                            <h4 class="mb-4">Fee Records</h4>
                            <p class="text-gray-600 text-15">Student fee payment history</p>
                        </div>
                        <?php if (!empty($fees['total'])): ?>
                        <span class="badge bg-main-100 text-main-600 py-6 px-14 text-14 fw-semibold">
                            <?= $fees['total'] ?> record(s)
                        </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-0 overflow-x-auto">
                    <?php if (empty($fees['rows'])): ?>
                        <div class="text-center py-40 text-gray-400">
                            <i class="ph ph-wallet text-48 mb-12 d-block"></i>
                            No fee records found.
                        </div>
                    <?php else: ?>
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Payable Amount</th>
                                <th>Paid Amount</th>
                                <th>Discount</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Month</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fees['rows'] as $i => $fee): ?>
                                <?php
                                $status = 'pending';

                                if ($fee['due_amount'] <= 0) {
                                    $status = 'paid';
                                } elseif ($fee['paid_amount'] > 0) {
                                    $status = 'partial';
                                }
                                ?>
                            <tr>
                                <td class="text-gray-400 text-14"><?= $i + 1 ?></td>
                                <td class="fw-medium text-gray-300">
                                    ₹<?= number_format((float)$fee['payable_amount'], 2) ?>
                                </td>
                                <td class="fw-medium text-gray-300">
                                    ₹<?= number_format((float)$fee['paid_amount'], 2) ?>
                                </td>
                                <td>
                                    ₹<?= number_format($fee['fee_discount'] + $fee['student_discount'],2) ?>
                                </td>
                                <td>
                                    ₹<?= number_format($fee['due_amount'],2) ?>
                                </td>
                                <td>
                                    <span class="badge <?= feeBadge($status) ?>">
                                        <?= esc(ucfirst($status)) ?>
                                    </span>
                                </td>
                                <td class="fw-medium text-gray-300 text-14">
                                    <span><?= esc($fee['month']) ?> / <?= esc($fee['year']) ?></span>
                                </td>
                                <td class="fw-medium text-gray-300 text-14">
                                    <?= date('d M Y', strtotime($fee['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if (strtolower($status) === 'paid'): ?>
                                        <button class="btn btn-info btn-sm py-4 px-10">
                                            <i class="ph ph-download me-4"></i>Receipt
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-main btn-sm py-4 px-10">
                                            <i class="ph ph-credit-card me-4"></i>Pay Now
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

                <?php if (!empty($fees['pager'])): ?>
                <div class="card-footer">
                    <?= $fees['pager'] ?>
                </div>
                <?php endif; ?>
            </div>
        </div><!-- /#pills-fees -->


        <!-- ═══════════════════════════════════════════
             TAB 3 – ATTENDANCE
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade" id="pills-attendance" role="tabpanel"
             aria-labelledby="pills-attendance-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Attendance Record</h4>
                    <p class="text-gray-600 text-15">Student attendance tracking and statistics</p>
                </div>
                <div class="card-body">

                    <!-- Summary cards -->
                    <div class="row gy-4 mb-24">
                        <?php
                        $attCards = [
                            ['total',      'bg-main-50',    'bg-main-600',    'ph-calendar',       'Total Days',   $attendanceSummary['total']],
                            ['present',    'bg-success-50', 'bg-success-600', 'ph-check-circle',   'Present',      $attendanceSummary['present']],
                            ['absent',     'bg-danger-50',  'bg-danger-600',  'ph-x-circle',       'Absent',       $attendanceSummary['absent']],
                            ['percentage', 'bg-warning-50', 'bg-warning-600', 'ph-percent',        'Attendance %', $attendanceSummary['percentage'] . '%'],
                        ];
                        foreach ($attCards as [$key, $bg, $iconBg, $icon, $label, $value]):
                        ?>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-16 flex-align gap-10 rounded-8 <?= $bg ?>">
                                <span class="text-white <?= $iconBg ?> w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph <?= $icon ?>"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0"><?= $value ?></h4>
                                    <span class="fw-medium text-14"><?= $label ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="card-body p-0 overflow-x-auto">
                    <?php if (empty($attendance['rows'])): ?>
                        <div class="text-center py-40 text-gray-400">
                            <i class="ph ph-calendar-blank text-48 mb-12 d-block"></i>
                            No attendance records found.
                        </div>
                    <?php else: ?>
                    <table class="table table-striped align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attendance['rows'] as $att): ?>
                            <tr>
                                <td class="fw-medium text-gray-300">
                                    <?= date('d M Y', strtotime($att['date'])) ?>
                                </td>
                                <td class="fw-medium text-gray-300">
                                    <?= date('l', strtotime($att['date'])) ?>
                                </td>
                                <td>
                                    <span class="badge <?= attendanceBadge($att['status']) ?>">
                                        <?= esc(ucfirst($att['status'])) ?>
                                    </span>
                                </td>
                                <td class="fw-medium text-gray-300">
                                    <?= !empty($att['punch_in']) ? date('h:i A', strtotime($att['punch_in'])) : '–' ?>
                                </td>
                                <td class="fw-medium text-gray-300">
                                    <?= !empty($att['punch_out']) ? date('h:i A', strtotime($att['punch_out'])) : '–' ?>
                                </td>
                                <td class="text-gray-300 text-14">
                                    <?= esc(ucfirst($att['attendance_type'] ?? '–')) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

                <?php if (!empty($attendance['pager'])): ?>
                <div class="card-footer">
                    <?= $attendance['pager'] ?>
                </div>
                <?php endif; ?>
            </div>
        </div><!-- /#pills-attendance -->


        <!-- ═══════════════════════════════════════════
             TAB 4 – ASSIGNMENTS
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade" id="pills-assignments" role="tabpanel"
             aria-labelledby="pills-assignments-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Assignments</h4>
                            <p class="text-gray-600 text-15">Student assignments and submission status</p>
                        </div>
                        <!-- Subject filter -->
                        <?php $currentSubjectFilter = service('request')->getGet('assignment_subject'); ?>
                        <form method="GET" class="flex-align gap-8">
                            <select name="assignment_subject" class="form-control form-select py-6"
                                    onchange="this.form.submit()">
                                <option value="all">All Subjects</option>
                                <?php foreach ($assignmentSubjects as $subj): ?>
                                <option value="<?= $subj['id'] ?>"
                                    <?= ($currentSubjectFilter == $subj['id']) ? 'selected' : '' ?>>
                                    <?= esc($subj['subject_name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Stats cards -->
                    <div class="row gy-4 mb-24">
                        <?php
                        $aCards = [
                            ['bg-main-50',    'bg-main-600',    'ph-files',        'text-main-600',    'Total Assignments', $assignmentStats['total']],
                            ['bg-success-50', 'bg-success-600', 'ph-check-circle', 'text-success-600', 'Submitted',         $assignmentStats['submitted']],
                            ['bg-warning-50', 'bg-warning-600', 'ph-clock',        'text-warning-600', 'Pending',           $assignmentStats['pending']],
                            ['bg-danger-50',  'bg-danger-600',  'ph-warning',      'text-danger-600',  'Overdue',           $assignmentStats['overdue']],
                        ];
                        foreach ($aCards as [$bg, $iconBg, $icon, $textColor, $label, $value]):
                        ?>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-16 flex-align gap-10 rounded-8 <?= $bg ?>">
                                <span class="text-white <?= $iconBg ?> w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph <?= $icon ?>"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0"><?= $value ?></h4>
                                    <span class="fw-medium <?= $textColor ?>"><?= $label ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="card-body p-0 overflow-x-auto">
                    <?php if (empty($assignments['rows'])): ?>
                        <div class="text-center py-40 text-gray-400">
                            <i class="ph ph-files text-48 mb-12 d-block"></i>
                            No assignments found.
                        </div>
                    <?php else: ?>
                    <table class="table table-striped align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="h6 text-dark fw-bold">Subject</th>
                                <th class="h6 text-dark fw-bold">Assignment Title</th>
                                <th class="h6 text-dark fw-bold">Assigned Date</th>
                                <th class="h6 text-dark fw-bold">Due Date</th>
                                <th class="h6 text-dark fw-bold">Status</th>
                                <th class="h6 text-dark fw-bold">Marks</th>
                                <th class="h6 text-dark fw-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assignments['rows'] as $asn):
                                [$badgeClass, $badgeLabel] = assignmentBadge($asn['status']);
                            ?>
                            <tr>
                                <td>
                                    <span class="text-dark"><?= esc($asn['subject_name'] ?? '–') ?></span>
                                </td>
                                <td>
                                    <span class="fw-medium text-gray-300"><?= esc($asn['topic']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-medium text-gray-300">
                                        <?= date('d M Y', strtotime($asn['assigned_date'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-medium text-gray-300 <?= $asn['status'] === 'overdue' ? 'text-danger' : '' ?>">
                                        <?= date('d M Y', strtotime($asn['deadline_date'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-sm <?= $badgeClass ?> py-1 px-10 rounded-pill">
                                        <?= $badgeLabel ?>
                                    </span>
                                </td>
                                <td class="text-dark">
                                    <?php if (!empty($asn['marks'])): ?>
                                        <?= esc($asn['marks']) ?>
                                        <?= !empty($asn['grade']) ? ' (' . esc($asn['grade']) . ')' : '' ?>
                                    <?php else: ?>
                                        <span class="text-muted">–</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($asn['status'] === 'submitted'): ?>
                                        <button class="btn btn-info py-4 px-10 text-13">
                                            <i class="ph ph-eye me-4"></i>View
                                        </button>
                                    <?php elseif ($asn['status'] === 'overdue'): ?>
                                        <button class="btn btn-danger py-4 px-10 text-13">
                                            <i class="ph ph-upload me-4"></i>Submit Now
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-main py-4 px-10 text-13">
                                            <i class="ph ph-upload me-4"></i>Submit
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

                <?php if (!empty($assignments['pager'])): ?>
                <div class="card-footer">
                    <?= $assignments['pager'] ?>
                </div>
                <?php endif; ?>
            </div>
        </div><!-- /#pills-assignments -->


        <!-- ═══════════════════════════════════════════
             TAB 5 – MARKSHEETS (grouped by exam)
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade" id="pills-marksheets" role="tabpanel"
             aria-labelledby="pills-marksheets-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Examination Results</h4>
                    <p class="text-gray-600 text-15">Student marksheets and academic performance</p>
                </div>
                <div class="card-body">

                    <?php if (empty($marksByExam)): ?>
                        <div class="text-center py-40 text-gray-400">
                            <i class="ph ph-clipboard-text text-48 mb-12 d-block"></i>
                            No examination results available yet.
                        </div>
                    <?php else: ?>

                        <?php foreach ($marksByExam as $examId => $exam): ?>
                        <div class="card border border-main-200 mb-24">
                            <div class="card-header border-bottom border-main-100 bg-main-50">
                                <div class="flex-between flex-wrap gap-8">
                                    <div>
                                        <h5 class="mb-2 text-main-600"><?= esc($exam['exam_title']) ?></h5>
                                        <?php if (!empty($exam['exam_startdate'])): ?>
                                        <span class="text-gray-500 text-13">
                                            <?= date('d M Y', strtotime($exam['exam_startdate'])) ?>
                                            <?= !empty($exam['exam_enddate']) ? ' – ' . date('d M Y', strtotime($exam['exam_enddate'])) : '' ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                        <i class="ph ph-download me-6"></i>Download Marksheet
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0 overflow-x-auto">
                                <table class="table table-bordered mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="h6 text-dark fw-bold">Subject</th>
                                            <th class="h6 text-dark fw-bold text-center">Max Marks</th>
                                            <th class="h6 text-dark fw-bold text-center">Obtained</th>
                                            <th class="h6 text-dark fw-bold text-center">Grade</th>
                                            <th class="h6 text-dark fw-bold text-center">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($exam['subjects'] as $subRow): ?>
                                        <tr>
                                            <td class="text-dark fw-semibold"><?= esc($subRow['subject_name']) ?></td>
                                            <td class="text-center text-dark"><?= $subRow['max_marks'] ?></td>
                                            <td class="text-center text-dark fw-medium"><?= $subRow['obtained_marks'] ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= gradeBadgeClass($subRow['grade']) ?> py-2 px-12">
                                                    <?= esc($subRow['grade']) ?>
                                                </span>
                                            </td>
                                            <td class="text-center text-muted"><?= esc($subRow['remarks']) ?></td>
                                        </tr>
                                        <?php endforeach; ?>

                                        <!-- Total row -->
                                        <tr class="bg-main-25 fw-bold">
                                            <td class="text-dark fw-bold">Total</td>
                                            <td class="text-center text-dark"><?= $exam['total_max'] ?></td>
                                            <td class="text-center text-dark"><?= $exam['total_obtained'] ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-success-100 text-success-600 py-2 px-12 fw-bold">
                                                    <?= $exam['percentage'] ?>%
                                                </span>
                                            </td>
                                            <td class="text-center text-dark"><?= esc($exam['division']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.exam card -->
                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </div>
        </div><!-- /#pills-marksheets -->


        <!-- ═══════════════════════════════════════════
             TAB 6 – DOCUMENTS
        ════════════════════════════════════════════ -->
        <div class="tab-pane fade" id="pills-documents" role="tabpanel"
             aria-labelledby="pills-documents-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Student Documents</h4>
                            <p class="text-gray-600 text-15">Important documents and certificates</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 overflow-x-auto">
                    <?php if (empty($documents['rows'])): ?>
                        <div class="text-center py-40 text-gray-400">
                            <i class="ph ph-folder-open text-48 mb-12 d-block"></i>
                            No documents uploaded yet.
                        </div>
                    <?php else: ?>
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="h6 text-gray-600">Document Name</th>
                                <th class="h6 text-gray-600">Type</th>
                                <th class="h6 text-gray-600">Upload Date</th>
                                <th class="h6 text-gray-600 text-center">Status</th>
                                <th class="h6 text-gray-600 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documents['rows'] as $doc):
                                [$docBadgeClass, $docBadgeLabel] = documentStatusBadge($doc['status']);
                            ?>
                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg">
                                            <i class="ph ph-file-text"></i>
                                        </span>
                                        <span class="text-dark fw-semibold"><?= esc($doc['document_name']) ?></span>
                                    </div>
                                </td>
                                <td class="text-dark text-14"><?= esc($doc['document_type'] ?? '–') ?></td>
                                <td class="text-dark text-14">
                                    <?= date('d M Y', strtotime($doc['created_at'])) ?>
                                </td>
                                <td class="text-center">
                                    <span class="<?= $docBadgeClass ?> py-2 px-10 rounded-pill text-13">
                                        <?= $docBadgeLabel ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <a href="<?= base_url('uploads/documents/' . $doc['file']) ?>"
                                           target="_blank"
                                           class="btn btn-outline-main py-6 px-12 text-13">View</a>
                                        <a href="<?= base_url('uploads/documents/' . $doc['file']) ?>"
                                           download
                                           class="btn btn-secondary py-6 px-12 text-13">Download</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>

                <?php if (!empty($documents['pager'])): ?>
                <div class="card-footer">
                    <?= $documents['pager'] ?>
                </div>
                <?php endif; ?>
            </div>
        </div><!-- /#pills-documents -->

    </div><!-- /.tab-content -->

</div><!-- /.dashboard-body -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(function () {
    // ── Cover image preview ────────────────────────────────────────────────
    $('#coverImageUpload').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => $('#coverImagePreview').css('background-image', `url(${e.target.result})`);
            reader.readAsDataURL(file);
        }
    });

    // ── Preserve active tab across page reloads (e.g. after filter submit) ─
    const tabParam = new URLSearchParams(location.search).get('tab');
    if (tabParam) {
        const target = document.querySelector(`#pills-${tabParam}-tab`);
        if (target) bootstrap.Tab.getOrCreateInstance(target).show();
    }

    // Keep ?tab= in filter form submissions so we stay on the right tab
    $('[data-bs-toggle="pill"]').on('shown.bs.tab', function () {
        const id = this.id.replace('pills-', '').replace('-tab', '');
        const url = new URL(location.href);
        url.searchParams.set('tab', id);
        history.replaceState(null, '', url.toString());
    });
});
</script>