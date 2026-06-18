<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceInModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice_ins';

    protected $fillable = [
        'business_id',
        'document_no',
        'purchase_id',
        'approved_by',
        'subtotal',
        'tax',
        'discount',
        'total',
        'invoice_date',
        'due_date',
        'approved',
        'payment_status',
        'image',
        'amount_paid'
    ];

    protected $casts = [
        'subtotal' => 'float',
        'tax' => 'float',
        'discount' => 'float',
        'total' => 'float',
        'amount_paid' => 'float',
        'invoice_date' => 'date:Y-m-d',
        'due_date' => 'date:Y-m-d',
        'approved' => 'boolean'
    ];
    public function business()
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }
    public function purchase()
    {
        return $this->belongsTo(PurchaseModel::class, 'purchase_id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function getSubtotalFormattedAttribute()
    {
        return number_format($this->subtotal, 2);
    }
    public function getTotalFormattedAttribute()
    {
        return number_format($this->total, 2);
    }
}
