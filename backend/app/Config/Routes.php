<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login screen
$routes->get('pre-login', 'Web\DashboardController::pre_login');
$routes->post('login', 'Web\DashboardController::login');

// For student type
$routes->group('post-login-student', function($routes) {
    
    $routes->get('', 'Web\StudentModulePages\StudentModuleController::dashboard');
    $routes->post('', 'Web\StudentModulePages\StudentModuleController::dashboard');

    $routes->get('(:any)', 'Web\PostLoginController::student_post_login');

    $routes->post('profile', 'Web\StudentModulePages\StudentModuleController::profile');
    $routes->post('documents', 'Web\StudentModulePages\StudentModuleController::document_list');

});

// For Employee type
$routes->group('post-login-employee', function($routes) {
    // Match exactly /post-login
    $routes->get('', 'Web\DashboardController::dashboard');
    $routes->post('', 'Web\DashboardController::dashboard');
    
    // Match /post-login/anything
    $routes->get('(:any)', 'Web\PostLoginController::employee_post_login');

    $routes->post('student-list', 'Web\DashboardController::student_list');
    $routes->post('employee-list', 'Web\DashboardController::employee_list');
    $routes->post('subject-list', 'Web\DashboardController::subject_list');

    $routes->post('class-list','Web\AdminModulePages\AdminModuleController::class_list');
    $routes->post('class-teacher-list','Web\AdminModulePages\AdminModuleController::class_teacher_list');
    $routes->post('subject-list','Web\AdminModulePages\AdminModuleController::subject_list');
    $routes->post('subject-allocation','Web\AdminModulePages\AdminModuleController::subject_association');
    $routes->post('section-list','Web\AdminModulePages\AdminModuleController::subject_list');
    $routes->post('payment-gateways','Web\AdminModulePages\AdminModuleController::payment_gateways');

    $routes->group('admin', function($routes){
        $routes->post('role-list', 'Web\AdminModulePages\AdminModuleController::roleManagement');
        $routes->post('role-details/(:any)', 'Web\AdminModulePages\AdminModuleController::roleToolManagement/$1');    
    });
});

// For api
$routes->group('api', ['namespace' => 'App\\Controllers\\Api'], function ($routes) {
    $routes->post('login', 'AuthController::index');
});