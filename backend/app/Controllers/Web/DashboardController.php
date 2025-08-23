<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function dashboard(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/dashboard')
            .  view('templates/footer')
        ;
    }

    public function student_dashboard(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/student-module-pages/student-dashboard')
            .  view('templates/footer')
        ;
    }

    public function student_dashboard_test(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/student-module-pages/student-dashboard-ref')
            .  view('templates/footer')
        ;
    }
    
    public function login(): string
    {
        return view('pages/login');
    }

    
    public function pre_login(): string
    {
        return view('portal/pre-login');
    }

    
    public function student_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/student-list')
            .  view('templates/footer')
        ;
    }

    public function employee_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/employee-list')
            .  view('templates/footer')
        ;
    }
    
    public function subject_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/subject-list')
            .  view('templates/footer')
        ;
    }
    
    
    public function test(): string
    {
        return "Test";
    }
}