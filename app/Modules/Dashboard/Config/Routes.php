<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('dashboard', ['namespace' => 'App\Modules\Dashboard\Controllers'], function ($subroutes) {
    $subroutes->add('', 'Dashboard::index');
});