<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group(API_PATH . '/user', ['namespace' => 'App\Modules\User\Controllers'], function ($subroutes) {
    $subroutes->post('profile', 'User::userInfo');
    $subroutes->post('userRegis', 'User::userRegis');
    $subroutes->post('userLogin', 'User::userLogin');
    $subroutes->get('userList', 'User::userList');
    $subroutes->post('userReFresh', 'User::userReFresh');

});
