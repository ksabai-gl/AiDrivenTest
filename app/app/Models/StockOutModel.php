<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOutModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stock_outs';

    /**
     * Fields for mass assignment
     */
    protected $fillable = [
        'business_id',
        'invoice_out_id',
        'status',
        'approved_by'
    ];

    /**
     * Relationships
     */

    /** StockOut belongs to a business */
    public function business(): BelongsTo
    {
        return $this->belongsTo(BusinessModel::class, 'business_id');
    }

    /** StockOut belongs to an invoice_out */
    public function invoiceOut(): BelongsTo
    {
        return $this->belongsTo(InvoiceOutModel::class, 'invoice_out_id');
    }

    /**
     * Scope: filter by date range
     */
    public function scopeBetweenDates($query, string $start, string $end)
    {
        return $query->whereBetween('sold_at', [$start, $end]);
    }
}
