<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->set404Override(function() {
    echo view('pages/page_not_found'); // custom 404 Page
});


// Login screen
$routes->get('pre-login', 'Web\DashboardController::pre_login');
$routes->get('forgot-password', 'Web\DashboardController::forgot_password');
$routes->post('login', 'Web\DashboardController::login');


// For student type
$routes->group('post-login-student', function($routes) {
    $routes->get('(:any)', 'Web\PostLoginController::student_post_login');
    $routes->get('dashboard', 'Web\StudentModulePages\StudentModuleController::dashboard');
    $routes->post('dashboard', 'Web\StudentModulePages\StudentModuleController::dashboard');
    $routes->post('profile', 'Web\StudentModulePages\StudentModuleController::profile');
    $routes->post('documents', 'Web\StudentModulePages\StudentModuleController::document_list');
});

// For Employee type
$routes->group('post-login-employee', function($routes) {
    // Match exactly /post-login
    
    // Match /post-login/anything
    $routes->get('(:any)', 'Web\PostLoginController::employee_post_login');

    $routes->post('student-list', 'Web\DashboardController::student_list');

    $routes->group('admin', function($routes){
        $routes->post('view-modules', 'Web\AdminModulePages\AdminModuleController::view_modules');
        $routes->post('role-list', 'Web\AdminModulePages\AdminModuleController::roleManagement');
        $routes->post('role-details/(:any)', 'Web\AdminModulePages\AdminModuleController::roleToolManagement/$1');    
        $routes->get('dashboard', 'Web\DashboardController::dashboard');
        $routes->post('dashboard', 'Web\DashboardController::dashboard');
        $routes->post('delete-role', 'Web\AdminModulePages\AdminModuleController::deleteRole');
        $routes->post('add-role', 'Web\AdminModulePages\AdminModuleController::addRole');
        $routes->post('edit-role', 'Web\AdminModulePages\AdminModuleController::editRole');

        $routes->post('add-class', 'Web\AdminModulePages\AdminModuleController::addClass');
        $routes->post('edit-class', 'Web\AdminModulePages\AdminModuleController::editClass');
        $routes->post('delete-class', 'Web\AdminModulePages\AdminModuleController::deleteClass');

        $routes->post('add-section', 'Web\AdminModulePages\AdminModuleController::addSection');
        $routes->post('edit-section', 'Web\AdminModulePages\AdminModuleController::editSection');
        $routes->post('delete-section', 'Web\AdminModulePages\AdminModuleController::deleteSection');

        $routes->post('add-subject', 'Web\AdminModulePages\AdminModuleController::addSubject');
        $routes->post('edit-subject', 'Web\AdminModulePages\AdminModuleController::editSubject');
        $routes->post('delete-subject', 'Web\AdminModulePages\AdminModuleController::deleteSubject');
        
        $routes->post('get-class-teacher-list', 'Web\AdminModulePages\AdminModuleController::getClassTeacherList');
        $routes->post('add-class-teacher', 'Web\AdminModulePages\AdminModuleController::addClassTeacher');
        $routes->post('edit-class-teacher', 'Web\AdminModulePages\AdminModuleController::editClassTeacher');
        $routes->post('delete-class-teacher', 'Web\AdminModulePages\AdminModuleController::deleteClassTeacher');

        // Employee Pages
        $routes->post('employee-details/(:segment)', 'Web\AdminModulePages\AdminModuleController::employee_details/$1');
        $routes->post('get-employee-list', 'Web\AdminModulePages\AdminModuleController::getEmployeeList');
        $routes->post('add-employee', 'Web\AdminModulePages\AdminModuleController::addEmployee');
        $routes->post('edit-employee', 'Web\AdminModulePages\AdminModuleController::editEmployee');
        $routes->post('delete-employee', 'Web\AdminModulePages\AdminModuleController::deleteEmployee');
        $routes->post('update-employee-details', 'Web\AdminModulePages\AdminModuleController::updateEmployeeDetails');
        $routes->post('upload-employee-profile-image', 'Web\AdminModulePages\AdminModuleController::uploadEmployeeProfileImage');
        $routes->post('upload-employee-cover-image', 'Web\AdminModulePages\AdminModuleController::uploadEmployeeCoverImage');
        $routes->post('upload-employee-document', 'Web\AdminModulePages\AdminModuleController::uploadEmployeeDocument');
        $routes->post('delete-employee-document', 'Web\AdminModulePages\AdminModuleController::deleteEmployeeDocument');
        $routes->post('update-document-status', 'Web\AdminModulePages\AdminModuleController::updateDocumentStatus');
        $routes->get('download-employee-document/(:num)', 'Web\AdminModulePages\AdminModuleController::downloadEmployeeDocument/$1');

        //Subject Allocation
        $routes->post('get-subject-allocation-list', 'Web\AdminModulePages\AdminModuleController::getSubjectAllocationList');
        $routes->post('add-subject-allocation', 'Web\AdminModulePages\AdminModuleController::addSubjectAllocation');
        $routes->post('edit-subject-allocation', 'Web\AdminModulePages\AdminModuleController::editSubjectAllocation');
        $routes->post('delete-subject-allocation', 'Web\AdminModulePages\AdminModuleController::deleteSubjectAllocation');

        $routes->post('employee-list', 'Web\AdminModulePages\AdminModuleController::employee_list');    
        
        $routes->post('class-list','Web\AdminModulePages\AdminModuleController::class_list');
        $routes->post('class-teacher-list','Web\AdminModulePages\AdminModuleController::class_teacher_list');
        
        $routes->post('subject-list','Web\AdminModulePages\AdminModuleController::subject_list');
        $routes->post('subject-allocation','Web\AdminModulePages\AdminModuleController::subject_allocation'); 
        
        $routes->post('section-list','Web\AdminModulePages\AdminModuleController::section_list');
        $routes->post('payment-gateways','Web\AdminModulePages\AdminModuleController::payment_gateways');

    });

    $routes->group('employee', function($routes){
        $routes->post('dashboard', 'Web\EmployeeModulePages\EmployeeModuleController::dashboard');
        $routes->post('list', 'Web\EmployeeModulePages\EmployeeModuleController::list');
        $routes->post('profile', 'Web\EmployeeModulePages\EmployeeModuleController::employee_profile');
        $routes->post('add-edit', 'Web\EmployeeModulePages\EmployeeModuleController::add_edit');        
    });

    $routes->group('academic', function($routes){
        $routes->post('syllabus-list', 'Web\AcademicModulePages\SyllabusModuleController::list');
        $routes->post('get-syllabus-list', 'Web\AcademicModulePages\SyllabusModuleController::getSyllabusList');
        $routes->post('syllabus-details/(:segment)', 'Web\AcademicModulePages\SyllabusModuleController::syllabusDetails/$1');
        $routes->post('add-syllabus', 'Web\AcademicModulePages\SyllabusModuleController::addSyllabus');
        $routes->post('edit-syllabus', 'Web\AcademicModulePages\SyllabusModuleController::editSyllabus');
        $routes->post('delete-syllabus', 'Web\AcademicModulePages\SyllabusModuleController::deleteSyllabus');
        $routes->post('create-class-routine', 'Web\AcademicModulePages\SyllabusModuleController::add_edit_class_routine');
        $routes->post('class-routine', 'Web\AcademicModulePages\SyllabusModuleController::class_routine');
    });

    $routes->group('attendance', function($routes){
        $routes->post('list', 'Web\AttendanceModulePages\AttendanceModuleController::list');
        $routes->post('get-attendance-list', 'Web\AttendanceModulePages\AttendanceModuleController::getAttendanceList');
        $routes->post('mark-attendance', 'Web\AttendanceModulePages\AttendanceModuleController::addAttendance');
        $routes->post('edit-attendance', 'Web\AttendanceModulePages\AttendanceModuleController::editAttendance');
        $routes->post('delete-attendance', 'Web\AttendanceModulePages\AttendanceModuleController::deleteAttendance');
    });

    $routes->group('fees', function($routes){
        $routes->post('slab-list', 'Web\FeesModulePages\FeesModuleController::slabList');
        $routes->post('get-fees-slab-list', 'Web\FeesModulePages\FeesModuleController::getFeesSlabList');
        $routes->post('add-fees-slab', 'Web\FeesModulePages\FeesModuleController::addFeesSlab');
        $routes->post('edit-fees-slab', 'Web\FeesModulePages\FeesModuleController::editFeesSlab');
        $routes->post('delete-fees-slab', 'Web\FeesModulePages\FeesModuleController::deleteFeesSlab');
        
    });

    // ==================== STUDENT API ROUTES ====================
    $routes->group('student', function($routes) {
        $routes->post('list', 'Web\DashboardController::student_list');
        $routes->post('get-student-list', 'Web\DashboardController::get_student_list');
        $routes->post('add-student', 'Web\DashboardController::add_student');
        $routes->post('edit-student', 'Web\DashboardController::edit_student');
        $routes->post('delete-student', 'Web\DashboardController::delete_student');
        $routes->get('export-students', 'Web\DashboardController::export_students');
        $routes->post('get-classes', 'Web\DashboardController::get_classes');
        $routes->post('get-sections', 'Web\DashboardController::get_sections');
    });
    

    $routes->post('admission-create', 'Web\AdminModulePages\AdminModuleController::createAdmission');
    $routes->get('admin/admission/create', 'Web\AdminModulePages\AdminModuleController::createAdmission');

    // Form submission and AJAX calls
    $routes->post('add-student', 'Web\AdminModulePages\AdminModuleController::addStudent');
    $routes->post('get-students', 'Web\AdminModulePages\AdminModuleController::getStudents');
    $routes->post('edit-student', 'Web\AdminModulePages\AdminModuleController::editStudent');
    $routes->post('delete-student', 'Web\AdminModulePages\AdminModuleController::deleteStudent');
    $routes->post('upload-student-image', 'Web\AdminModulePages\AdminModuleController::uploadStudentProfileImage');

    // Dropdown data
    $routes->post('get-classes', 'Web\AdminModulePages\AdminModuleController::getClasses');
    $routes->post('get-sections', 'Web\AdminModulePages\AdminModuleController::getSections');
    // Subject List for Dropdowns
    $routes->post('get-subject-list', 'Web\AdminModulePages\AdminModuleController::getSubjectList');



    $routes->post('student-details', 'Web\AttendanceModulePages\AttendanceModuleController::student_details');

    $routes->post('student-report', 'Web\StudentModulePages\StudentModuleController::student_report');
    
    $routes->post('report-card', 'Web\StudentModulePages\StudentModuleController::report_card');

    
    // ========================================
    // EXAMINATION MODULE ROUTES
    // ========================================
    
    // Examination Routes
    $routes->group('examination', function($routes) {
        $routes->post('create-routine', 'Web\ExaminationModulePages\ExaminationModuleController::create_exam_routine');
        // List all exams
        $routes->post('exam-list', 'Web\ExaminationModulePages\ExaminationModuleController::exam_list');
                
        // View exam details
        $routes->post('exam-details/(:num)', 'Web\ExaminationModulePages\ExaminationModuleController::exam_details/$1');
        
        // Edit exam routine
        $routes->post('edit-exam-routine/(:num)', 'Web\ExaminationModulePages\ExaminationModuleController::edit_exam_routine/$1');
    });
   
    // Data/API Routes (AJAX handlers)
    $routes->group('data/examination', ['namespace' => 'App\Controllers\Data\ExaminationModulePages'], function($routes) {
        // Get all exams
        $routes->post('get-all-exams', 'ExaminationController::getAllExams');
        
        // Get one exam basic info
        $routes->post('get-one-exam', 'ExaminationController::getOneExam');
        
        // Get exam details with items, classes, and subjects (for details page)
        $routes->post('get-exam-details', 'ExaminationController::getExamDetails');
        
        // Get exam items for an exam
        $routes->post('get-exam-items', 'ExaminationController::getExamItems');
        
        // Add new exam (without items)
        $routes->post('add-exam', 'ExaminationController::addExam');
        
        // Save exam routine (create/update items for an exam)
        $routes->post('save-exam-routine', 'ExaminationController::saveExamRoutine');
        
        // Delete exam
        $routes->post('delete-exam', 'ExaminationController::deleteExam');
    });

});

// For api
$routes->group('api', ['namespace' => 'App\\Controllers\\Api'], function ($routes) {
    $routes->post('login', 'AuthController::index');
});