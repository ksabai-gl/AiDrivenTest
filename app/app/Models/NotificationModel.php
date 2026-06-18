<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationModel extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'notifications';
    protected $appends = ['created_at_human'];
    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'entity_type',
        'is_read',
        'link',
        'entity_id',
        'business_id'
    ];
    public function getCreatedAtHumanAttribute(): ?string
    {
        return $this->created_at
            ? Carbon::parse($this->created_at)->diffForHumans()
            : null;
    }
}
