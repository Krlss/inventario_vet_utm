<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    public function categorys()
    {
        return $this->hasMany(Categories::class);
    }

    public function types()
    {
        return $this->belongsToMany(Types::class, 'products_types');
    }
}
