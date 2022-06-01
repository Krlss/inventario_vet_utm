<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Types;
use RealRashid\SweetAlert\Facades\Alert;



class ProductsNew extends Controller
{
    public function index()
    {

        $types = Types::all();

        $categories = Categories::all();

        return view('dashboard.products.index', compact('types', 'categories'));
    }

    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        try {
            $product_save = new Products();
            $product_save->name = $request->input("name");
            $product_save->amount = $request->input("amount");
            $product_save->cost = $request->input("cost");
            $product_save->unit = $request->input("unit");
            $product_save->stock = 0;
            $product_save->stock_min = $request->input("stock_min");
            $product_save->save();
            $product_save->categories()->attach($request->input("categoria"));
            $product_save->types()->attach($request->input("tipo"));
            Alert::success('Producto nuevo', 'Has ingresado un nuevo producto');
            return redirect('/inventory');
        } catch (\Throwable $th) {
            Alert::error('Producto nuevo', 'Ha ocurrido un error al ingresar el producto');
            return redirect('/products');
        }
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
