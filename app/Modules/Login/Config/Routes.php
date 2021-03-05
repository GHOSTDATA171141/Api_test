<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('login', ['namespace' => 'App\Modules\Login\Controllers'], function ($subroutes) {
    $subroutes->add('', 'Login::index');
    $subroutes->post('process', 'Login::loginProcess');
});