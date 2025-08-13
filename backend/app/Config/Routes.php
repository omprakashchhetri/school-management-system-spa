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
// $routes->post('/api/login', 'Api\AuthController::index');