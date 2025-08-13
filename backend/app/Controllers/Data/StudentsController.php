<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Libraries\JwtHandler;

class StudentsController extends BaseController
{
    public function __construct(){
        $this->studentsModel = model('StudentsModel');
    }

    public function studentLogin($studentDetailsFromRequest) {
        $studentEmail = $studentDetailsFromRequest['email'];
        $studentPassword = $studentDetailsFromRequest['password'];
        $studentDetails = $this->studentsModel->groupStart()->where('student_email', $studentEmail)->orWhere('student_contact_no', $studentEmail)->groupEnd()->where('password', $studentPassword)->first();
        if(!$studentDetails){
            $response = [
                'status' => 0,
                'message' => 'Account Not Found',
            ];
            return json_encode($response);
        } else {

            $jwt = new JwtHandler();
            $token = $jwt->generateToken([
                'id' => $studentDetails['id'],
            ]);
            return json_encode([
                'status' => 1,
                'token' => $token,
            ]);
        }
    }
}