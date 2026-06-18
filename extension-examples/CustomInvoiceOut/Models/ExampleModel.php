<?php

namespace Extensions\CustomInvoiceOut\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'CustomInvoiceOut';
    protected $fillable = [
        'note',
        'custom_invoice_out_id'
    ];
}