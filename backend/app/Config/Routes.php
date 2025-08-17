<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', ['namespace' => 'App\\Controllers\\Api'], function ($routes) {
    $routes->post('login', 'AuthController::index');
});


$routes->get('/', 'Web\DashboardController::dashboard');
$routes->post('login', 'Web\DashboardController::login'); //test endpoint for login, replace with actual login page
$routes->get('login', 'Web\DashboardController::login'); //test endpoint for login, replace with actual login page
$routes->get('test', 'Web\DashboardController::test'); //test endpoint for login, replace with actual login page
$routes->group('post-login', function($routes) {
    // Match exactly /post-login
    $routes->get('/', 'Web\PostLoginController::index');

    // Match /post-login/anything
    $routes->get('(:any)', 'Web\PostLoginController::index');
});

$routes->group('admin', function($routes){
    $routes->get('role-list', 'Web\AdminModulePages\AdminModuleController::roleManagement');
});

// $routes->post('/api/login', 'Api\AuthController::index');