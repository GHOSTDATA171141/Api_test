<?php

namespace App\Modules\User\Models;

use App\Entities\UserEntity;
use App\Helpers\UserUtils;

class UserModel
{
    public function __construct()
    {
        helper('cookie');
        $this->userEntity = new UserEntity();
        $this->userUtils = new UserUtils();
        $this->db = \Config\Database::connect();
    }

    public function addUser($data)
    {
        $userTable = $this->db->table('member');
        $query = $userTable->select('*')
            ->where('username', $data['username'])
            ->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;

        if (!empty($userData)) {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Dupicate Username',
            );
            return $result;
        }

        try {
            $this->userEntity->insert($data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'successfully!',
            );
            return $result;
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'error!'
            );
            return $result;
        }
    }

    public function getUserLogin($data)
    {
        $query = [
            'username' => $data['username'],
        ];

        $tokenData = [];
        $userTable = $this->db->table('member');
        $query = $userTable->select('*')->where($query)->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        if (!empty($userData)) {
            if (!password_verify($data['password'], $userData['password'])) {
                // the password is incorrect.
                return [
                    'resultCode' => 401,
                    'resultMessage' => 'username or password invalid',
                ];
            }else{
                $tokenData = $this->userCreateToken($userData);
                return [
                    'resultCode' => 200,
                    'resultMessage' => 'login successfully!',
                    'data' => $tokenData
                ];
            }  
        }else{
            return [
                'resultCode' => 401,
                'resultMessage' => 'username or password invalid',
            ];
        }
       
    }
    public function getUserAuth()
    {
        $user_token = get_cookie('userInfo');
        if (!empty($user_token)) {
            $token_data = $this->userUtils->jwtTokenDecode($user_token);
            if ($token_data['resultCode'] !== 200) {
                $result = array(
                    'resultCode' => 401,
                    'resultMessage' => 'Unauthorized',
                );
                return $result;
            }
            $query = [
                'admin_email' => $token_data['result']['admin_email'],
                'admin_id' => $token_data['result']['admin_id'],
            ];
            $userTable = $this->db->table('admin');
            $query = $userTable->select('*')->where($query)->get()->getResultArray();
            $userData = !empty($query) ? $query[0] : null;

            if (!empty($userData)) {
                $result = array(
                    'resultCode' => 200,
                    'resultMessage' => 'Success',
                    'data' => $userData,
                );
            } else {
                $result = array(
                    'resultCode' => 401,
                    'resultMessage' => 'Unauthorized',
                );
            }
            return $result;
        } else {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Unauthorized',
            );
            return $result;
        }
    }
    
    public function userCreateToken($data)
    {
        $setToken = array(
            'id' => $data['member_id'],
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        );
        $token = $this->userUtils->jwtEncodeToken($setToken, time() + TOKEN_EXPIRE);
        $RefreshToken = $this->userUtils->jwtEncodeToken($setToken, time() + REFRESH_TOKEN_EXPIRE);
        return ['token' => $token, 'RefreshToken' => $RefreshToken];
    }

    public function getAlluser()
    {
        $userTable = $this->db->table('member');
        $result = $userTable->select('*')
            ->get()->getResultArray();
        return $result;
    }

    public function getUserRefesh($token)
    { 
        $statusToken = $this->userUtils->jwtDecodeToken($token);
        if($statusToken['resultCode']==200){ 

            $query = [
                'username' => $statusToken['data']['username'],
            ];
            $tokenData = [];
            $userTable = $this->db->table('member');
            $query = $userTable->select('*')->where($query)->get()->getResultArray();
            $userData = !empty($query) ? $query[0] : null;
            $tokenData = $this->userCreateToken($userData);
            return [
                'resultCode' => 200,
                'resultMessage' => 'login successfully!',
                'data' => $tokenData
            ];
           

        }else{
            return [
                'resultCode' => 401,
                'resultMessage' => 'Expired refreshtoken',
            ];
        }
    }

}
