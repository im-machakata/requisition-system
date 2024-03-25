<?php

use App\Controllers\AdvancedSalary;
use App\Controllers\Home;
use App\Controllers\Auth;
use App\Controllers\PettyCash;
use App\Controllers\Requisition;
use App\Controllers\TravelAndSubsistencies;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index'], ['filter' => 'auth']);

$routes->group('auth', function (RouteCollection $routes) {
    $routes->get('login', [Auth::class, 'login']);
    $routes->get('logout', [Auth::class, 'logout']);
    $routes->post('login', [Auth::class, 'createSession']);

    $routes->get('add-user', [Auth::class, 'register'], [
        'filter' => 'auth:Admin'
    ]);
    $routes->post('add-user', [Auth::class, 'createAccount'], [
        'filter' => 'auth:Admin'
    ]);

    $routes->get('change-password', [Auth::class, 'viewPassword'], [
        'filter' => 'auth'
    ]);
    $routes->post('change-password', [Auth::class, 'changePassword'], [
        'filter' => 'auth'
    ]);
});

$routes->group('requests', function (RouteCollection $routes) {
    $routes->get('advanced-salaries', [Requisition::class, 'advancedSalariesIndex'], [
        'filter' => 'auth'
    ]);
    $routes->post('advanced-salaries', [Requisition::class, 'recordAdvancedSalaries'], [
        'filter' => 'auth'
    ]);

    $routes->get('petty-cash', [Requisition::class, 'pettyCashIndex'], [
        'filter' => 'auth'
    ]);
    $routes->post('petty-cash', [Requisition::class, 'recordPettyCash'], [
        'filter' => 'auth'
    ]);

    $routes->get('travel-and-subsistencies', [Requisition::class, 'travelAndSubsistenciesIndex'], [
        'filter' => 'auth'
    ]);
    $routes->post('travel-and-subsistencies', [Requisition::class, 'recordTravelAndSubsistencies'], [
        'filter' => 'auth'
    ]);
});
