<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

use App\Controllers\LoginController;
$routes->get('login_', [LoginController::class, 'index']);
$routes->post('login_', [LoginController::class, 'create']);
