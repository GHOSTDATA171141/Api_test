<?php namespace App\Modules\Dashboard\Repositories;

use CodeIgniter\Controller;

class DashboardRepositories extends Controller
{
    public function __construct()
    {
    }

    public function getDashboard()
    {
        $data = [
            'title' => 'Dashboard Page',
            'view' => 'dashboard/dashboard',
            'data' => ''
        ];

        return view('template/layout', $data);
    }
}