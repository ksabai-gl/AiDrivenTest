<?php

namespace Extensions\OrderInformation\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInformationModel extends Model
{
    protected $table = 'OrderInformation';
    protected $fillable = [
        'hotline',
        'order_id'
    ];
}