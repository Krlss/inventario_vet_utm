<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'products_categories')->withPivot('categories_id');
    }

    public function types()
    {
        return $this->belongsToMany(Types::class, 'products_types');
    }
}
