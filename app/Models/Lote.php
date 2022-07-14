<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expire',
        'products_id',
    ];

    static $rules = [
        'name' => 'required|string|max:255',
        'expire' => 'required|date',
        'products_id' => 'required|numeric',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }
}
