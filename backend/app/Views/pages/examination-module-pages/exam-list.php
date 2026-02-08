<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a class="nav_js" href="<?=('employee/dashboard') ?>"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Examinations</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <a href="<?=('examination/create-routine') ?>"
                class="nav_js btn btn-main text-sm btn-sm px-24 py-12 rounded-8">
                <i class="ph ph-plus me-8"></i>
                Create Exam Routine
            </a>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Statistics Cards Start -->
    <div class="row g-3 mb-24">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Total Exams</span>
                            <h5 class="text-gray-900 mb-0"><?= count($exams ?? []) ?></h5>
                        </div>
                        <div class="w-48 h-48 bg-main-50 rounded-circle flex-center">
                            <i class="ph ph-exam text-main-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Upcoming</span>
                            <h5 class="text-gray-900 mb-0" id="upcomingCount">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-success-50 rounded-circle flex-center">
                            <i class="ph ph-calendar-check text-success-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Ongoing</span>
                            <h5 class="text-gray-900 mb-0" id="ongoingCount">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-warning-50 rounded-circle flex-center">
                            <i class="ph ph-hourglass text-warning-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="flex-between gap-8">
                        <div>
                            <span class="text-gray-600 text-sm mb-8 d-block">Completed</span>
                            <h5 class="text-gray-900 mb-0" id="completedCount">0</h5>
                        </div>
                        <div class="w-48 h-48 bg-purple-50 rounded-circle flex-center">
                            <i class="ph ph-check-circle text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistics Cards End -->

    <!-- Exams List Start -->
    <div class="card">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">All Examinations</h6>
            <div class="flex-align gap-8 flex-wrap">
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-funnel"></i></span>
                    <select class="form-control ps-8 pe-20 py-12 border-0 text-inherit rounded-4 text-sm"
                        id="statusFilter">
                        <option value="">All Status</option>
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="examsTable">
                    <thead class="bg-main-50">
                        <tr>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">#</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Exam Title</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Start Date</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">End Date</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Duration</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold">Status</th>
                            <th class="px-24 py-16 text-gray-900 fw-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($exams)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-32">
                                <i class="ph ph-exam text-gray-300" style="font-size: 48px;"></i>
                                <p class="text-gray-500 mt-8 mb-0">No examinations found</p>
                                <a class="nav_js" href="<?=('examination/create-routine') ?>"
                                    class="btn btn-main text-sm px-24 py-12 rounded-8 mt-16">
                                    <i class="ph ph-plus me-8"></i>
                                    Create First Exam
                                </a>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($exams as $index => $exam): ?>
                        <?php
                                $startDate = new DateTime($exam['exam_startdate']);
                                $endDate = new DateTime($exam['exam_enddate']);
                                $today = new DateTime();
                                $today->setTime(0, 0, 0);
                                
                                // Calculate status
                                if ($today < $startDate) {
                                    $status = 'upcoming';
                                    $statusBadge = 'bg-success-50 text-success-600';
                                    $statusText = 'Upcoming';
                                } elseif ($today > $endDate) {
                                    $status = 'completed';
                                    $statusBadge = 'bg-purple-50 text-purple-600';
                                    $statusText = 'Completed';
                                } else {
                                    $status = 'ongoing';
                                    $statusBadge = 'bg-warning-50 text-warning-600';
                                    $statusText = 'Ongoing';
                                }
                                
                                // Calculate duration
                                $duration = $startDate->diff($endDate)->days + 1;
                                ?>
                        <tr data-status="<?= $status ?>">
                            <td class="px-24 py-16"><?= $index + 1 ?></td>
                            <td class="px-24 py-16">
                                <h6 class="text-gray-900 mb-4"><?= esc($exam['exam_title']) ?></h6>
                                <?php if (!empty($exam['exam_description'])): ?>
                                <p class="text-gray-600 text-sm mb-0">
                                    <?= esc(substr($exam['exam_description'], 0, 50)) ?><?= strlen($exam['exam_description']) > 50 ? '...' : '' ?>
                                </p>
                                <?php endif; ?>
                            </td>
                            <td class="px-24 py-16">
                                <span class="text-gray-900"><?= $startDate->format('M d, Y') ?></span>
                            </td>
                            <td class="px-24 py-16">
                                <span class="text-gray-900"><?= $endDate->format('M d, Y') ?></span>
                            </td>
                            <td class="px-24 py-16">
                                <span class="text-gray-600"><?= $duration ?> day<?= $duration > 1 ? 's' : '' ?></span>
                            </td>
                            <td class="px-24 py-16">
                                <span class="badge <?= $statusBadge ?> px-16 py-8">
                                    <?= $statusText ?>
                                </span>
                            </td>
                            <td class="px-24 py-16 text-center">
                                <div class="flex-center gap-10">
                                    <a href="<?=('examination/exam-details/' . $exam['id']) ?>"
                                        class="nav_js bg-main-100 text-main-600 pb-5 pt-7 px-10 rounded-pill hover-bg-main-600 hover-text-white"
                                        title="View Details">
                                        <i class="ph ph-eye"></i>
                                    </a>
                                    <a href="<?=('examination/edit-exam-routine/' . $exam['id']) ?>"
                                        class="nav_js bg-success-100 text-success-600 pb-5 pt-7 px-10 rounded-pill hover-bg-success-600 hover-text-white"
                                        title="Edit Routine">
                                        <i class="ph ph-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Exams List End -->
</div>

<script>
$(document).ready(function() {
    // Calculate statistics
    calculateStatistics();

    // Status filter
    $('#statusFilter').change(function() {
        const status = $(this).val();

        if (!status) {
            $('#examsTable tbody tr').show();
        } else {
            $('#examsTable tbody tr').hide();
            $('#examsTable tbody tr[data-status="' + status + '"]').show();
        }
    });

    // Calculate statistics from table
    function calculateStatistics() {
        const upcoming = $('#examsTable tbody tr[data-status="upcoming"]').length;
        const ongoing = $('#examsTable tbody tr[data-status="ongoing"]').length;
        const completed = $('#examsTable tbody tr[data-status="completed"]').length;

        $('#upcomingCount').text(upcoming);
        $('#ongoingCount').text(ongoing);
        $('#completedCount').text(completed);
    }
});
</script>