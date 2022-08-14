<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\kardexes;
use App\Models\Lote;

class ProductExpires extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Lote::with(['product' => function ($query) {
                $query->where('stock', '!=', 0);
            }])->when($request->year, function ($query) use ($request) {
                $query->whereYear('expire', strtolower($request->year));
            })->when($request->month, function ($query) use ($request) {
                $query->whereMonth('expire', strtolower($request->month));
            })->get();


            return datatables()->of($data)
                ->addColumn('name', function ($data) {
                    return $data->product->name ?? '';
                })->addColumn('stock', function ($data) {
                    return $data->product->stock ?? '';
                })->addColumn('amount', function ($data) {
                    return $data->product->amount ?? '';
                })->make();
        }
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
