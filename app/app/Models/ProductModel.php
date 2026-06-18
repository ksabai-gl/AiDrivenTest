<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'business_id',
        'category_id',
        'sku',
        'name',
        'unit',
        'description',
        'image',
        'created_by'
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryProductModel::class, 'category_id');
    }
    public function business(): BelongsTo
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttributeModel::class, 'product_id');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }

    public function scopeSku($query, string $sku)
    {
        return $query->where('sku', $sku);
    }
}
