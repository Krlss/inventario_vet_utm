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
    public function index()
    {
    }

    public function create()
    {
        $types = Types::all();

        $categories = Categories::all();

        $units = Unit::all();

        $product = null;

        return view('dashboard.products.create', compact('types', 'categories', 'units', 'product'));
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
