<?php

namespace App\Controllers\Web\AdminModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;

class AdminModuleController extends BaseController
{
    public function roleManagement() {
        // $adminRoleManagement = new AdminRoleManagementController();
        // $roles = $adminRoleManagement->getListOfRoles();
        // return view('pages/admin-module-pages/role-list', ['roles' => $roles]);
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-list')
        ;
    }

    public function roleToolManagement($roleId) {
        // $adminRoleManagement = new AdminRoleManagementController();
        // $roleToolManagement = $adminRoleManagement->roleToolManagementDetails($roleId);
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-tool-management')            
        ;
    }

    
    public function class_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-list')            
        ;
    }

    public function class_teacher_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/class-teacher-list')            
        ;
    }
    
    public function subject_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-list')            
        ;
    }

    public function subject_allocation(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')            
        ;
    }

    public function section_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/section-list')            
        ;
    }

    public function payment_gateways(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-allocation')            
        ;
    }

}