<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'stock',
        'stock_min',
        'expire',
        'amount',
        'id_unit'
    ];

    static $rules = [
        'name' => 'required|string|max:255',
        'cost' => 'required|numeric|min:0',
        'stock_min' => 'required|numeric|min:0',
        'amount' => 'required|numeric|min:0',
        'id_unit' => 'required|numeric',
    ];


    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'products_categories', 'products_id', 'categories_id')->withPivot('categories_id');
    }

    public function types()
    {
        return $this->belongsToMany(Types::class, 'products_types', 'products_id', 'types_id');
    }

    public function kardexes()
    {
        return $this->belongsToMany(Kardexes::class, 'products_kardexes')->withPivot('kardexes_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class);
    }
}
