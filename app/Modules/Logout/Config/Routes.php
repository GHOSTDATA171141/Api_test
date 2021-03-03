<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('logout', ['namespace' => 'App\Modules\Logout\Controllers'], function ($subroutes) {
    $subroutes->add('', 'Logout::index');
});