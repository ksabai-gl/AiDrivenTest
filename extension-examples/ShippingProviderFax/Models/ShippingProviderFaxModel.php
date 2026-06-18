<?php

namespace Extensions\ShippingProviderFax\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingProviderFaxModel extends Model
{
    protected $table = 'ShippingFax';
    protected $fillable = ['shipping_id','fax'];
}