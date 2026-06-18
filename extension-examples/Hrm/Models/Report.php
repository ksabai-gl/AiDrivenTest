<?php

namespace Extensions\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = "hrm_end_of_day_reports";
    protected $fillable = [
        'user_id',
        'business_id',
        'date',
        'summary',
        'tasks_done',
        'issues',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}