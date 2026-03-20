<?php

namespace App\Controllers\Web\EmployeeModulePages;
use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;
use App\Controllers\Data\AdminModulePages\EmployeeManagementController;



class EmployeeModuleController extends BaseController
{
    protected $adminRoleManagementController;    
    protected $employeeManagementController;

    public function __construct(){
        $this->adminRoleManagementController = new AdminRoleManagementController();
        $this->employeeManagementController = new EmployeeManagementController();
    }

    public function dashboard() {
         
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/employee-module-pages/employee-dashboard')
        ;
    }
    
    public function list() {
         
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/employee-module-pages/employee-list')
        ;
    }

    public function employee_add_edit() {
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/employee-module-pages/employee-list')
        ;
    }
    
    public function employee_profile()
    {
        // Get employee ID from the authenticated user object
        $employeeId = $this->request->user->id;
        
        $employeeData = $this->employeeManagementController->getEmployeeDetails($employeeId);
        
        if (!$employeeData) {
            return redirect()->to('employee/list')->with('error', 'Employee not found');
        }
        
        $roleDetails = $this->adminRoleManagementController->getOne($employeeData['employee']['role_id']);
        
        return view('templates/sidebar-employee')
            . view('templates/topbar')
            . view('pages/employee-module-pages/employee-profile', [
                'employeeDetails' => $employeeData, 
                'roleDetails' => $roleDetails
            ]);
    }
    
}