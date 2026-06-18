<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockInModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stock_ins';

    protected $fillable = [
        'business_id',
        'invoice_in_id',
        'approved_by',
        'import_date',
        'status'
    ];
    protected $casts = [];
    public function business(): BelongsTo
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(InvoiceInModel::class, 'invoice_in_id');
    }
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
