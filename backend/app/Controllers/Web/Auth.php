<?php

namespace App\Controllers\Web;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('pages/login');
    }
}