<?php namespace App\Modules\Login\Controllers;

use App\Modules\Login\Repositories\LoginRepositories;

class Login extends BaseController
{
    private $loginRepositories;

    public function __construct()
    {
        $this->loginRepositories = new LoginRepositories();
    }

    public function index()
    {
        return $this->loginRepositories->userLogin();
    }

    public function loginProcess()
    {
        if (!$this->validate(
            [
                'username' => 'required|valid_email',
                'password' => 'required|string'
            ]
        )) {
            return redirect()->to('/login')->
                   with('notification', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
        
        return $this->loginRepositories->userLoginProcess($this->request);
    }
}