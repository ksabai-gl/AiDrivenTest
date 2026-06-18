<?php

namespace Extensions\ProductRenew\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'ProductRenew';
    protected $fillable = [
        'is_renew',
        'product_id'
    ];
}