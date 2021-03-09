<?php

namespace App\Entities;

use CodeIgniter\Model;

class JobEntity extends Model
{
    protected $table = 'job';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'job_name',
        'job_status',
        'cou_id',
        'job_format',
        'job_detail',
        'job_rank',
        'job_amount',
        'job_gpa',
        'job_salary',
        'job_exp',
        'job_time',
        'job_ppt',
        'job_travel',
    ];
}
