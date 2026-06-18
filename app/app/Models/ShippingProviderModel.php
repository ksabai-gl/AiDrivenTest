<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingProviderModel extends Model
{
    use SoftDeletes;

    protected $table = 'shipping_providers';

    protected $fillable = [
        'name',
        'code',
        'logo',
        'active',
        'business_id'
    ];
    protected $casts = [
        'active' => 'boolean',
    ];
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
