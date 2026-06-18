<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseModel extends Model
{
    use SoftDeletes;

    protected $table = 'purchases';

    protected $fillable = [
        'business_id',
        'supplier_id',
        'created_by',
        'approved_by',
        'purchase_date',
        'expected_date',
        'note',
        'status',
        'shipping_fee',
        'payment_method'
    ];

    protected $casts = [
        'purchase_date'  => 'date',
        'expected_date'  => 'date',
        'shipping_fee'   => 'float',
        'paid_amount'    => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function business()
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
