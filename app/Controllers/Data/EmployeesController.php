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
    
        // Find employee by email OR contact number
        $employeeDetails = $this->employeesModel
            ->groupStart()
                ->where('email1', $email)
                ->orWhere('contact_number1', $email)
            ->groupEnd()
            ->first();

        if (!$employeeDetails || !$this->verifyAndUpgradePassword($password, $employeeDetails, $this->employeesModel)) {
            return json_encode([
                'status'  => 0,
                'message' => 'Invalid email/contact number or password.',
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