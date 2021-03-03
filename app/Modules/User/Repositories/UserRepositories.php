<?php

namespace App\Modules\User\Repositories;

use App\Libraries\Logger;
use CodeIgniter\Controller;
use App\Modules\User\Models\UserModel;
use APP\Helpers\UserUtils;



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
            'province' => $request['payloads']['province'],
            'amphur' => $request['payloads']['amphur'],
            'district' => $request['payloads']['district'],
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

    public function getUserProcess($request)
    {
        $response= $this->userModel->getAlluser();
        $this->logger->writeApiLogs($request,$response,'user-list');
        return $response;

    }
    public function getUserRefreshProcess($request)
    {
        $refreshToken = $request['payloads']['RefreshToken'];
        $response = $this->userModel->getUserRefesh($refreshToken);
        // $this->logger->writeApiLogs($request,$response,'user-refresh');
        return $response;

    }
}
