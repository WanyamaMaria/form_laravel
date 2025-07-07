<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RightsRequest extends Model
{
use SoftDeletes;
   protected $casts = [
    'rights' => 'array',
    'section_manager_date' => 'date',
    'hod_date' => 'date',
    'finance_head_date' => 'date',
];

protected $fillable = [
    'date',
    'staff_name',
    'department',
    'section',
    'job_title',
    'rights',
    'urgency',
    'section_manager_name',
    'section_manager_job_title',
    'section_manager_signature',
    'section_manager_date',
    'hod_name',
    'hod_job_title',
    'hod_signature',
    'hod_date',
    'finance_head_name',
    'finance_head_job_title',
    'finance_head_signature',
    'finance_head_date',
];


}
