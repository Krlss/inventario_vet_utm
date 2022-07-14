<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\kardexes;


class ProductExpires extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Products::with('lotes')->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
            })->where('stock', '!=', 0)->get();


            return datatables()->of($data)->make();



            /*  $data = Products::join('lotes', 'products.id', '=', 'lotes.products_id')->select('products.id', 'products.name', 'products.stock', 'lotes.name', 'lotes.expire', 'products.amount')->where('products.stock', '!=', 0)->get(); */
        }/* else {
             $data = Products::select('id', 'name', 'stock', 'expire', 'amount')->where('stock', '!=', 0)->when($request->search, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
            })->get(); 

        }*/
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
