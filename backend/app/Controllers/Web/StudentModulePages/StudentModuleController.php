<?php

namespace App\Controllers\Web\StudentModulePages;

use App\Controllers\BaseController;

class StudentModuleController extends BaseController
{

    public function dashboard(): string
    {
        return view('templates/header-student')
            .  view('templates/sidebar-student')
            .  view('templates/topbar-student')
            .  view('pages/student-module-pages/student-dashboard')
            .  view('templates/footer-student')
        ;
    }

    public function profile(): string
    {
        return view('templates/header-student')
            .  view('templates/sidebar-student')
            .  view('templates/topbar-student')
            .  view('pages/student-module-pages/student-profile')
            .  view('templates/footer-student')
        ;
    }
   
    public function document_list(): string
    {
        return view('templates/header-student')
            .  view('templates/sidebar-student')
            .  view('templates/topbar-student')
            .  view('pages/student-module-pages/document-list')
            .  view('templates/footer-student')
        ;
    }

    public function student_report() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar-student')
            .  view('pages/student-module-pages/student-report')
        ;
    }

    public function report_card() {
       
        return view('templates/sidebar-attendance')
            .  view('templates/topbar-student')
            .  view('pages/student-module-pages/report-card')
        ;
    }

}