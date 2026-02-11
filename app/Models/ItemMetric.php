<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemMetric extends Model
{
    /**
     * Only updated_at is used
     */
    const CREATED_AT = null;

    protected $fillable = [
        'item_id',
        'margin',
        'margin_pct',
        'roi',
        'updated_at',
    ];

    protected $casts = [
        'margin_pct' => 'decimal:2',
        'roi'        => 'decimal:2',
        'updated_at' => 'datetime',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}