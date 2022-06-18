<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\kardexes;

class ProductsMinStock extends Controller
{
    public function index(Request $request)
    {
        if ($request->search == "") {
            $data = Products::select('id', 'name', 'stock', 'stock_min', 'amount')->whereColumn('stock', '<=', 'stock_min')->get();
        } else {
            $data = Products::select('id', 'name', 'stock', 'stock_min', 'amount')->whereColumn('stock', '<=', 'stock_min')->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
            })->get();
        }
        return datatables()->of($data)->make();
    }

    public function create()
    {
        //

    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function LoadData()
    {
    }
}
