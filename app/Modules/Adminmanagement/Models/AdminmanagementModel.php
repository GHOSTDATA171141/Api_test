<?php

namespace App\Modules\Adminmanagement\Models;

use App\Entities\AdminmanagementEntity;
use App\Entities\MemberManagementEntity;
use App\Entities\COUEntity;
use App\Entities\ContactEntity;
use App\Entities\AboutEntity;
use App\Entities\HelpEntity;
use App\Entities\PolicyEntity;
use App\Entities\ProvisionEntity;
// use App\Entities\UserEntity;

class AdminmanagementModel
{
    public function __construct()
    {
        $this->contentmanagementEntity = new ContactEntity();
        $this->contentaboutentity = new AboutEntity();
        $this->contentpolicyentity = new PolicyEntity();
        $this->adminEntity = new AdminmanagementEntity();
        $this->membermanagementEntity = new MemberManagementEntity();
        $this->provisionEntity = new ProvisionEntity();
        $this->helpEntity = new HelpEntity();
        $this->couEntity = new COUEntity();
        $this->db = \Config\Database::connect();
    }
////// ส่วนจัดการแอดมิน ///////
    public function getAdminList()
    {

        $adminmanagementTable = $this->db->table('admin');
        $result = $adminmanagementTable->select('*')
            // ->where('user_type', 4)
            ->get()->getResultArray();
        return $result;
    }

    public function getAdminById($id)
    {
        $condition = array('admin_id' => $id);
        $adminmanagementTable = $this->db->table('admin');
        $result = $adminmanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }


