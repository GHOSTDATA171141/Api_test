<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('adminmanagement', ['namespace' => 'App\Modules\Adminmanagement\Controllers'], function($subroutes){
///// Admin
	$subroutes->add('', 'Adminmanagement::index');
	$subroutes->get('add', 'Adminmanagement::add');
	$subroutes->get('editadmin/(:num)', 'Adminmanagement::edit/$1');
	$subroutes->post('editeditadmin/(:num)', 'Adminmanagement::update');
	$subroutes->get('deleteadmin/(:num)', 'Adminmanagement::delete/$1');
	$subroutes->get('changepassword', 'Adminmanagement::changepassword');
	$subroutes->post('changepassword', 'Adminmanagement::changepasswordprocess');
	$subroutes->post('add', 'Adminmanagement::addadmin');
	$subroutes->get('getprovince', 'Adminmanagement::getprovince');
	$subroutes->post('getamphur', 'Adminmanagement::getamphur');
	$subroutes->post('getdistrict', 'Adminmanagement::getdistrict');
///// Member
	$subroutes->add('getlistmember', 'Adminmanagement::getPagememberlist');
	$subroutes->get('approvemember', 'Adminmanagement::getPageApproveMembers');
	$subroutes->get('banmember', 'Adminmanagement::getPagememberBanList');
	$subroutes->get('hismember', 'Adminmanagement::getPagememberHistory');
	$subroutes->get('editmember/(:num)','Adminmanagement::getPageEditMember/$1');
	$subroutes->post('getmember', 'Adminmanagement::getMemberShowPage');
	$subroutes->post('editmember/(:num)', 'Adminmanagement::updatememberProcess');
	$subroutes->get('approvemember/(:num)', 'Adminmanagement::approvememberProcess/$1');
	$subroutes->get('banmember/(:num)', 'Adminmanagement::banmemberProcess/$1');
	$subroutes->get('unbanmember/(:num)', 'Adminmanagement::unbanmemberProcess/$1');
	$subroutes->get('deletemember/(:num)', 'Adminmanagement::deletememberProcess/$1');
/////// Company
	$subroutes->add('getcompanylist', 'Adminmanagement::getPagecompanylist');
	$subroutes->get('approvecompany', 'Adminmanagement::getPageApproveCompany');
	$subroutes->get('bancompany', 'Adminmanagement::getPagecompanyBanList');
	$subroutes->get('hiscompany', 'Adminmanagement::getPagecompanyHistory');
	$subroutes->get('editcompany/(:num)', 'Adminmanagement::getPageEditCompany/$1');
	$subroutes->post('getcompany', 'Adminmanagement::getCompanyShowPage');
	$subroutes->post('editcom/(:num)', 'Adminmanagement::updatecompanyProcess');
	$subroutes->get('approvecompany/(:num)', 'Adminmanagement::approvecompanyProcess/$1');
	$subroutes->get('bancompany/(:num)', 'Adminmanagement::bancompanyProcess/$1');
	$subroutes->get('unbancompany/(:num)', 'Adminmanagement::unbancompanyProcess/$1');
	$subroutes->get('deletecompany/(:num)', 'Adminmanagement::deletecompanyProcess/$1');
///// University
	$subroutes->get('getuniversitylist','Adminmanagement::getPageuniversitylist');
	$subroutes->get('approveuniversity', 'Adminmanagement::getPageApproveUniversity');
	$subroutes->get('banuniversity', 'Adminmanagement::getPageBanUniversityList');
	$subroutes->get('hisuniversity', 'Adminmanagement::getPageHistoryUniversity');
	$subroutes->get('edituniversity/(:num)', 'Adminmanagement::getPageEditUniversity/$1');
	$subroutes->post('getUniversitylistshow', 'Adminmanagement::getUniversityShowPage');
	$subroutes->post('edituniversity/(:num)', 'Adminmanagement::updateUniversityProcess');
	$subroutes->get('approveuniversity/(:num)', 'Adminmanagement::approveUniversityProcess/$1');
	$subroutes->get('banuniversity/(:num)', 'Adminmanagement::banUniversityProcess/$1');
	$subroutes->get('unbanuniversity/(:num)', 'Adminmanagement::unbanuniversityProcess/$1');
	$subroutes->get('deleteuniversity/(:num)', 'Adminmanagement::deleteuniversityProcess/$1');
////// Content
	$subroutes->get('provision','Adminmanagement::getProvision');
	$subroutes->get('contact','Adminmanagement::getContact');
	$subroutes->get('about','Adminmanagement::getAbout');
	$subroutes->get('policy','Adminmanagement::getPolicy');
	$subroutes->get('help','Adminmanagement::getHelp');
	$subroutes->post('provision','Adminmanagement::updateProvisionProcess');
	$subroutes->post('contact','Adminmanagement::updateContactProcess');
	$subroutes->post('about','Adminmanagement::updateAboutProcess');
	$subroutes->post('policy','Adminmanagement::updatePolicyProcess');
	$subroutes->post('help','Adminmanagement::updateHelpProcess');
/////// JOB
	$subroutes->get('getjoblist','Adminmanagement::getPageJoblist');
	$subroutes->get('editjob/(:num)','Adminmanagement::getPageJobedit/$1');



});