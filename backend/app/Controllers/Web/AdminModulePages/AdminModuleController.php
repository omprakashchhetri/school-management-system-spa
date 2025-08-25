<?php

namespace App\Controllers\Web\AdminModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;

class AdminModuleController extends BaseController
{

    protected $adminRoleManagementController;
    public function __construct(){
        $this->adminRoleManagementController = new AdminRoleManagementController();
    }
    public function roleManagement() {
        // $adminRoleManagement = new AdminRoleManagementController();
        $sortOption = $this->request->getGet('sortOption');
        if($sortOption != "" && isset($sortOption)){
            $roles = $this->adminRoleManagementController->getListOfRoles($sortOption);    
        } else {
            $roles = $this->adminRoleManagementController->getListOfRoles();
        }
        $passToView = [
            'roles' => $roles,
        ];
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-list', $passToView)
        ;
    }

    public function roleToolManagement($roleId) {
        $roleToolManagementData = $this->adminRoleManagementController->getOne($roleId);
        $passToView = [
            'roleDetails' => $roleToolManagementData,
        ];
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/role-tool-management', $passToView)
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

    public function deleteRole() {
        $roleId = $this->request->getPost('id');
        return json_encode($this->adminRoleManagementController->delete($roleId));
    }

    public function addRole() {
        $details = $this->request->getPost();
        return json_encode($this->adminRoleManagementController->add($details));
    }

    public function editRole() {
        $details = $this->request->getPost();
        return json_encode($this->adminRoleManagementController->edit($details['data']));
    }

}