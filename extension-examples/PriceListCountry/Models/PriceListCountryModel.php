<?php

namespace Extensions\PriceListCountry\Models;

use Illuminate\Database\Eloquent\Model;

class PriceListCountryModel extends Model
{
    protected $table = 'PriceListCountry';
    protected $fillable = ['price_list_id','country'];
}