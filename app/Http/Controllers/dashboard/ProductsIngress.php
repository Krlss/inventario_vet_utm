<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\KardexesIngressRequest;
use App\Models\kardexes;
use App\Models\Products;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsIngress extends Controller
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
                ->where('type', 'ingress')
                ->get();
            return datatables()->of($data)
                ->editColumn('created_at', function ($kardexes) {
                    $date = date_create($kardexes->created_at);
                    return date_format($date, "d/m/Y H:i:s");
                })
                ->addColumn('actions', function (kardexes $kardex) {
                    return view('dashboard.products-ingress.partials.actions', compact('kardex'));
                })
                ->make(true);
        } else {
            $kardexes = [];
        }

        return view('dashboard.products-ingress.index', compact('kardexes'));
    }

    function show($id)
    {
        $kardex = kardexes::with('products')->find($id);
        return view('dashboard.products-ingress.show', compact('kardex'));
    }

    function create()
    {
        $last_id = kardexes::orderBy('id', 'desc')->first();
        $count = $last_id ? $last_id->id + 1 : 1;
        $kardex = null;

        return view('dashboard.products-ingress.create', compact('count', 'kardex'));
    }

    function store(KardexesIngressRequest $request)
    {
        try {

            DB::beginTransaction();

            $kardex = kardexes::create([
                'created_at' => Carbon::now(),
                'detail' => $request->detail,
                'type' => 'ingress',
            ]);

            foreach ($request->products as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $_lote = $product['lote'];
                $expire = $product['expire'];
                $product = Products::find($product_id);
                $stock_diff = 0;


                $lote_existe = Lote::where('lote', $_lote)->where('products_id', intval($product_id))->first();


                if (!$lote_existe && $_lote) {
                    $lote = Lote::create([
                        'products_id' => $product_id,
                        'lote' => $_lote,
                        'expire' =>  date('Y/m/d h:i:s', strtotime($expire)),

                    ]);
                    $lote->save();
                }

                if ($product->amount > 0) {
                    $stock_diff = $quantity * $product->amount;
                    $stock_current = $product->stock + $stock_diff;
                    $product->stock += $stock_diff;
                } else {
                    $stock_diff = $quantity;
                    $stock_current = $product->stock + $stock_diff;
                    $product->stock += $quantity;
                }
                $product->save();
                $kardex->products()->attach($product_id, ['quantity' => $quantity, 'stock_diff' => $stock_diff, 'stock_current' => $stock_current]);
            }

            DB::commit();

            return redirect()->route('dashboard.products-ingress.show', $kardex)->with('success', __('The entry of products has been registered'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-ingress.create')->with('error', __('Unable to register product entry'))->withInput();
        }
    }

    public function edit($id)
    {
        $kardex = kardexes::find($id);
        $count = $kardex->id;

        $products = [];

        foreach ($kardex->products as $product) {
            $lote = Lote::where('products_id', $product->id)->select('lote', 'expire')->first();
            $products[] = [
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'lote' => $lote->lote,
                'expire' => date('Y-m-d', strtotime($lote->expire)),
                'lotes' => []
            ];
        }

        return view('dashboard.products-ingress.edit', compact('kardex', 'count', 'products'));
    }

    public function update(KardexesIngressRequest $request, Products $product)
    {
        try {

            DB::beginTransaction();

            $kardex = kardexes::find($request->id);
            $kardex->detail = $request->detail;
            $kardex->save();

            $kardex->products()->detach();

            foreach ($request->products as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $_lote = $product['lote'];
                $expire = $product['expire'];
                $product = Products::find($product_id);
                $stock_diff = 0;

                $lote_existe = Lote::where('lote', $_lote)->where('products_id', intval($product_id))->first();

                if (!$lote_existe && $_lote) {
                    $lote = Lote::create([
                        'products_id' => $product_id,
                        'lote' => $_lote,
                        'expire' =>  date('Y/m/d h:i:s', strtotime($expire)),

                    ]);
                    $lote->save();
                }

                if ($product->amount > 0) {
                    $stock_diff = $quantity * $product->amount;
                    $stock_current = $product->stock + $stock_diff;
                    $product->stock += $stock_diff;
                } else {
                    $stock_diff = $quantity;
                    $stock_current = $product->stock + $stock_diff;
                    $product->stock += $quantity;
                }
                $product->save();
                $kardex->products()->attach($product_id, ['quantity' => $quantity, 'stock_diff' => $stock_diff, 'stock_current' => $stock_current]);
            }

            DB::commit();

            return redirect()->route('dashboard.products-ingress.show', $kardex)->with('success', __('The entry of products has been registered'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-ingress.edit', $product)->with('error', __('Unable to register product entry'))->withInput();
        }
    }

    public function destroy($id)
    {
        $kardex = kardexes::find($id);
        $kardex->delete();
        return redirect()->route('dashboard.products-ingress.index')->with('success', __('The entry of products has been deleted'));
    }
}
