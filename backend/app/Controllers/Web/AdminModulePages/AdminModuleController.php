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

    public function roleToolManagement($roleId) {
        $adminRoleManagement = new AdminRoleManagementController();
        $roleToolManagement = $adminRoleManagement->roleToolManagementDetails($roleId);
        return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
    }

    
    public function class_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-list')
            .  view('templates/footer')
        ;
    }

    public function class_teacher_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-teacher-list')
            .  view('templates/footer')
        ;
    }
    
    public function subject_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-list')
            .  view('templates/footer')
        ;
    }

    public function subject_allocation(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')
            .  view('templates/footer')
        ;
    }

    public function section_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/section-list')
            .  view('templates/footer')
        ;
    }

    public function payment_gateways(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')
            .  view('templates/footer')
        ;
    }

}