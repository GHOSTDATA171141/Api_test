<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group(API_PATH.'/companymanagement', ['namespace' => 'App\Modules\Companymanagement\Controllers'], function($subroutes){

	$subroutes->post('company-register', 'Companymanagement::apicompanyRegister');
	$subroutes->post('company-list', 'Companymanagement::apicompanyByid');

});