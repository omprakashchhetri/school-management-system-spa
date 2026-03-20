<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Controllers\Data\SISModulePages\SISController;

class DashboardController extends BaseController
{
    protected $sisController;

    public function __construct()
    {
        $this->sisController = new SISController();
    }

    public function dashboard(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/dashboard');
    }
    
    public function login(): string
    {
        return view('pages/login');
    }

    
    public function pre_login(): string
    {
        return view('portal/pre-login');
    }

    public function forgot_password(): string{
        return view('portal/forgot-password');
    }
    
    public function student_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/student-list')
        ;
    }

    public function employee_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/employee-list')
        ;
    }
    
    public function subject_list(): string
    {
        return view('templates/sidebar')
            .  view('templates/topbar')
            .  view('pages/admin-module-pages/subject-list')
        ;
    }  
    
     public function get_student_list()
    {
        $postData = $this->request->getPost();
        return $this->sisController->getStudentList($postData);
    }

    public function add_student()
    {
        $data = $this->request->getPost();
        $result = $this->sisController->addStudent($data);
        return $this->response->setJSON($result);
    }

    public function edit_student()
    {
        $data = $this->request->getPost();
        $result = $this->sisController->editStudent($data);
        return $this->response->setJSON($result);
    }

    public function delete_student()
    {
        $id = $this->request->getPost('id');
        $result = $this->sisController->deleteStudent($id);
        return $this->response->setJSON($result);
    }

    // ==================== HELPER API ROUTES ====================

    public function get_classes()
    {
        $classes = $this->sisController->getClasses();
        return $this->response->setJSON($classes);
    }

    public function get_sections()
    {
        $sections = $this->sisController->getSections();
        return $this->response->setJSON($sections);
    }

    public function export_students()
    {
        $format = $this->request->getGet('format');
        $classId = $this->request->getGet('class_id');
        $sectionId = $this->request->getGet('section_id');

        $studentsModel = model('StudentsModel');
        $builder = $studentsModel->builder()
            ->select('students.*, c.class_name, s.section_label')
            ->join('classes c', 'c.id = students.related_class', 'left')
            ->join('sections s', 's.id = students.related_section', 'left')
            ->where('students.deleted_at', null);

        if (!empty($classId)) {
            $builder->where('students.related_class', $classId);
        }

        if (!empty($sectionId)) {
            $builder->where('students.related_section', $sectionId);
        }

        $students = $builder->get()->getResultArray();

        if ($format === 'csv') {
            return $this->exportAsCSV($students);
        } elseif ($format === 'json') {
            return $this->exportAsJSON($students);
        }

        return $this->response->setJSON(['error' => 'Invalid export format']);
    }

    private function exportAsCSV($students)
    {
        $filename = 'students_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Headers
        fputcsv($output, ['ID', 'First Name', 'Middle Name', 'Last Name', 'Roll No', 'Class', 'Section', 'Email', 'Contact', 'Blood Group']);
        
        // Data
        foreach ($students as $student) {
            fputcsv($output, [
                $student['id'],
                $student['firstname'],
                $student['middlename'],
                $student['lastname'],
                $student['roll_no'],
                $student['class_name'],
                $student['section_label'],
                $student['student_email'],
                $student['student_contact_no'],
                $student['blood_group']
            ]);
        }
        
        fclose($output);
        exit;
    }

    private function exportAsJSON($students)
    {
        $filename = 'students_export_' . date('Y-m-d_H-i-s') . '.json';
        
        return $this->response
            ->setHeader('Content-Type', 'application/json')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setJSON($students);
    }   
}