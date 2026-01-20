<div class="dashboard-body">

    <!-- Breadcrumb + Action Button -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">

        <!-- Breadcrumb -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html"
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
                        Fees Slab
                    </span>
                </li>
            </ul>
        </div>

        <!-- Add Fees Slab Button -->
        <button type="button"
            class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2"
            data-bs-toggle="modal"
            data-bs-target="#addFeesSlabModal">
            <i class="ph ph-plus me-4"></i>
            Add Fees Slab
        </button>

    </div>

    <!-- Fees Slab Table -->
    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <table id="feesSlabTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4"
                                       type="checkbox"
                                       id="selectAllFeesSlabs" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Total Amount</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will populate -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- ===============================
         Add Fees Slab Modal
    ================================ -->
    <div class="modal fade"
         id="addFeesSlabModal"
         tabindex="-1"
         aria-labelledby="addFeesSlabLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">

                <div class="modal-header">
                    <h5 class="modal-title" id="addFeesSlabLabel">
                        Add Fees Slab
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Class -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Class</label>
                            <select id="class_id" class="form-select">
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $c): ?>
                                    <option value="<?= $c['id'] ?>">
                                        <?= $c['class_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Total Amount -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="number"
                                   id="total_amount"
                                   class="form-control"
                                   placeholder="Enter total amount">
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button"
                                    id="saveFeesSlabBtn"
                                    class="btn btn-primary px-4">
                                Save
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===============================
         Edit Fees Slab Modal
    ================================ -->
    <div class="modal fade"
         id="editFeesSlabModal"
         tabindex="-1"
         aria-labelledby="editFeesSlabLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">

                <div class="modal-header">
                    <h5 class="modal-title" id="editFeesSlabLabel">
                        Edit Fees Slab
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Class -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Class</label>
                            <select id="edit_class_id" class="form-select">
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $c): ?>
                                    <option value="<?= $c['id'] ?>">
                                        <?= $c['class_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Total Amount -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="number"
                                   id="edit_total_amount"
                                   class="form-control">
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button"
                                    id="updateFeesSlabBtn"
                                    class="btn btn-primary px-4">
                                Update
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Page Script -->
<script src="<?= base_url() ?>assets/js/fees-slab-list.js"></script>
