<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GePrice extends Model
{
    /**
     * We only use created_at, no updated_at
     */
    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'high',
        'low',
        'high_time',
        'low_time',
        'created_at',
    ];

    protected $casts = [
        'high_time' => 'datetime',
        'low_time'  => 'datetime',
        'created_at'=> 'datetime',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}