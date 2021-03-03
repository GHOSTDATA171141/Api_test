<?php

namespace App\Modules\Login\Models;

use App\Helpers\UserUtils;
use CodeIgniter\Model;

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->userUtils = new UserUtils();
        $this->db = \Config\Database::connect();
    }

    public function getUserLogin($param)
    {
        $query = [
            'admin_email' => $param['username'],
            // 'status' => 1,
            // 'verify_date !=' => '0000-00-00 00:00:00'
        ];
        $tokenData = [];
        $userTable = $this->db->table('admin');
        $query = $userTable->select('*')->where($query)->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        if (!empty($userData)) {
            if (!password_verify($param['password'], $userData['password'])) {
                // the password is incorrect.
                return null;
            }
            $userData['remember'] = (!empty($param['remember']) && $param['remember'] == 'on') ? 'on' : '';
            $this->updateLoginDate($userData['admin_id']);
            $tokenData = $this->createAuthSession($userData);
        }
        return $tokenData;
    }

    public function updateLoginDate($user_id)
    {
        $userTable = $this->db->table('admin');
        $userTable->set('login_at', date('Y-m-d H:i:s'));
        $userTable->where('admin_id', $user_id);
        return $userTable->update();
    }

    public function createAuthSession($data)
    {
        $expire = (!empty($data['remember'])) ? 60 * 60 * 24 * 365 : 0;
        $setToken = array(
            'admin_id' => $data['admin_id'],
            'admin_email' => $data['admin_email']
        );
        $token = $this->userUtils->jwtTokenEncode($setToken);
        return ['token' => $token, 'expire' => $expire];
    }
}
