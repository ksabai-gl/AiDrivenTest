<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerGroupModel extends Model
{
    use SoftDeletes;

    protected $table = 'customer_group';

    protected $fillable = [
        'business_id',
        'name',
    ];

    public function business()
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }

    public function customers()
    {
        return $this->hasMany(CustomerModel::class, 'customer_group_id');
    }
}
