<?php

namespace Extensions\CustomInvoiceIn\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'CustomInvoiceInExtra';
    protected $fillable = [
        'note',
        'custom_invoice_in_id'
    ];
}