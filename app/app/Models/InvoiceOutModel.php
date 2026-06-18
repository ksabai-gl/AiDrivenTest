<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceOutModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice_outs';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'business_id',
        'document_no',
        'order_id',
        'subtotal',
        'tax',
        'discount',
        'total',
        'invoice_date',
        'due_date',
        'payment_status',
        'approved',
        'payment_method',
        'image',
        'amount_paid'
    ];

    /**
     * Cast fields
     */
    protected $casts = [
        'subtotal'     => 'decimal:2',
        'tax'          => 'decimal:2',
        'discount'     => 'decimal:2',
        'total'        => 'decimal:2',
        'amount_paid'  => 'decimal:2',
        'approved'     => 'boolean'
    ];

    /**
     * Relationships
     */

    /** Invoice belongs to a business */
    public function business(): BelongsTo
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }

    /** Invoice belongs to an order (optional) */
    public function order(): BelongsTo
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }
}
