<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/auth/login', [Auth::class, 'login']);
$routes->get('/auth/logout', [Auth::class, 'logout']);
$routes->post('/auth/login', [Auth::class, 'createSession']);

$routes->get('/auth/add-user', [Auth::class, 'register']);
$routes->post('/auth/add-user', [Auth::class, 'createAccount']);