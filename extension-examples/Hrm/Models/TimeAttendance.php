<?php

namespace Extensions\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeAttendance extends Model
{
    use HasFactory;
    protected $table = "hrm_time_attendances";
    protected $fillable = [
        'user_id',
        'business_id',
        'date',
        'check_in_time',
        'check_out_time',
        'working_hours',
        'note',
        'ip',
        'approved',
        'user_agent'
    ];

    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
        'working_hours' => 'decimal:2',
        'approved'=> 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function calculateWorkingHours()
    {
        if ($this->check_in_time && $this->check_out_time) {
            $hours = $this->check_in_time->diffInHours($this->check_out_time);
            $this->working_hours = $hours;
            $this->save();
        }
    }
}