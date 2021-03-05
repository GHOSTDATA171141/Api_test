<?php namespace App\Modules\Dashboard\Controllers;

use CodeIgniter\Controller;
use App\Modules\Dashboard\Repositories\DashboardRepositories;

class Dashboard extends BaseController
{
    private $dashboardRepositories;

    public function __construct()
    {
        $this->dashboardRepositories = new DashboardRepositories();
    }

    public function index()
    {
        return $this->dashboardRepositories->getDashboard();
    }
}