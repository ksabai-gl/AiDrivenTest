<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingModel extends Model
{
    protected $table = 'shippings';
    protected $fillable = [
        'order_id',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'receiver_note',
        'preferred_unit',
        'shipping_fee_estimated',
        'shipping_code',
        'shipping_fee_actual',
        'shipped_at',
        'delivered_at',
    ];

    /**
     * Ép kiểu dữ liệu
     */
    protected $casts = [
        'shipping_fee_estimated' => 'integer',
        'shipping_fee_actual'    => 'integer',
        'preferred_unit'         => 'integer',
        'shipped_at'             => 'date',
        'delivered_at'           => 'date',
    ];

    /**
     * ============================
     * Relationships
     * ============================
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }
    public function provider(): BelongsTo
    {
        return $this->belongsTo(ShippingProviderModel::class, 'preferred_unit');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    public function scopeShipping($query)
    {
        return $query->where('status', 'shipping');
    }
}
