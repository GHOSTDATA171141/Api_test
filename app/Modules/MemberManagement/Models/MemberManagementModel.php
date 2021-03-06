<?php

namespace App\Modules\Membermanagement\Models;

use App\Entities\MembermanagementEntity;

class MembermanagementModel
{
    public function __construct()
    {
        $this->membermanagementEntity = new MembermanagementEntity();
        $this->db = \Config\Database::connect();
    }

    //ดึงข้อมูลสมาชิกทั้งหมด
    public function getAllMembers()
    {
        $membermanagementTable = $this->db->table('member');
        $result = $membermanagementTable->select('*')
            ->get()->getResultArray();
        return $result;
    }

    //ดีงข้อมูลสมาชิกตัวเดียว
    public function getMemberById($id)
    {
        $condition = array('member_id' => $id);
        $companymanagementTable = $this->db->table('member');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //ลบข้อมูล
    public function apiDeletememberById($id)
    {
        try {
            $condition = array(
                'member_id' => $id,
            );
            $response = $this->membermanagementEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }

    public function getmemberRegisterModel($data)
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
            $this->membermanagementEntity->insert($data);
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

    public function getmemberEditModel($id, $data)
    {

        try {

            $exist = $this->membermanagementEntity->find($id);
            if ($exist != null) {
                $response = $this->membermanagementEntity->update($id, $data);
                $result = array(
                    'resultCode' => 200,
                    'resultMessage' => 'Success',
                    'data' => $response
                );
                return $result;
            } else {
                $result = array(
                    'resultCode' => 500,
                    'resultMessage' => 'Not Found ID'
                );
                return $result;
            }
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
}
