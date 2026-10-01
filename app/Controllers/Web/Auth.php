<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;

use App\Controllers\Data\StudentsController;
use App\Controllers\Data\EmployeesController;
use App\Libraries\RequestLibrary;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('pages/login');
    }

    public function index()
    {
        $request = new RequestLibrary(service('request'));

        $type     = trim((string) $request->request->getPost('type'));
        $email    = trim((string) $request->request->getPost('email'));
        $password = (string) $request->request->getPost('password');

        if ($email === '' || $password === '') {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'Please enter your email/ID and password.',
            ]);
        }

        if (!in_array($type, ['student', 'employee'], true)) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'Please select whether you are logging in as a Student or an Employee.',
            ]);
        }

        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];

        if ($type === 'student') {
            $studentsController   = new StudentsController();
            $studentLoginAttempt  = $studentsController->studentLogin($credentials);

            return $this->response->setJSON($studentLoginAttempt);
        }

        $employeesController  = new EmployeesController();
        $employeeLoginAttempt = $employeesController->employeeLogin($credentials);

        return $this->response->setJSON($employeeLoginAttempt);
    }
}