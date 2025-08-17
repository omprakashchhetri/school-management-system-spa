<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

class PostLoginController extends BaseController
{
    public function index() {
        return view('portal/post-login');
    }
}