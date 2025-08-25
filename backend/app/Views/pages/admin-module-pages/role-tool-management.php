<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Role Details</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->
    </div>
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom py-15">
                    <h4 class="mb-0 ">General Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="roleName" class="h5 mb-8 fw-semibold text-md">Role Name <span
                                    class="text-13 text-gray-400 fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" class="text-counter placeholder-13 form-control py-11 pe-76"
                                    id="roleName" placeholder="Name of the Role" value="<?= $roleDetails['role_name'] ?>">
                                <input type="hidden" id="roleId" value="<?=$roleDetails['id']?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom py-15">
                    <h4 class="mb-0 ">Module Access & Permissions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="h6 text-gray-300">Modules</th>
                                    <th class="h6 text-gray-300">Can Read</th>
                                    <th class="h6 text-gray-300">Can Add / Edit</th>
                                    <th class="h6 text-gray-300">Can Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($roleDetails['tools'] as $tool): ?>
                                <tr class="tool-item" data-tool-permission-id="<?=$tool['id']?>">
                                    <td class="text-dark"><?=$tool['tool_details']['tool_name']?></td>
                                    <td class="">
                                        <div class="form-check">
                                            <input class="form-check-input border-gray-200 rounded-4 tool-item-permission" type="checkbox" <?=($tool['can_view'] == "1") ? "checked" : ""?> data-role-id="<?=$roleDetails['id']?>" data-tool-id="<?=$tool['id']?>" data-permission="can_view" />
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="form-check">
                                            <input class="form-check-input border-gray-200 rounded-4 tool-item-permission" type="checkbox" <?=($tool['can_edit'] == "1") ? "checked" : ""?> data-role-id="<?=$roleDetails['id']?>" data-tool-id="<?=$tool['id']?>" data-permission="can_edit" />
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="form-check">
                                            <input class="form-check-input border-gray-200 rounded-4 tool-item-permission" type="checkbox" <?=($tool['can_delete'] == "1") ? "checked" : ""?> data-role-id="<?=$roleDetails['id']?>" data-tool-id="<?=$tool['id']?>" data-permission="can_delete" />
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button id="saveRoleDetails" class="btn btn-success">Save</button>
        </div>
    </div>

</div>

<script src="<?=base_url()?>assets/js/role-management.js"></script>