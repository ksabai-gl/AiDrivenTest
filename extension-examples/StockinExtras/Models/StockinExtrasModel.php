<?php

namespace Extensions\StockinExtras\Models;

use Illuminate\Database\Eloquent\Model;

class StockinExtrasModel extends Model
{
    protected $table = 'StockinExtras';
    protected $fillable = [
        'note',
        'stockin_id'
    ];
}