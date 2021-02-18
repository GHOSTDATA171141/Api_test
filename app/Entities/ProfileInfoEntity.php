<?php namespace App\Entities;

use CodeIgniter\Model;

class ProfileInfoEntity extends Model
{
    protected $table = 'profileinfo';
    protected $primaryKey = 'user_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'firstname',
        'lastname',
        'fullname',
        'email',
        'username',
        'password',
        'account_type',
        'verify_date',
        'user_type',
        'province',
        'status',
        'ip',
    ];
}