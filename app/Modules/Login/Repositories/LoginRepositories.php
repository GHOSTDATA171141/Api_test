<?php

namespace App\Modules\Login\Repositories;

use App\Modules\Login\Models\LoginModel;
use CodeIgniter\Controller;



class LoginRepositories extends Controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function userLogin()
    {
        $data = [
            'title' => 'Login Page',
            'view' => 'login/login-page',
        ];
        return view('template/layout-auth', $data);
    }

    public function userLoginProcess($request)
    {
        $param = [
            'username' => $request->getVar('username'),
            'password' => $request->getVar('password'),
            'remember' => $request->getVar('remember')
        ];
        $isLogin = $this->loginModel->getUserLogin($param);

        if (!empty($isLogin)) {
            return redirect()->to('/dashboard')->setCookie('userInfo', $isLogin['token'], $isLogin['expire']);
        } else {
            return redirect()->to('/login')->with('notification', '<b>ขออภัย!</b> อีเมลหรือรหัสผ่านไม่ถูกต้องโปรดลองอีกครั้ง..');
        }
    }
}
