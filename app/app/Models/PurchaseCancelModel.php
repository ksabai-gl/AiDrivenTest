<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseCancelModel extends Model
{
    //
    protected $table = 'purchase_cancelled_reason';
    protected $fillable = [
        'purchase_id',
        'reason',
        'created_by'
    ];
}
