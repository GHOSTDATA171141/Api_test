<?php namespace App\Modules\CompanyManagement\Models;
			
use App\Entities\COUEntity;

class CompanyManagementModel
{
	public function __construct()
    {
        $this->couEntity = new COUEntity();        
        $this->db = \Config\Database::connect();
    }
	
    public function getcompanyRegisterModel($data)
    {
        $userTable = $this->db->table('cou');
        $query = $userTable->select('*')
            ->where('cou_email', $data['cou_email'])
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
            $this->couEntity->insert($data);
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
    public function getCompanyById($id)
    {
        $condition = array('cou_id' => $id);
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
}
	
	