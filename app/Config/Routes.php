<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/auth/login', [Auth::class, 'login']);
$routes->post('/auth/login', [Auth::class, 'createSession']);
