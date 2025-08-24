<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class PostLoginController extends BaseController
{
    public function index() {
        return view('templates/post-login');
    }
    public function student_post_login() {
        return view('portal/post-login-student');
    }
    public function employee_post_login() {
        return view('templates/header')
            .   view('portal/post-login-employee')
            .   view('templates/footer');
    }
}