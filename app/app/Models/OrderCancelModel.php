<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCancelModel extends Model
{
    //
    protected $table = 'order_cancelled_reason';
    protected $fillable = [
        'order_id',
        'reason',
        'created_by'
    ];
}
