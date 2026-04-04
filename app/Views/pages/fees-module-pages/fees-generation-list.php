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
                        Generated Fees
                    </span>
                </li>

            </ul>
        </div>

        <!-- Generate Fees Button -->
        <div>
            <button type="button" class="btn btn-main text-sm px-24 py-12 rounded-pill" data-bs-toggle="modal"
                data-bs-target="#generateFeesModal">
                <i class="ph ph-plus me-4"></i>
                Generate Fees
            </button>
        </div>

    </div>


    <!-- =====================================
        Filters
    ====================================== -->
    <div class="card mb-24">

        <div class="card-header">
            <h6 class="mb-0">Filter Generated Fees</h6>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <!-- Class -->
                <div class="col-md-3">
                    <label class="form-label">Class</label>
                    <select id="filterClass" class="form-select">
                        <option value="">All Classes</option>
                        <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['id'] ?>">
                            <?= esc($class['class_name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Section -->
                <div class="col-md-3">
                    <label class="form-label">Section</label>
                    <select id="filterSection" class="form-select">
                        <option value="">All Sections</option>
                        <?php foreach ($sections as $section): ?>
                        <option value="<?= $section['id'] ?>">
                            <?= esc($section['section_label']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Month -->
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <select id="filterMonth" class="form-select">
                        <option value="">All Months</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>

                <!-- Year -->
                <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <select id="filterYear" class="form-select">
                        <option value="">All Years</option>
                        <?php
                        $currentYear = (int) date('Y');
                        for ($y = $currentYear - 2; $y <= $currentYear + 1; $y++):
                        ?>
                        <option value="<?= $y ?>" <?= $y === $currentYear ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>

            </div>
        </div>

    </div>


    <!-- =====================================
        Generated Fees Table
    ====================================== -->
    <div class="card">

        <div class="card-header">
            <h6 class="mb-0">Generated Fees List</h6>
        </div>

        <div class="card-body p-0">

            <table id="feesGenerationTable" class="table table-striped">

                <thead>
                    <tr>
                        <th class="h6 text-gray-300">
                            <input type="checkbox" id="selectAllRows" class="form-check-input">
                        </th>
                        <th class="h6 text-gray-300">Student</th>
                        <th class="h6 text-gray-300">Class – Section</th>
                        <th class="h6 text-gray-300">Period</th>
                        <th class="h6 text-gray-300">Amount</th>
                        <th class="h6 text-gray-300">Due Date</th>
                        <th class="h6 text-gray-300">Late Fee From</th>
                        <th class="h6 text-gray-300">Status</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>


<!-- =============================================
     Generate Fees Modal
============================================== -->
<div class="modal fade" id="generateFeesModal" tabindex="-1" aria-labelledby="generateFeesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="generateFeesModalLabel">
                    <i class="ph ph-currency-circle-dollar me-6"></i>
                    Generate Monthly Fees
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p class="text-muted text-sm mb-20">
                    Fees will be generated for <strong>all active students</strong> based on their class fee slab.
                    Students without a fee slab assigned to their class will be skipped.
                </p>

                <div class="row g-3">

                    <!-- Month -->
                    <div class="col-md-6">
                        <label class="form-label">Month <span class="text-danger">*</span></label>
                        <select id="genMonth" class="form-select">
                            <option value="">Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>

                    <!-- Year -->
                    <div class="col-md-6">
                        <label class="form-label">Year <span class="text-danger">*</span></label>
                        <select id="genYear" class="form-select">
                            <?php
                            $currentYear = (int) date('Y');
                            for ($y = $currentYear - 1; $y <= $currentYear + 1; $y++):
                            ?>
                            <option value="<?= $y ?>" <?= $y === $currentYear ? 'selected' : '' ?>>
                                <?= $y ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="col-md-6">
                        <label class="form-label">Due Date <span class="text-danger">*</span></label>
                        <input type="date" id="genDueDate" class="form-control">
                    </div>

                    <!-- Late Fee Start Date -->
                    <div class="col-md-6">
                        <label class="form-label">Late Fee Starts From <span class="text-danger">*</span></label>
                        <input type="date" id="genLateFeeStartDate" class="form-control">
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-outline-secondary rounded-pill px-20" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button" id="generateFeesBtn" class="btn btn-main rounded-pill px-24 py-10">
                    <i class="ph ph-check me-4"></i>
                    Generate Fees
                </button>

            </div>

        </div>
    </div>
</div>


<!-- Page Script -->
<script src="<?= base_url() ?>assets/js/fees-generation.js"></script>