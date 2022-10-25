<?php

namespace App\Http\Controllers\dashboard;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewProduct;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Types;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



class ProductsNew extends Controller
{

    public function __construct()
    {
        $this->middleware('can:inventory.products.index')->only('index');
        $this->middleware('can:inventory.products.show')->only('show');
        $this->middleware('can:inventory.products.create')->only('store');
        $this->middleware('can:inventory.products.edit')->only('edit');
        $this->middleware('can:inventory.products.edit')->only('update');
        $this->middleware('can:inventory.products.destroy')->only('destroy');
    }

    public function index()
    {
    }

    public function create()
    {
        $types = Types::pluck('name', 'id');

        $categories = Categories::pluck('name', 'id');

        $units = Unit::pluck('name', 'id');

        $product = null;

        $typesSelected = null;

        $categoriesSelected = null;

        return view('dashboard.products.create', compact('types', 'categories', 'units', 'product', 'typesSelected', 'categoriesSelected'));
    }

    public function store(CreateNewProduct $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['stock'] = 0;
            $product = Products::create($input);

            if ($request->has('id_type')) {
                $product->types()->sync($request->id_type);
            }

            if ($request->has('id_category')) {
                $product->categories()->sync($request->id_category);
            }

            DB::commit();

            return redirect()->route('dashboard.inventory.index')->with('success', __('Product created successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in create a new product') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Products $product)
    {
        $types = Types::pluck('name', 'id');

        $categories = Categories::pluck('name', 'id');

        $units = Unit::pluck('name', 'id');

        $typesSelected = $product->types->pluck('id')->toArray();
        $categoriesSelected = $product->categories->pluck('id')->toArray();

        return view('dashboard.products.edit', compact('product', 'types', 'categories', 'units', 'typesSelected', 'categoriesSelected'));
    }

    public function update(CreateNewProduct $request, Products $product)
    {

        $input = $request->all();
        try {
            DB::beginTransaction();

            $product->update($input);

            $product->types()->sync($request->id_type);
            $product->categories()->sync($request->id_category);

            DB::commit();
            return redirect()->route('dashboard.inventory.index')->with('success', __('Product updated successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error updating product') . ' ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $specie = Products::find($id);
            $specie->delete();

            DB::commit();
            return redirect()->route('dashboard.inventory.index')->with('success', __('Product deleted successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Error in delete product') . ' ' . $e->getMessage());
        }
    }

    public function LoadData()
    {
    }
}
