<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function dashboard(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/dashboard')
        ;
    }

    public function student_list(): string
    {
        return view('templates/header')
            .  view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/list-page')
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


    public function test(): string
    {
        return "Test";
    }
}