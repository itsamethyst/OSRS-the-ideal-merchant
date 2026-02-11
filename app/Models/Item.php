<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'osrs_id',
        'value',
        'highalch',
        'lowalch',
        'limit',
        'members',
        'examine',
        'icon',
    ];

    public function prices()
    {
        return $this->hasMany(GePrice::class);
    }

    public function latestPrice()
    {
        return $this->hasOne(GePrice::class)->latestOfMany('created_at');
    }

    public function metric()
    {
        return $this->hasOne(ItemMetric::class);
    }

    
}