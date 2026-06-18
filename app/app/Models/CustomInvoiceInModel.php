<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomInvoiceInModel extends Model
{
    //
    use SoftDeletes;
    protected $table = 'custom_invoice_ins';

    protected $fillable = [
        'created_by',
        'business_id',
        'description',
        'amount',
        'invoice_date',
        'approved',
        'payment_status',
        'document_no',
        'supplier_id'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'amount' => 'decimal:2',
        'invoice_date' => 'date:Y-m-d',
    ];
}
