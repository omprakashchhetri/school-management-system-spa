<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">

        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">

                <li>
                    <a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">
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
                        Fees Management
                    </span>
                </li>

                <li>
                    <span class="text-gray-500 fw-normal d-flex">
                        <i class="ph ph-caret-right"></i>
                    </span>
                </li>

                <li>
                    <span class="text-main-600 fw-normal text-15">
                        Fees Payment
                    </span>
                </li>

            </ul>
        </div>

    </div>


    <!-- =====================================
        Student Selection Filters
    ====================================== -->
    <div class="card mb-24">

        <div class="card-header">
            <h6 class="mb-0">Select Student</h6>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Class -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Class</label>
                    <select id="classSelect" class="form-select">

                        <option value="">Select Class</option>

                        <?php foreach ($classes as $class): ?>

                            <option value="<?= $class['id'] ?>">
                                <?= $class['class_name'] ?>
                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>


                <!-- Section -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Section</label>

                    <select id="sectionSelect" class="form-select">
                        <option value="">Select Section</option>
                    </select>
                </div>


                <!-- Student -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Student</label>

                    <select id="studentSelect" class="form-select">
                        <option value="">Select Student</option>
                    </select>
                </div>

            </div>

        </div>

    </div>



    <!-- =====================================
        Fees Ledger Table
    ====================================== -->
    <div class="card mb-24">

        <div class="card-header">
            <h6 class="mb-0">Student Fees Ledger</h6>
        </div>

        <div class="card-body p-0">

            <table id="feesLedgerTable" class="table table-striped">

                <thead>
                    <tr>

                        <th class="h6 text-gray-300">Month</th>

                        <th class="h6 text-gray-300">Year</th>

                        <th class="h6 text-gray-300">Fee Amount</th>

                        <th class="h6 text-gray-300">Late Fee</th>

                        <th class="h6 text-gray-300">Discount</th>

                        <th class="h6 text-gray-300">Paid</th>

                        <th class="h6 text-gray-300">Balance</th>

                        <th class="h6 text-gray-300">Status</th>

                    </tr>
                </thead>

                <tbody id="feesLedgerBody">

                    <tr>
                        <td colspan="7" class="text-center text-muted py-20">
                            Select a student to view ledger
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>



    <!-- =====================================
        Payment Entry Section
    ====================================== -->
    <div class="card">

        <div class="card-header">
            <h6 class="mb-0">Record Payment</h6>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Payment Amount -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Payment Amount
                    </label>

                    <input type="number" id="paymentAmount" class="form-control" placeholder="Enter amount">

                </div>


                <!-- Payment Mode -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Payment Mode
                    </label>

                    <select id="paymentMode" class="form-select">

                        <option value="">Select Mode</option>

                        <option value="cash">Cash</option>
                        <option value="upi">UPI</option>
                        <option value="card">Card</option>
                        <option value="bank_transfer">Bank Transfer</option>

                    </select>

                </div>


                <!-- Payment Date -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Payment Date
                    </label>

                    <input type="datetime-local" id="paymentDate" class="form-control">

                </div>


            </div>


            <div class="text-end mt-3">

                <button type="button" id="recordPaymentBtn" class="btn btn-main text-sm px-24 py-12 rounded-pill">

                    <i class="ph ph-floppy-disk me-4"></i>

                    Record Payment

                </button>

            </div>

        </div>

    </div>

</div>



<!-- Page Script -->
<script src="<?= base_url() ?>assets/js/fees-payment-transaction.js"></script>