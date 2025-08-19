<?php

namespace App\Controllers\Web\AdminModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;

class AdminModuleController extends BaseController
{
    public function roleManagement() {
        $adminRoleManagement = new AdminRoleManagementController();
        $roles = $adminRoleManagement->getListOfRoles();
        return view('pages/admin-module-pages/role-list', ['roles' => $roles]);
    }
}