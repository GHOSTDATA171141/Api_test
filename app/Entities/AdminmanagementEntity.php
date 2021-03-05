<?php namespace App\Entities;

use CodeIgniter\Model;

class AdminmanagementEntity extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id ';
    protected $returnType = 'array';
    protected $allowedFields = [
        'admin_id',
        'firstname',
        'lastname',
        'admin_email',
        'username',
        'password',
    ];
}