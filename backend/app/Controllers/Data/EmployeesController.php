<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Libraries\JwtHandler;

class EmployeesController extends BaseController
{
    public function __construct(){
        $this->employeesModel = model('EmployeesModel');
    }

    public function employeeLogin($employeeDetailsFromRequest) {
        $email = $employeeDetailsFromRequest['email'];
        $password = $employeeDetailsFromRequest['password'];
        $employeeDetails = $this->employeesModel->groupStart()->where('email1', $email)->orWhere('contact_number1', $email)->groupEnd()->where('password', $password)->first();
        if(!$employeeDetails){
            $response = [
                'status' => 0,
                'message' => 'Account Not Found',
            ];
            return json_encode($response);
        } else {

            $jwt = new JwtHandler();
            $token = $jwt->generateToken([
                'id' => $employeeDetails['id'],
            ]);
            return json_encode([
                'status' => 1,
                'token' => $token,
            ]);
        }
    }
}