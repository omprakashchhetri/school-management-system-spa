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
    
        // find student by email OR contact number AND password
        $studentDetails = $this->studentsModel
            ->groupStart()
                ->where('student_email', $studentEmail)
                ->orWhere('student_contact_no', $studentEmail)
            ->groupEnd()
            ->where('password', $studentPassword) // ⚠️ ideally hash this
            ->first();
    
        if (!$studentDetails) {
            return json_encode([
                'status'  => 0,
                'message' => 'Account Not Found',
            ]);
        }
    
        // Generate JWT
        $jwt = new JwtHandler();
        $token = $jwt->generateToken([
            'id'        => $studentDetails['id'],
            'loginType' => 'student',
        ]);
    
        // Store token in DB (issued_jwt_token field)
        $this->studentsModel->update(
            $studentDetails['id'],
            ['issued_jwt_token' => $token]
        );
    
        return json_encode([
            'status' => 1,
            'token'  => $token,
        ]);
    }
    

    public function getStudentById($studentId) {

        $builder = $this->studentsModel->builder();

        $builder->select('
            students.*,
            classes.id AS class_id,
            classes.class_name AS class_name,
            sections.id  AS section_id,
            sections.section_label AS section_name
        ');

        $builder->join('classes', 'classes.id = students.related_class', 'left');
        $builder->join('sections', 'sections.id = students.related_section', 'left');

        $builder->where('students.id', (int) $studentId);
        $builder->where('students.deleted_at', null);

        $student = $builder->get()->getRowArray();
        if (!$student) {
            return ['error' => 'Student not found'];
        }

        return $student;
    }

}