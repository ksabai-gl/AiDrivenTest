<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceListModel extends Model
{
    use SoftDeletes;
    protected $table = 'price_list';

    protected $fillable = [
        'customer_group_id',
        'product_id',
        'price',
    ];

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroupModel::class, 'customer_group_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
