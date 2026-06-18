<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomInvoiceOutModel extends Model
{
    use SoftDeletes;
    protected $table = 'custom_invoice_outs';

    protected $fillable = [
        'created_by',
        'business_id',
        'description',
        'amount',
        'invoice_date',
        'approved',
        'payment_status',
        'document_no',
        'customer_id'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'amount' => 'decimal:2',
        'invoice_date' => 'date:Y-m-d',
    ];
}
