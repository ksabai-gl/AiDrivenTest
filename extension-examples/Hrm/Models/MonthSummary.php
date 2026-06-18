<?php

namespace Extensions\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthSummary extends Model
{
    use HasFactory;
    protected $table = "hrm_month_summary";
    protected $fillable = [
        'user_id',
        'business_id',
        'excel_file',
    ];
}