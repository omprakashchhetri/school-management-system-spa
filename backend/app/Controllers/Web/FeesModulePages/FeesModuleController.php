<?php

namespace App\Controllers\Web\FeesModulePages;
use App\Controllers\BaseController;

class FeesModuleController extends BaseController
{
    
    public function slabList() {
         
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/fees-module-pages/slab-list')
        ;
    }
    
}