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
            .  view('pages/dashboard')
            .  view('templates/footer')
        ;
    }
    public function login(): string
    {
        return view('pages/login');
    }
}