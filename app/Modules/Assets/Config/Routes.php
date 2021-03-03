<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('assets', ['namespace' => 'App\Modules\Assets\Controllers'], function($subroutes){

	$subroutes->add('', 'Assets::index');
	$subroutes->get('province', 'Assets::getProvince');
	


});