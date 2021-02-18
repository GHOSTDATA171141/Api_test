<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group(API_PATH . '/user', ['namespace' => 'App\Modules\User\Controllers'], function ($subroutes) {
    $subroutes->post('profile', 'Profile::userProfileInfo');
});