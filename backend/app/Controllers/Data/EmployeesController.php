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
    
        // Find employee by email OR contact number AND password
        $employeeDetails = $this->employeesModel
            ->groupStart()
                ->where('email1', $email)
                ->orWhere('contact_number1', $email)
            ->groupEnd()
            ->where('password', $password) // ⚠️ should be hashed in production
            ->first();
    
        if (!$employeeDetails) {
            return json_encode([
                'status'  => 0,
                'message' => 'Account Not Found',
            ]);
        }
    
        // Generate JWT
        $jwt = new JwtHandler();
        $token = $jwt->generateToken([
            'id'        => $employeeDetails['id'],
            'loginType' => 'employee',
        ]);
    
        // Store token in DB
        $this->employeesModel->update(
            $employeeDetails['id'],
            ['issued_jwt_token' => $token]
        );
    
        return json_encode([
            'status' => 1,
            'token'  => $token,
        ]);
    }
    
}