<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Controllers\Data\StudentsController;
use App\Controllers\Data\EmployeesController;
use App\Libraries\RequestLibrary;

class AuthController extends BaseController
{
    public function index()
    {
        $request = new RequestLibrary(service('request'));
        if($request->request->getPost('type') == "student") {
            $studentsController = new StudentsController();
            $studentDetails = [
                'email' => $request->request->getPost('email'),
                'password' => $request->request->getPost('password'),
            ];

            $studentLoginAttempt = $studentsController->studentLogin($studentDetails);

            return $this->response->setJSON($studentLoginAttempt);
        } else {
            $employeesController = new employeesController();
            $employeeDetails = [
                'email' => $request->request->getPost('email'),
                'password' => $request->request->getPost('password'),
            ];

            $employeeLoginAttempt = $employeesController->employeeLogin($employeeDetails);

            return $this->response->setJSON($employeeLoginAttempt);
        }
        
        
    }
}