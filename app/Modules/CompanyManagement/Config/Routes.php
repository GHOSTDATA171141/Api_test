<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group(API_PATH.'/companymanagement', ['namespace' => 'App\Modules\CompanyManagement\Controllers'], function($subroutes){

	$subroutes->post('company-register', 'CompanyManagement::apicompanyRegister');
	$subroutes->post('company-list', 'CompanyManagement::apicompanyByid');

});