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

        $validatedData = $request->validate([
            'name' => ['required', 'unique:posts', 'max:255'],
            'amount' => ['required', 'numeric'],
            'cost' => ['required', 'numeric'],
            'unit' => ['required', 'numeric'],
            'stock_min' => ['required', 'numeric'],
            'categoria' => ['required'],
            'tipo' => ['required'],
        ]);
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
            return redirect()->route('dashboard.inventory.index')->with('success', 'Producto almacenado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.products.index')->with('error', 'Hubo un problema al almacenar el nuevo prodcuto');
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
