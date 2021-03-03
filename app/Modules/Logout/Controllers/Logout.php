<?php namespace App\Modules\Logout\Controllers;

use App\Modules\Logout\Repositories\LogoutRepositories;

class Logout extends BaseController
{
    private $logoutRepositories;

    public function __construct()
    {
        $this->logoutRepositories = new LogoutRepositories();
    }

    public function index()
    {
        return $this->logoutRepositories->userLogout();
    }
}