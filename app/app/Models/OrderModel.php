<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    /**
     * Fields allowed for mass assignment
     */
    protected $fillable = [
        'business_id',
        'order_no',
        'customer_id',
        'order_date',
        'expected_delivery_date',
        'status',
        'created_by',
        'approved_by',
        'updated_by',
        'note',
        'type',
    ];

    /**
     * Field casts
     */
    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Relationships
     */

    public function shipping()
    {
        return $this->hasOne(ShippingModel::class, 'order_id');
    }

    public function business()
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
