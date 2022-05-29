<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardexes extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->belongsToMany(Products::class, 'products_kardexes');
    }
}