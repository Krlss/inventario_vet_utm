<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\DataTables;

use function PHPSTORM_META\map;

class InventoryController extends Controller
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

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Products::with('categories', 'types', 'unit')
                ->when($request->category, function ($query) use ($request) {
                    $query->whereRelation('categories', 'categories.id', '=', $request->category);
                })
                ->when($request->type, function ($query) use ($request) {
                    $query->orWhereRelation('types', 'types.id', '=', $request->type);
                })
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
                })->get();
            return datatables()->of($data)
                ->addColumn('actions', function (Products $product) {
                    return view('dashboard.inventory.partials.actions', compact('product'));
                })->make(true);
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

    public function edit()
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    }

    public function LoadData()
    {
    }
}
