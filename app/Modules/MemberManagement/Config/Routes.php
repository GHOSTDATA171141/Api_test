<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}
$routes->group(API_PATH .'/membermanagement', ['namespace' => 'App\Modules\MemberManagement\Controllers'], function($subroutes){

	$subroutes->post('member-register','MemberManagement::apimemberRegister');
	$subroutes->post('member-edit','MemberManagement::apimemberEdit');
	$subroutes->post('member-list', 'MemberManagement::apimemberById');
	$subroutes->post('member-delete', 'MemberManagement::apideletememberById');
}

);