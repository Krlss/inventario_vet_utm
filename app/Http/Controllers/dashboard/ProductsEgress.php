<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\kardexes;
use App\Models\Products;
use App\Http\Requests\KardexesEgressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsEgress extends Controller
{
    function index(Request $request)
    {

        if ($request->ajax()) {
            $data = kardexes::with('products')
                ->when($request->search, function ($query) use ($request) {
                    $query->where('detail', 'LIKE', '%' .  ucwords(strtolower($request->search)) . '%');
                })
                ->when($request->date, function ($query) use ($request) {
                    $query->orWhere('created_at', $request->date);
                })
                ->where('type', 'egress')
                ->get();
            return datatables()->of($data)
                ->editColumn('created_at', function ($kardexes) {
                    $date = date_create($kardexes->created_at);
                    return date_format($date, "d/m/Y H:i:s");
                })
                ->addColumn('link', function ($kardexes) {
                    return '<a class="text-black" href="' . route('dashboard.products-egress.show', $kardexes) . '"><svg width="20px" height="20px" viewBox="0 0 20 20"><path fill="currentColor" d="M7.75 17.5a.75.75 0 0 1 0-1.5H14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H7.75a.75.75 0 0 1 0-1.5H14A3.5 3.5 0 0 1 17.5 6v8a3.5 3.5 0 0 1-3.5 3.5H7.75ZM7.741 6.199a.75.75 0 0 1 1.06.042l3 3.25a.75.75 0 0 1 0 1.018l-3 3.25A.75.75 0 1 1 7.7 12.74l1.838-1.991H1.75a.75.75 0 0 1 0-1.5h7.787l-1.838-1.99a.75.75 0 0 1 .042-1.06Z"/></svg></a>';
                })->rawColumns(['link'])
                ->make(true);
        } else {
            $kardexes = [];
        }

        return view('dashboard.products-egress.index', compact('kardexes'));
    }

    function show($id)
    {
        $kardex = kardexes::with('products')->find($id);
        return view('dashboard.products-egress.show', compact('kardex'));
    }

    function create()
    {
        $last_id = kardexes::orderBy('id', 'desc')->first();
        $count = $last_id ? $last_id->id + 1 : 1;

        return view('dashboard.products-egress.create', compact('count'));
    }

    function store(KardexesEgressRequest $request)
    {
        try {

            DB::beginTransaction();

            $kardex = kardexes::create([
                'created_at' => $request->created_at,
                'detail' => $request->detail,
                'type' => 'egress',
            ]);

            foreach ($request->products as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $product = Products::find($product_id);


                if ($product->amount > 0) {
                    $product->stock -= $quantity * $product->amount;
                } else {
                    $product->stock -= $quantity;
                }

                if ($product->stock < 0) {
                    $product->stock = 0;
                }

                $product->save();
                $kardex->products()->attach($product_id, ['quantity' => $quantity]);
            }

            DB::commit();

            return redirect()->route('dashboard.products-egress.show', $kardex)->with('success', __('The discharge of products has been registered'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-egress.create')->with('error', __('It has not been possible to register the discharge of products'));
        }
    }
}
