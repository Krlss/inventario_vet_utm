<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Types;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function index()
    {
        $products = Products::all();

        $types = Types::all();

        $categories = Categories::all();

        return view('dashboard.inventory.index', compact('products', 'types', 'categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
