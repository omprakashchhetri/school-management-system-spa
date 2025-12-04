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
        $routes->post('add-edit', 'Web\EmployeeModulePages\EmployeeModuleController::add_edit');        
    });
});

// For api
$routes->group('api', ['namespace' => 'App\\Controllers\\Api'], function ($routes) {
    $routes->post('login', 'AuthController::index');
});