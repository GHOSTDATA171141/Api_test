<?php namespace App\Entities;

use CodeIgniter\Model;

class MembermanagementEntity extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'member_id',
        'firstname',
        'lastname',
        'fullname',
        'gender',
        'dob',
        'idcard',
        'phone',
        'address',
        'province',
        'amphur',
        'district',
        'zipcode',
        'status',
        'approved_date',
        'profile_img',
        'login_at',
        'created_at',
        'updated_at',
        'member_email',
        'username',
        'password',
    ];
}