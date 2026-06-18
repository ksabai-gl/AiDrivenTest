<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierModel extends Model
{
    use SoftDeletes;

    protected $table = 'suppliers';

    protected $fillable = [
        'business_id',
        'unit_name',
        'email',
        'phone',
        'address',
        'tax_code',
        'bank_name',
        'bank_account',
        'website',
        'note',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
