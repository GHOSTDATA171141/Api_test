<?php namespace App\Entities;

use CodeIgniter\Model;

class AssetsEntity extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'assets_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'assets_id',
    ];
}