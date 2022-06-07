<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Products::with('categories', 'types')
                ->when($request->category, function ($query) use ($request) {
                    $query->whereRelation('categories', 'categories.id', '=', $request->category);
                })
                ->when($request->type, function ($query) use ($request) {
                    $query->orWhereRelation('types', 'types.id', '=', $request->type);
                })
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
                })
                ->get();
            return datatables()->of($data)
                ->editColumn('expire', function (Products $product) {
                    $date = date_create($product->expire);
                    return date_format($date, "d/m/Y");
                })->make();
        } else {
            $products = [];

            $types = Types::orderBy('name', 'asc')->get();

            $categories = Categories::orderBy('name', 'asc')->get();
        }

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
