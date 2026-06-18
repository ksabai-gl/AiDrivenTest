<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessModel extends Model
{
    //
    public $table = "business";
    protected $fillable = [
        'name', 
        'address', 
        'tax_code',
        'phone',
        'email',
        'logo_url',
        'bank_name',
        'bank_account_number',
        'bank_account_name'
    ];
}
