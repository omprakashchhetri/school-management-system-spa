<?php
/**
 * View: fee-list.php
 *
 * Variables:
 * $fees
 * $stats
 */

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

                <li>
                    <span class="text-gray-500 fw-normal d-flex">
                        <i class="ph ph-caret-right"></i>
                    </span>
                </li>

                <li>
                    <span class="text-main-600 fw-normal text-15">
                        Fee Payments
                    </span>
                </li>
            </ul>
        </div>

        <!-- FILTER -->

        <form method="GET">

            <div class="flex-align gap-8">

                <select name="fee_status" class="form-control form-select py-10" onchange="this.form.submit()">

                    <option value="all">All Status</option>

                    <option value="paid" <?= $currentFilter == 'paid' ? 'selected' : '' ?>>
                        Paid
                    </option>

                    <option value="pending" <?= $currentFilter == 'pending' ? 'selected' : '' ?>>
                        Pending
                    </option>

                    <option value="overdue" <?= $currentFilter == 'overdue' ? 'selected' : '' ?>>
                        Overdue
                    </option>

                </select>

            </div>

        </form>

    </div>


    <!-- COUNTERS -->

    <div class="row gy-4 mb-24">

        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-main-50">

                <span class="text-white bg-main-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-wallet"></i>
                </span>

                <div>
                    <h4 class="mb-0"><?= $stats['total'] ?></h4>
                    <span class="fw-medium text-main-600 text-14">
                        Total
                    </span>
                </div>

            </div>
        </div>


        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-success-50">

                <span class="text-white bg-success-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-check-circle"></i>
                </span>

                <div>
                    <h4 class="mb-0"><?= $stats['paid'] ?></h4>
                    <span class="fw-medium text-success-600 text-14">
                        Paid
                    </span>
                </div>

            </div>
        </div>


        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-warning-50">

                <span class="text-white bg-warning-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-clock"></i>
                </span>

                <div>
                    <h4 class="mb-0"><?= $stats['pending'] ?></h4>
                    <span class="fw-medium text-warning-600 text-14">
                        Pending
                    </span>
                </div>

            </div>
        </div>


        <div class="col-xxl-3 col-sm-6">
            <div class="statistics-card p-16 flex-align gap-10 rounded-8 bg-danger-50">

                <span class="text-white bg-danger-600 w-44 h-44 rounded-circle flex-center text-xl">
                    <i class="ph ph-warning"></i>
                </span>

                <div>
                    <h4 class="mb-0"><?= $stats['overdue'] ?></h4>
                    <span class="fw-medium text-danger-600 text-14">
                        Overdue
                    </span>
                </div>

            </div>
        </div>

    </div>


    <!-- TABLE -->

    <div class="card overflow-hidden">

        <div class="card-body p-0">

            <?php if (empty($fees['rows'])): ?>

                <div class="text-center py-60 text-gray-400">
                    <i class="ph ph-wallet" style="font-size:3rem;"></i>
                    <p class="mt-12 text-16 fw-medium">
                        No fee records found.
                    </p>
                </div>

            <?php else: ?>

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead class="bg-light">

                            <tr>
                                <th>Payable</th>
                                <th>Paid</th>
                                <th>Status</th>
                                <th>Payment Details</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($fees['rows'] as $row):

                                [$badgeBg, $dotBg, $label] = feeBadge($row['status']);
                                ?>

                                <tr>

                                    <td class="fw-medium text-dark">
                                        ₹<?= number_format($row['payable_amount'], 2) ?>
                                    </td>

                                    <td class="text-gray-300">
                                        ₹<?= number_format($row['paid_amount'], 2) ?>
                                    </td>

                                    <td>

                                        <span
                                            class="text-13 py-2 px-8 <?= $badgeBg ?> d-inline-flex align-items-center gap-6 rounded-pill">

                                            <span class="w-6 h-6 <?= $dotBg ?> rounded-circle"></span>

                                            <?= $label ?>

                                        </span>

                                    </td>

                                    <td class="text-gray-300 text-14">
                                        <?= esc($row['payment_details'] ?? '—') ?>
                                    </td>

                                    <td class="text-gray-300 text-14">
                                        <?= date('d M Y', strtotime($row['created_at'])) ?>
                                    </td>

                                    <td>

                                        <?php if (strtolower($row['status']) === 'paid'): ?>

                                            <button class="btn btn-info py-4 px-10 text-13">
                                                <i class="ph ph-download me-4"></i>
                                                Receipt
                                            </button>

                                        <?php else: ?>

                                            <button class="btn btn-main py-4 px-10 text-13">
                                                <i class="ph ph-credit-card me-4"></i>
                                                Pay Now
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