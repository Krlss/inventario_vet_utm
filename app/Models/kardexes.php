<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardexes extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'detail',
        'type'
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_kardexes')->withPivot('quantity', 'stock_diff', 'stock_current');
    }
}
