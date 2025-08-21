<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', ['namespace' => 'App\\Controllers\\Api'], function ($routes) {
    $routes->post('login', 'AuthController::index');
});


$routes->post('/', 'Web\DashboardController::dashboard');
$routes->post('login', 'Web\DashboardController::login');
$routes->get('pre-login', 'Web\DashboardController::pre_login');

$routes->group('post-login-employee', function($routes) {
    // Match exactly /post-login
    $routes->get('/', 'Web\PostLoginController::employee_post_login');
    
    // Match /post-login/anything
    $routes->get('(:any)', 'Web\PostLoginController::employee_post_login');
});

// STUDENT
$routes->group('post-login-student', function($routes) {
    // Match exactly /post-login
    $routes->get('/', 'Web\PostLoginController::student_post_login');

    // Match /post-login/anything
    $routes->get('(:any)', 'Web\PostLoginController::student_post_login');
});
$routes->post('student-list', 'Web\DashboardController::student_list');
$routes->post('employee-list', 'Web\DashboardController::employee_list');
$routes->post('subject-list', 'Web\DashboardController::subject_list');
$routes->post('student-dashboard', 'Web\DashboardController::student_dashboard');
$routes->post('student-dashboard-2', 'Web\DashboardController::student_dashboard_test');

$routes->group('admin', function($routes){
    $routes->get('role-list', 'Web\AdminModulePages\AdminModuleController::roleManagement');
    $routes->get('role-tool-management/(:any)', 'Web\AdminModulePages\AdminModuleController::roleToolManagement/$1');
    
});

// $routes->post('/api/login', 'Api\AuthController::index');
// $routes->post('/api/login', 'Api\AuthController::index');
// $routes->get('list', 'Web\DashboardController::list'); //test endpoint for List page