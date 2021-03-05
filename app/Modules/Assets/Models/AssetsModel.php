<?php namespace App\Modules\Assets\Models;
			
use App\Entities\AssetsEntity;

class AssetsModel
{
	public function __construct()
    {
        $this->assetsEntity = new AssetsEntity();        
        $this->db = \Config\Database::connect();
    }
	
    public function getAssetsList()
    {
        // $result = $this->assetsEntity->findAll();
		$result = [];
        return $result;
    }
	
	public function getAssetsById($id)
    {
       // $assetsTable = $this->db->table('assets');
       // $result = $assetsTable->select('*')
       // ->where('assets_id', $id)
       // ->get()->getResultArray();
		$result = [];
		return $result;
    }
    public function getAllprovince()
    {
        $userTable = $this->db->table('province');
        $result = $userTable->select('*')
            ->get()->getResultArray();
        return $result;
    }
}
	
	