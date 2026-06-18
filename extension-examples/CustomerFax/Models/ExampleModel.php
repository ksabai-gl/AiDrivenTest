<?php

namespace Extensions\CustomerFax\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'CustomerFax';
    protected $fillable = [
        'fax',
        'customer_id'
    ];
}