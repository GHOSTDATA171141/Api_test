<?php

namespace App\Entities;

use CodeIgniter\Model;

class ProvinceEntity extends Model
{
    protected $table = 'province';
    protected $primaryKey = 'province_id';
    protected $returnType = 'array';
    protected $allowedFields = [
    ];
}