    public function updateAdmin($id, $data)
    {

        try {
            $reponse = $this->adminEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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

    public function deleteAdminById($userId)
    {

        try {
            $condition = array(
                'admin_id' => $userId,
            );

            $reponse = $this->adminEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function getProvince()
    {
        $province = $this->db->table('province')
            ->get()->getResultArray();
        return  $province;
    }

    public function getAmphur($province_id)
    {
        $amphur = $this->db->table('amphur')
            ->where(['province_id' => $province_id])
            ->get()->getResultArray();
        return  $amphur;
    }

    public function getdistrict($amphur_id)
    {
        $district = $this->db->table('district')
            ->where(['amphur_id' => $amphur_id])
            ->get()->getResultArray();
        return  $district;
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
    public function createUserAccountadmin($data)
    {
        $userTable = $this->db->table('admin');
        $query = $userTable->select('*')
            ->where('admin_email', $data['admin_email'])
            ->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        // dd($userData);

        if (!empty($userData)) {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Dupicate email',
            );
            return $result;
        }

        try {
            $reponse = $this->adminEntity->insert($data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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

    public function updateUser($id, $data)
    {

        try {
            $reponse = $this->adminEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
////// ส่วนจัดการข้อมูลสมาชิก ///////
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
        $memberTable = $this->db->table('member');
        $result = $memberTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //ดึงข้อมูลสมาชิกพร้อมเงื่อนไข
    public function getAllMemberWithCondition($condition)
    {
        $membermanagementTable = $this->db->table('member');
        $result = $membermanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //ดึงข้อมูลจังหวัด
    public function getProvinceByIdMember($id)
    {
        $condition = array('province_id' => $id);
        $memberTable = $this->db->table('province');
        $result = $memberTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //ดึงข้อมูลอำเภอ
    public function getAmphurByIdMember($id)
    {
        $condition = array('amphur_id' => $id);
        $memberTable = $this->db->table('amphur');
        $result = $memberTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //ดึงข้อมูลตำบล
    public function getDistrictByIdMember($id)
    {
        $condition = array('district_id' => $id);
        $memberTable = $this->db->table('district');
        $result = $memberTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    //อัปเดทข้อมูลสมาชิก
    public function updateMemberById($member_id, $data)
    {
        try {
            $reponse = $this->membermanagementEntity->update($member_id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    //ลบข้อมูลสมาชิก
    public function deleteMemberById($id)
    {
        try {
            $condition = array(
                'member_id' => $id,
            );
            $reponse = $this->membermanagementEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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

//////// Company 
    public function getAllCompany()
    {
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where(['cou_type' => 2])
            ->get()->getResultArray();
        return $result;
    }
    public function getCompanyById($id)
    {
        $condition = array('cou_id' => $id, 'cou_type' => 2);
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }

    public function getAllCompanyWithCondition($condition)
    {
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }

    public function updatecompanyById($cou_id, $data)
    {
        try {
            $reponse = $this->couEntity->update($cou_id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function deleteCompanyById($cou_id)
    {
        try {
            $condition = array(
                'cou_id' => $cou_id,
            );
            $reponse = $this->couEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function getProvinceByIdCompany($id)
    {
        $condition = array('province_id' => $id);
        $companymanagementTable = $this->db->table('province');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getAmphurByIdCompany($id)
    {
        $condition = array('amphur_id' => $id);
        $companymanagementTable = $this->db->table('amphur');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getDistrictByIdCompany($id)
    {
        $condition = array('district_id' => $id);
        $companymanagementTable = $this->db->table('district');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
//// University
    public function getAllUniversity()
    {
        $universitymanagementTable = $this->db->table('cou');
        $result = $universitymanagementTable->select('*')
            ->where(['cou_type' => 1])
            ->get()->getResultArray();
        return $result;
    }
    public function getUniversityById($id)
    {
        $condition = array('cou_id' => $id, 'cou_type' => 1);
        $universitymanagementTable = $this->db->table('cou');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }


    public function getAllUniversityWithCondition($condition)
    {
        $universitymanagementTable = $this->db->table('cou');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }

    public function updateUniversityById($id, $data)
    {
        try {
            $reponse = $this->couEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function deleteUniversityById($cou_id)
    {
        try {
            $condition = array(
                'cou_id' => $cou_id,
            );

            //!ดักหาก ID ที่ลบไม่ใช้ Admin ไม่อนุญาติให้ลบ

            $reponse = $this->couEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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

    public function getProvinceByIdUniversity($id)
    {
        $condition = array('province_id' => $id);
        $universitymanagementTable = $this->db->table('province');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getAmphurByIdUniversity($id)
    {
        $condition = array('amphur_id' => $id);
        $universitymanagementTable = $this->db->table('amphur');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getDistrictByIdUniversity($id)
    {
        $condition = array('district_id' => $id);
        $universitymanagementTable = $this->db->table('district');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
//////// Content
    public function getAllProvision()
    {
        $povision = $this->db->table('provision');
        $result = $povision->select('*')
            ->get()->getResultArray();
        return $result;
    }
    public function getAllContact()
    {
        $contact = $this->db->table('contactus');
        $result = $contact->select('*')
            ->get()->getResultArray();
        return $result;
    }
    public function getAllAbout()
    {
        $contact = $this->db->table('aboutus');
        $result = $contact->select('*')
            ->get()->getResultArray();
        return $result;
    }
    public function getAllPolicy()
    {
        $contact = $this->db->table('policy');
        $result = $contact->select('*')
            ->get()->getResultArray();
        return $result;
    }
    public function getAllHelp()
    {
        $help = $this->db->table('help');
        $result = $help->select('*')
            ->get()->getResultArray();
        return $result;
    }
    public function updateProvisionById($id, $data)
    {
        try {
            $reponse = $this->provisionEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
            );
            return $result;
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
            // dd($result);
        }
    }
    public function updateContactById($id, $data)
    {
        try {
            $reponse = $this->contentmanagementEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function updateAboutById($id, $data)
    {
        try {
            $reponse = $this->contentaboutentity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function updatePolicyById($id, $data)
    {
        try {
            $reponse = $this->contentpolicyentity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
    public function updateHelpById($id,$data)
    {
        try {
            $reponse = $this->helpEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $reponse
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
}
