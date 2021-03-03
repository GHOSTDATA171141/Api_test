<?php

namespace App\Entities;

use CodeIgniter\Model;

class UserEntity extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'username',
        'password',
        'firstname',
        'lastname',
    ];
}
