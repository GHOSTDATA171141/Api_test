<?php
namespace App\Modules\User\Models;

use App\Entities\ProfileInfoEntity;

class ProfileModel
{
    public function __construct()
    {
        $this->profileInfoEntity = new ProfileInfoEntity();
        $this->db = \Config\Database::connect();
    }
}