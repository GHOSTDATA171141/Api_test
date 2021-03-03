<?php

namespace App\Modules\User\Models;

use App\Entities\UserEntity;
use App\Helpers\UserUtils;

class UserModel
{
    public function __construct()
    {
        $this->userEntity = new UserEntity();
        $this->userUtils = new UserUtils();
        $this->db = \Config\Database::connect();
    }

    public function addUser($data)
    {
        $userTable = $this->db->table('users');
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
        $userTable = $this->db->table('users');
        $query = $userTable->select('*')->where($query)->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        if (!empty($userData)) {
            if (!password_verify($data['password'], $userData['password'])) {
                // the password is incorrect.
                return [
                    'resultCode' => 401,
                    'resultMessage' => 'username or password invalid',
                ];
            }
            $tokenData = $this->userCreateToken($userData);
        }
        return [
            //login success
            'resultCode' => 200,
            'resultMessage' => 'login successfully!',
            'data' => $tokenData
        ];
    }

    public function userCreateToken($data)
    {
        $setToken = array(
            'id' => $data['id'],
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        );
        $token = $this->userUtils->jwtEncodeToken($setToken, time() + TOKEN_EXPIRE);
        $RefreshToken = $this->userUtils->jwtEncodeToken($setToken, time() + REFRESH_TOKEN_EXPIRE);
        return ['token' => $token, 'RefreshToken' => $RefreshToken];
    }
}
