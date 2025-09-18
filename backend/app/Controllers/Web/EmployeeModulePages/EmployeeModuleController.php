<?php

namespace App\Controllers\Web\EmployeeModulePages;
use App\Controllers\BaseController;

class EmployeeModuleController extends BaseController
{

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
    
}