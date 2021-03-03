<?php

namespace App\Modules\User\Repositories;

use App\Libraries\Logger;
use CodeIgniter\Controller;
use App\Modules\User\Models\UserModel;



class UserRepositories extends Controller
{
    public function __construct()
    {
        $this->logger = new Logger();
        $this->userModel = new UserModel();
    }

    public function getUserInfo($request)
    {
        try {
            $response = [
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => 'User data',
            ];
            $this->logger->writeApiLogs($request, $response, 'get-profile');
            return $response;
        } catch (\Exception $e) {
            $response = [
                'resultCode' => 500,
                'resultMessage' => $e->getMessage(),
            ];
            $this->logger->writeApiLogs($request, $response, 'get-profile');
            return $response;
        }
    }


    public function userRegister($request)
    {
        $data = [
            'username' => $request['payloads']['username'],
            'password' => password_hash($request['payloads']['password'], PASSWORD_DEFAULT),
            'firstname' => $request['payloads']['firstname'],
            'lastname' => $request['payloads']['lastname'],
        ];
        $response =  $this->userModel->addUser($data);
        $this->logger->writeApiLogs($request, $response, 'user-regis');
        return $response;
    }


    public function loginProcess($request)
    {
        $data = [
            'username' => $request['payloads']['username'],
            'password' => $request['payloads']['password'],
        ];
        $response = $this->userModel->getUserLogin($data);
        $this->logger->writeApiLogs($request, $response, 'user-login');
        return $response;
    }
}
