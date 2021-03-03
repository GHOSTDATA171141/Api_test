<?php

namespace App\Entities;

use CodeIgniter\Model;

class UserEntity extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id ';
    protected $returnType = 'array';
    protected $allowedFields = [
        'member_id ',
        'username',
        'password',
        'firstname',
        'lastname',
        'province',
        'amphur',
        'district',
    ];
}
