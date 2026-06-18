<?php

namespace Extensions\PurchaseInformation\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInformationModel extends Model
{
    protected $table = 'PurchaseInformation';
    protected $fillable = [
        'hotline',
        'purchase_id'
    ];
}