<?php

namespace Extensions\InvoiceOutExtras\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $table = 'InvoiceOutExtras';
    protected $fillable = [
        'note',
        'invoiceout_id'
    ];
}