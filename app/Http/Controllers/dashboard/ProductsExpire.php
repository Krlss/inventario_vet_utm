<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\kardexes;

class ProductsExpire extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.products-expire.index');
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
