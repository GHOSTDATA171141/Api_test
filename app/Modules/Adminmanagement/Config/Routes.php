<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('adminmanagement', ['namespace' => 'App\Modules\Adminmanagement\Controllers'], function($subroutes){
///// Admin
	$subroutes->add('', 'AdminManagement::index');
	$subroutes->get('add', 'AdminManagement::add');
	$subroutes->get('editadmin/(:num)', 'AdminManagement::edit/$1');
	$subroutes->post('editeditadmin/(:num)', 'AdminManagement::update');
	$subroutes->get('deleteadmin/(:num)', 'AdminManagement::delete/$1');
	$subroutes->get('changepassword', 'AdminManagement::changepassword');
	$subroutes->post('changepassword', 'AdminManagement::changepasswordprocess');
	$subroutes->post('add', 'AdminManagement::addadmin');
	$subroutes->get('getprovince', 'AdminManagement::getprovince');
	$subroutes->post('getamphur', 'AdminManagement::getamphur');
	$subroutes->post('getdistrict', 'AdminManagement::getdistrict');
///// Member
	$subroutes->add('getlistmember', 'AdminManagement::getPagememberlist');
	$subroutes->get('approvemember', 'AdminManagement::getPageApproveMembers');
	$subroutes->get('banmember', 'AdminManagement::getPagememberBanList');
	$subroutes->get('hismember', 'AdminManagement::getPagememberHistory');
	$subroutes->get('editmember/(:num)','AdminManagement::getPageEditMember/$1');
	$subroutes->post('getmember', 'AdminManagement::getMemberShowPage');
	$subroutes->post('editmember/(:num)', 'AdminManagement::updatememberProcess');
	$subroutes->get('approvemember/(:num)', 'AdminManagement::approvememberProcess/$1');
	$subroutes->get('banmember/(:num)', 'AdminManagement::banmemberProcess/$1');
	$subroutes->get('unbanmember/(:num)', 'AdminManagement::unbanmemberProcess/$1');
	$subroutes->get('deletemember/(:num)', 'AdminManagement::deletememberProcess/$1');
/////// Company
	$subroutes->add('getcompanylist', 'AdminManagement::getPagecompanylist');
	$subroutes->get('approvecompany', 'AdminManagement::getPageApproveCompany');
	$subroutes->get('bancompany', 'AdminManagement::getPagecompanyBanList');
	$subroutes->get('hiscompany', 'AdminManagement::getPagecompanyHistory');
	$subroutes->get('editcompany/(:num)', 'AdminManagement::getPageEditCompany/$1');
	$subroutes->post('getcompany', 'AdminManagement::getCompanyShowPage');
	$subroutes->post('editcom/(:num)', 'AdminManagement::updatecompanyProcess');
	$subroutes->get('approvecompany/(:num)', 'AdminManagement::approvecompanyProcess/$1');
	$subroutes->get('bancompany/(:num)', 'AdminManagement::bancompanyProcess/$1');
	$subroutes->get('unbancompany/(:num)', 'AdminManagement::unbancompanyProcess/$1');
	$subroutes->get('deletecompany/(:num)', 'AdminManagement::deletecompanyProcess/$1');
///// University
	$subroutes->get('getuniversitylist','AdminManagement::getPageuniversitylist');
	$subroutes->get('approveuniversity', 'AdminManagement::getPageApproveUniversity');
	$subroutes->get('banuniversity', 'AdminManagement::getPageBanUniversityList');
	$subroutes->get('hisuniversity', 'AdminManagement::getPageHistoryUniversity');
	$subroutes->get('edituniversity/(:num)', 'AdminManagement::getPageEditUniversity/$1');
	$subroutes->post('getUniversitylistshow', 'AdminManagement::getUniversityShowPage');
	$subroutes->post('edituniversity/(:num)', 'AdminManagement::updateUniversityProcess');
	$subroutes->get('approveuniversity/(:num)', 'AdminManagement::approveUniversityProcess/$1');
	$subroutes->get('banuniversity/(:num)', 'AdminManagement::banUniversityProcess/$1');
	$subroutes->get('unbanuniversity/(:num)', 'AdminManagement::unbanuniversityProcess/$1');
	$subroutes->get('deleteuniversity/(:num)', 'AdminManagement::deleteuniversityProcess/$1');
////// Content
	$subroutes->get('provision','AdminManagement::getProvision');
	$subroutes->get('contact','AdminManagement::getContact');
	$subroutes->get('about','AdminManagement::getAbout');
	$subroutes->get('policy','AdminManagement::getPolicy');
	$subroutes->get('help','AdminManagement::getHelp');
	$subroutes->post('provision','AdminManagement::updateProvisionProcess');
	$subroutes->post('contact','AdminManagement::updateContactProcess');
	$subroutes->post('about','AdminManagement::updateAboutProcess');
	$subroutes->post('policy','AdminManagement::updatePolicyProcess');
	$subroutes->post('help','AdminManagement::updateHelpProcess');



});