<?php

namespace Extensions\StockOutExtras\Models;

use Illuminate\Database\Eloquent\Model;

class StockinExtrasModel extends Model
{
    protected $table = 'StockOutExtras';
    protected $fillable = [
        'note',
        'stockout_id'
    ];
}