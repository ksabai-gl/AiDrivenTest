<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseItemModel extends Model
{
    use HasFactory;

    protected $table = 'purchase_items';

    protected $fillable = [
        'purchase_id',
        'discount',
        'tax',
        'product_link',
        'buy_quantity',
        'gift_quantity',
        'compensation_quantity',
        'conversion_quantity',
        'unit_cost',
        'product_id'
    ];

    protected $casts = [
        'discount' => 'float',
        'tax' => 'float',
        'buy_quantity' => 'float',
        'gift_quantity' => 'float',
        'compensation_quantity' => 'float',
        'conversion_quantity' => 'float',
        'unit_cost' => 'integer',
        'deleted_at' => 'datetime',
    ];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(PurchaseModel::class, 'purchase_id');
    }
    public function products(): HasOne {
        return $this->hasOne(ProductModel::class,'purchase_item_id');
    }
}
