<?php
/**
 * Fee Payment Receipt View
 * 
 * Expected controller data (passed via $this->data or view() second arg):
 * 
 * $payment       → fees_payments row
 * $student       → students row joined with classes.class_name, sections.section_label
 * $allocations   → array of rows, each:
 *                   [month, year, base_amount (fees_generation.amount),
 *                    discount_amount (fees_discount.discount_amount or 0),
 *                    late_fee_amount (calculated from fees_slabs.late_fee or 0),
 *                    paid_amount (fees_allocation.amount)]
 * $totals        → [total_base, total_discount, total_late_fee, total_paid, advance_credit]
 *
 * Example controller snippet:
 *   return view('fees/fee_receipt', [
 *       'payment'     => $paymentRow,
 *       'student'     => $studentRow,
 *       'allocations' => $allocationRows,
 *       'totals'      => $totalsArray,
 *   ]);
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Receipt #<?= esc($payment['id']) ?> | JN English School</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
    /* ── CSS Variables from your theme ─────────────────────────── */
    :root {
        --heading-font: "Urbanist", sans-serif;
        --body-font: "Roboto", sans-serif;
        --main-h: 219;
        --main-s: 94%;
        --main-l: 61%;
        --primary-600: #487fff;
        --primary-50: #e4f1ff;
        --primary-100: #bfdcff;
        --success-500: #22c55e;
        --success-50: #dcfce7;
        --danger-600: #ea5455;
        --warning-600: #ff9f43;
        --gray-50: #ecf1f9;
        --gray-100: #d5dbe7;
        --gray-200: #7585a5;
        --gray-600: #0c1018;
        --light-100: #f3f4f6;
        --border-color: #c8cfe8;
    }

    /* ── Base ───────────────────────────────────────────────────── */
    body {
        font-family: var(--body-font), sans-serif;
        background-color: #f0f4f8;
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    /* ── Receipt Card ───────────────────────────────────────────── */
    .receipt-wrapper {
        max-width: 860px;
        margin: 2rem auto;
    }

    .receipt-card {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(72, 127, 255, 0.08);
    }

    /* ── Header ─────────────────────────────────────────────────── */
    .receipt-header {
        background: var(--primary-600);
        color: #fff;
        padding: 1.25rem 1.75rem;
    }

    .school-logo {
        width: 52px;
        height: 52px;
        object-fit: contain;
        background: #fff;
        border-radius: 8px;
        padding: 4px;
    }

    .school-name {
        font-family: var(--heading-font), sans-serif;
        font-size: 1.35rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 2px;
    }

    .school-sub {
        font-size: 0.78rem;
        opacity: 0.88;
        letter-spacing: 0.5px;
    }

    .receipt-badge {
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 6px;
        padding: 0.5rem 1rem;
        text-align: center;
    }

    .receipt-badge .label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.85;
    }

    .receipt-badge .value {
        font-size: 1.1rem;
        font-weight: 700;
    }

    /* ── Status Bar ─────────────────────────────────────────────── */
    .status-bar {
        background: var(--primary-50);
        border-bottom: 1px solid var(--border-color);
        padding: 0.6rem 1.75rem;
        font-size: 0.8rem;
        color: var(--gray-200);
    }

    .status-bar .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .status-pill.completed {
        background: var(--success-50);
        color: #15803d;
    }

    .status-pill.pending {
        background: #fff5ed;
        color: #b45309;
    }

    /* ── Body Sections ───────────────────────────────────────────── */
    .receipt-body {
        padding: 1.5rem 1.75rem;
    }

    .section-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary-600);
        margin-bottom: 0.6rem;
        padding-bottom: 0.4rem;
        border-bottom: 1.5px solid var(--primary-50);
    }

    /* ── Info Grid ──────────────────────────────────────────────── */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem 1.5rem;
        margin-bottom: 0;
    }

    .info-item .info-label {
        font-size: 0.7rem;
        color: var(--gray-200);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-item .info-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-600);
    }

    /* ── Fee Table ───────────────────────────────────────────────── */
    .fee-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.84rem;
    }

    .fee-table thead tr {
        background: var(--gray-50);
    }

    .fee-table thead th {
        padding: 0.6rem 0.85rem;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--gray-200);
        border: 1px solid var(--border-color);
    }

    .fee-table tbody td {
        padding: 0.65rem 0.85rem;
        border: 1px solid #e8ecf4;
        vertical-align: middle;
        color: var(--gray-600);
    }

    .fee-table tbody tr:nth-child(even) {
        background-color: #fafbfd;
    }

    .fee-table tfoot td {
        padding: 0.55rem 0.85rem;
        font-size: 0.82rem;
        border: 1px solid var(--border-color);
    }

    .tfoot-label {
        text-align: right;
        color: var(--gray-200);
        font-weight: 600;
    }

    .tfoot-value {
        text-align: right;
        font-weight: 700;
        color: var(--gray-600);
        min-width: 110px;
    }

    .text-discount {
        color: var(--danger-600);
    }

    .text-latefee {
        color: var(--warning-600);
    }

    .text-total {
        color: var(--primary-600);
        font-size: 0.95rem;
    }

    /* ── Payment Summary Box ─────────────────────────────────────── */
    .summary-box {
        background: var(--primary-50);
        border: 1px solid var(--primary-100);
        border-radius: 8px;
        padding: 1rem 1.25rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.3rem 0;
        font-size: 0.85rem;
    }

    .summary-row:not(:last-child) {
        border-bottom: 1px dashed var(--primary-100);
    }

    .summary-row .s-label {
        color: var(--gray-200);
    }

    .summary-row .s-value {
        font-weight: 600;
        color: var(--gray-600);
    }

    .summary-row.grand-total {
        margin-top: 0.4rem;
        padding-top: 0.5rem;
        border-top: 2px solid var(--primary-600) !important;
        border-bottom: none !important;
    }

    .summary-row.grand-total .s-label {
        font-weight: 700;
        color: var(--gray-600);
        font-size: 0.95rem;
    }

    .summary-row.grand-total .s-value {
        font-size: 1.1rem;
        color: var(--primary-600);
    }

    /* ── Signature ───────────────────────────────────────────────── */
    .signature-area {
        border-top: 1px dashed var(--border-color);
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .sig-box {
        border-top: 1.5px solid var(--gray-100);
        padding-top: 0.3rem;
        text-align: center;
        font-size: 0.72rem;
        color: var(--gray-200);
        letter-spacing: 0.5px;
        margin-top: 2.5rem;
    }

    /* ── Footer Note ─────────────────────────────────────────────── */
    .receipt-footer {
        background: var(--gray-50);
        border-top: 1px solid var(--border-color);
        padding: 0.7rem 1.75rem;
        font-size: 0.75rem;
        color: var(--gray-200);
        text-align: center;
    }

    /* ── Action Buttons ──────────────────────────────────────────── */
    .action-bar {
        margin-bottom: 1.25rem;
    }

    .btn-print {
        background: var(--primary-600);
        color: #fff;
        border: none;
        font-size: 0.85rem;
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }

    .btn-print:hover {
        background: #3a6ce0;
        color: #fff;
    }

    .btn-back {
        background: #fff;
        color: var(--gray-200);
        border: 1px solid var(--border-color);
        font-size: 0.85rem;
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: var(--gray-50);
        color: var(--gray-600);
    }

    /* ── Divider ─────────────────────────────────────────────────── */
    .section-divider {
        border: none;
        border-top: 1px dashed var(--border-color);
        margin: 1.25rem 0;
    }

    /* ── Print Styles ─────────────────────────────────────────────── */
    @media print {
        body {
            background: #fff !important;
            font-size: 0.82rem;
        }

        .action-bar,
        .no-print {
            display: none !important;
        }

        .receipt-wrapper {
            margin: 0;
            max-width: 100%;
        }

        .receipt-card {
            border: none;
            box-shadow: none;
            border-radius: 0;
        }

        .receipt-header {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .status-bar {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .fee-table thead tr {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .summary-box {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .receipt-footer {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
    </style>
</head>

<body>

    <div class="receipt-wrapper">

        <!-- ── Action Bar (hidden on print) ──────────────────────────── -->
        <div class="action-bar d-flex justify-content-between align-items-center no-print">
            <a href="javascript:history.back()" class="btn-back">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Receipt
            </button>
        </div>

        <div class="receipt-card">

            <!-- ── School Header ──────────────────────────────────────── -->
            <div class="receipt-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= base_url() ?>assets/images/logo/logo-sm.png" alt="JN English School Logo"
                            class="school-logo">
                        <div>
                            <div class="school-name">JN English School</div>
                            <div class="school-sub">Fee Payment Receipt</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="receipt-badge">
                            <div class="label">Receipt No.</div>
                            <div class="value">#<?= esc($payment['id']) ?></div>
                        </div>
                        <div class="receipt-badge">
                            <div class="label">Date</div>
                            <div class="value">
                                <?= date('d M Y', strtotime($payment['payment_date_time'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Status Bar ─────────────────────────────────────────── -->
            <div class="status-bar d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>
                    Payment Time:
                    <strong><?= date('h:i A', strtotime($payment['payment_date_time'])) ?></strong>
                </span>
                <span>
                    Status:
                    <span
                        class="status-pill <?= strtolower(esc($payment['status'])) === 'completed' ? 'completed' : 'pending' ?>">
                        <i
                            class="bi <?= strtolower($payment['status']) === 'completed' ? 'bi-check-circle-fill' : 'bi-clock-fill' ?>"></i>
                        <?= ucfirst(esc($payment['status'])) ?>
                    </span>
                </span>
                <span>
                    Mode:
                    <strong><?= ucfirst(esc($payment['payment_mode'])) ?></strong>
                </span>
            </div>

            <!-- ── Receipt Body ───────────────────────────────────────── -->
            <div class="receipt-body">

                <!-- Student Information -->
                <p class="section-title mb-2">
                    <i class="bi bi-person me-1"></i> Student Information
                </p>
                <div class="info-grid mb-3">
                    <div class="info-item">
                        <div class="info-label">Student Name</div>
                        <div class="info-value">
                            <?= esc(trim($student['firstname'] . ' ' . ($student['middlename'] ?? '') . ' ' . $student['lastname'])) ?>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Roll No.</div>
                        <div class="info-value"><?= $student['roll_no'] ? esc($student['roll_no']) : '—' ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Admission No.</div>
                        <div class="info-value"><?= $student['admission_no'] ? esc($student['admission_no']) : '—' ?>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Class</div>
                        <div class="info-value">
                            Class <?= esc($student['class_name']) ?> – <?= esc($student['section_label']) ?>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Father's Name</div>
                        <div class="info-value"><?= esc($student['father_name']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Contact No.</div>
                        <div class="info-value"><?= esc($student['father_contact_no']) ?></div>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Fee Breakdown -->
                <p class="section-title mb-2">
                    <i class="bi bi-receipt me-1"></i> Fee Breakdown
                </p>

                <div class="table-responsive mb-3">
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th style="width:42px">#</th>
                                <th>Fee Period</th>
                                <th class="text-end">Base Amount (₹)</th>
                                <th class="text-end">Discount (₹)</th>
                                <th class="text-end">Late Fee (₹)</th>
                                <th class="text-end">Amount Paid (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $rowNum = 1;
                        foreach ($allocations as $row):
                            $discountAmt = (float)($row['discount_amount'] ?? 0);
                            $lateFeeAmt  = (float)($row['late_fee_amount']  ?? 0);
                        ?>
                            <tr>
                                <td class="text-center text-muted"><?= $rowNum++ ?></td>
                                <td>
                                    <span class="fw-semibold"><?= esc($row['month']) ?> <?= esc($row['year']) ?></span>
                                    <br>
                                    <small class="text-muted">
                                        Due: <?= date('d M Y', strtotime($row['due_date'])) ?>
                                    </small>
                                </td>
                                <td class="text-end">
                                    <?= number_format((float)$row['base_amount'], 2) ?>
                                </td>
                                <td
                                    class="text-end <?= $discountAmt > 0 ? 'text-discount fw-semibold' : 'text-muted' ?>">
                                    <?= $discountAmt > 0 ? '- ' . number_format($discountAmt, 2) : '0.00' ?>
                                </td>
                                <td class="text-end <?= $lateFeeAmt > 0 ? 'text-latefee fw-semibold' : 'text-muted' ?>">
                                    <?= $lateFeeAmt > 0 ? '+ ' . number_format($lateFeeAmt, 2) : '0.00' ?>
                                </td>
                                <td class="text-end fw-semibold">
                                    <?= number_format((float)$row['paid_amount'], 2) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="tfoot-label">Subtotal (Base Fees)</td>
                                <td colspan="4" class="tfoot-value">
                                    ₹ <?= number_format((float)$totals['total_base'], 2) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="tfoot-label text-discount">Total Discount</td>
                                <td colspan="4" class="tfoot-value text-discount">
                                    <?= (float)$totals['total_discount'] > 0
                                    ? '- ₹ ' . number_format((float)$totals['total_discount'], 2)
                                    : '₹ 0.00' ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="tfoot-label text-latefee">Total Late Fee</td>
                                <td colspan="4" class="tfoot-value text-latefee">
                                    <?= (float)$totals['total_late_fee'] > 0
                                    ? '+ ₹ ' . number_format((float)$totals['total_late_fee'], 2)
                                    : '₹ 0.00' ?>
                                </td>
                            </tr>
                            <tr style="background: var(--primary-50);">
                                <td colspan="2" class="tfoot-label text-total fw-bold" style="font-size:0.9rem;">
                                    Total Paid
                                </td>
                                <td colspan="4" class="tfoot-value text-total" style="font-size:1rem;">
                                    ₹ <?= number_format((float)$totals['total_paid'], 2) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <hr class="section-divider">

                <!-- Payment Summary + Signature -->
                <div class="row g-4">

                    <!-- Summary -->
                    <div class="col-md-5">
                        <p class="section-title mb-2">
                            <i class="bi bi-credit-card me-1"></i> Payment Summary
                        </p>
                        <div class="summary-box">
                            <div class="summary-row">
                                <span class="s-label">Total Base Fees</span>
                                <span class="s-value">₹ <?= number_format((float)$totals['total_base'], 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <span class="s-label text-discount">Discount Applied</span>
                                <span class="s-value text-discount">
                                    - ₹ <?= number_format((float)$totals['total_discount'], 2) ?>
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="s-label text-latefee">Late Fee Charged</span>
                                <span class="s-value text-latefee">
                                    + ₹ <?= number_format((float)$totals['total_late_fee'], 2) ?>
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="s-label">Advance Credit</span>
                                <span class="s-value">
                                    ₹ <?= number_format((float)$payment['advance_credit'], 2) ?>
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="s-label">Payment Mode</span>
                                <span class="s-value"><?= ucfirst(esc($payment['payment_mode'])) ?></span>
                            </div>
                            <div class="summary-row grand-total">
                                <span class="s-label">Amount Paid</span>
                                <span class="s-value">₹ <?= number_format((float)$payment['paid_amount'], 2) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Signature -->
                    <div class="col-md-7">
                        <p class="section-title mb-2">
                            <i class="bi bi-pen me-1"></i> Authorization
                        </p>
                        <div class="signature-area">
                            <div class="row g-0">
                                <div class="col-6 pe-3">
                                    <div class="sig-box">Received By / Cashier Signature</div>
                                </div>
                                <div class="col-6 ps-3">
                                    <div class="sig-box">Parent / Guardian Signature</div>
                                </div>
                            </div>
                            <div class="mt-3 pt-2">
                                <small class="text-muted d-block" style="font-size:0.72rem; line-height:1.6;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    This is a computer-generated receipt and is valid without a physical signature of
                                    the issuing authority. Please retain this receipt for your records. For any
                                    discrepancies, contact the school accounts department within 7 days of the payment
                                    date.
                                </small>
                            </div>
                        </div>
                    </div>

                </div><!-- /row -->

            </div><!-- /receipt-body -->

            <!-- ── Footer ─────────────────────────────────────────────── -->
            <div class="receipt-footer">
                <i class="bi bi-building me-1"></i>
                JN English School &nbsp;|&nbsp;
                <i class="bi bi-envelope me-1"></i> school@jnenglishschool.in &nbsp;|&nbsp;
                <i class="bi bi-telephone me-1"></i> +91-XXXXXXXXXX
                <br class="d-sm-none">
                <span class="d-none d-sm-inline">&nbsp;|&nbsp;</span>
                Generated on <?= date('d M Y, h:i A') ?>
            </div>

        </div><!-- /receipt-card -->

    </div><!-- /receipt-wrapper -->


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
    $(document).ready(function() {

        /* Auto-trigger print if ?print=1 in URL */
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('print') === '1') {
            window.print();
        }

        /* Keyboard shortcut: Ctrl+P already works natively,
           but also bind Ctrl+Shift+P to trigger via button  */
        $(document).on('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey && e.key === 'P') {
                e.preventDefault();
                window.print();
            }
        });

    });
    </script>

</body>

</html>