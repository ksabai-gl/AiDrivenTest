<?php

namespace Extensions\TrackingNumberOrderShipping\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'TrackingShipping';
    protected $fillable = [
        'tracking_number',
        'shipping_id'
    ];
}