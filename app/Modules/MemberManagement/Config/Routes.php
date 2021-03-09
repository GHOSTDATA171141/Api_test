<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
$routes->group(API_PATH .'/membermanagement', ['namespace' => 'App\Modules\Membermanagement\Controllers'], function($subroutes){

	$subroutes->post('member-register','Membermanagement::apimemberRegister');
	$subroutes->post('member-edit','Membermanagement::apimemberEdit');
	$subroutes->post('member-list', 'Membermanagement::apimemberById');
	$subroutes->post('member-delete', 'Membermanagement::apideletememberById');
}

);