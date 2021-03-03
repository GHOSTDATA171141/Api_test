<?php namespace App\Entities;

use CodeIgniter\Model;

class COUEntity extends Model
{
    protected $table = 'cou';
    protected $primaryKey = 'cou_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'cou_id',
        'cou_name_th',
        'cou_name_en',
        'cou_description',
        'cou_email',
        'cou_category',
        'cou_type',
        'cou_status',
        'cou_address',
        'cou_taxpayer_number',
        'cou_tel_number',
        'cou_approved_at',
        'province',
        'amphur',
        'district',
        'zipcode',
        'cou_uni_major',
        'cou_uni_faculty',
        'login_at',
        'created_at',
        'updated_at',

    ];
}