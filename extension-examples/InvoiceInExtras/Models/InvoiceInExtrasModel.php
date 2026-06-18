<?php

namespace Extensions\InvoiceInExtras\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceInExtrasModel extends Model
{
    protected $table = 'InvoiceInExtras';
    protected $fillable = [
        'note',
        'invoicein_id'
    ];
}