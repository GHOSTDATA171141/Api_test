<?php namespace App\Modules\Logout\Repositories;

use CodeIgniter\Controller;

class LogoutRepositories extends Controller
{
    public function userLogout()
    {
        session()->destroy();
        return redirect()->to('/login')->setCookie('userInfo', '', time() - 3600);
    }
}