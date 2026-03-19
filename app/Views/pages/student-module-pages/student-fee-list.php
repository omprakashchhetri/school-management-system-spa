<?php
function feeBadge(string $status): array
{
    return match (strtolower($status)) {
        'paid' => ['bg-success-50 text-success-600', 'bg-success-600', 'Paid'],
        'partial' => ['bg-info-50 text-info-600', 'bg-info-600', 'Partial'],
        'overdue' => ['bg-danger-50 text-danger-600', 'bg-danger-600', 'Overdue'],
        default => ['bg-warning-50 text-warning-600', 'bg-warning-600', 'Pending'],
    };
}

$request = service('request');

$page = max(1, (int) ($request->getGet('fees_page') ?? 1));
$from = (($page - 1) * 15) + 1;
$to = min($page * 15, $fees['total']);

$currentFilter = $request->getGet('fee_status') ?? 'all';
?>

<div class="dashboard-body">

    <!-- Breadcrumb + Filter -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">

        <div class="breadcrumb mb-0">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?= base_url('student/dashboard') ?>"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">
                        Home
                    </a>
                </li>
                <li><span class="text-gray-500 d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Fee Payments</span></li>
            </ul>
        </div>

        <!-- FILTER -->
        <form method="GET">
            <div class="flex-align gap-8">
                <select name="fee_status" class="form-control form-select py-10" onchange="this.form.submit()">
                    <option value="all">All Status</option>
                    <option value="paid" <?= $currentFilter == 'paid' ? 'selected' : '' ?>>Paid</option>
                    <option value="pending" <?= $currentFilter == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="overdue" <?= $currentFilter == 'overdue' ? 'selected' : '' ?>>Overdue</option>
                </select>
            </div>
        </form>

    </div>

    <!-- COUNTERS -->
    <div class="row gy-4 mb-24">

        <?php
        $cards = [
            ['bg-main-50','bg-main-600','ph-wallet','Total',$stats['total']],
            ['bg-success-50','bg-success-600','ph-check-circle','Paid',$stats['paid']],
            ['bg-warning-50','bg-warning-600','ph-clock','Pending',$stats['pending']],
            ['bg-danger-50','bg-danger-600','ph-warning','Overdue',$stats['overdue']],
        ];
        foreach($cards as [$bg,$iconBg,$icon,$label,$val]):
        ?>

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 <?= $bg ?>">
                <span class="text-white <?= $iconBg ?> w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph <?= $icon ?>"></i>
                </span>
                <div>
                    <h4 class="mb-0"><?= $val ?></h4>
                    <span class="fw-medium text-14"><?= $label ?></span>
                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <!-- TABLE -->
    <div class="card overflow-hidden">

        <div class="card-body p-0">

            <?php if (empty($fees['rows'])): ?>

                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-wallet" style="font-size:3rem;"></i>
                    <p class="mt-12 text-16 fw-medium">No fee records found.</p>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">
                            <tr>
                                <th>Month</th>
                                <th>Payable</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($fees['rows'] as $row):

                                // 🔥 DERIVED STATUS
                                $status = 'pending';

                                if ($row['due_amount'] <= 0) {
                                    $status = 'paid';
                                } elseif ($row['paid_amount'] > 0) {
                                    $status = 'partial';
                                }

                                // overdue override
                                if ($status !== 'paid' && strtotime($row['due_date']) < time()) {
                                    $status = 'overdue';
                                }

                                [$badgeBg, $dotBg, $label] = feeBadge($status);
                            ?>

                            <tr>

                                <!-- Month -->
                                <td class="fw-medium text-dark">
                                    <?= esc($row['month']) ?> / <?= esc($row['year']) ?>
                                </td>

                                <!-- Payable -->
                                <td class="fw-medium text-dark">
                                    ₹<?= number_format($row['payable_amount'], 2) ?>
                                </td>

                                <!-- Paid -->
                                <td class="text-gray-300">
                                    ₹<?= number_format($row['paid_amount'], 2) ?>
                                </td>

                                <!-- Due -->
                                <td class="text-danger fw-medium">
                                    ₹<?= number_format(max(0,$row['due_amount']), 2) ?>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">
                                        <span class="w-6 h-6 <?= $dotBg ?> rounded-circle"></span>
                                        <?= $label ?>
                                    </span>
                                </td>

                                <!-- Due Date -->
                                <td class="text-gray-300 text-14">
                                    <?= date('d M Y', strtotime($row['due_date'])) ?>
                                </td>

                                <!-- Action -->
                                <td>
                                    <?php if ($status === 'paid'): ?>
                                        <button class="btn btn-info py-4 px-10 text-13">
                                            <i class="ph ph-download me-4"></i>Receipt
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-main py-4 px-10 text-13">
                                            <i class="ph ph-credit-card me-4"></i>Pay Now
                                        </button>
                                    <?php endif; ?>
                                </td>

                            </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php endif; ?>

        </div>

        <?php if (!empty($fees['rows'])): ?>

            <div class="card-footer flex-between flex-wrap gap-8 py-16 px-24">

                <span class="text-gray-900 text-14">
                    Showing <strong><?= $from ?></strong>–<strong><?= $to ?></strong>
                    of <strong><?= $fees['total'] ?></strong> record(s)
                </span>

                <?= $fees['pager'] ?>

            </div>

        <?php endif; ?>

    </div>

</div>