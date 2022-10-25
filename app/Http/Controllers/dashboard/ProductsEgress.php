<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\kardexes;
use App\Models\Products;
use App\Models\Lote;
use App\Http\Requests\KardexesEgressRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotifyMinStock;

class ProductsEgress extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inventory.egress-products.index')->only('index');
        $this->middleware('can:inventory.egress-products.show')->only('show');
        $this->middleware('can:inventory.egress-products.create')->only('store');
        $this->middleware('can:inventory.egress-products.edit')->only('edit');
        $this->middleware('can:inventory.egress-products.update')->only('update');
        $this->middleware('can:inventory.egress-products.destroy')->only('destroy');
    }


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
                ->addColumn('actions', function (kardexes $kardex) {
                    return view('dashboard.products-egress.partials.actions', compact('kardex'));
                })
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
                'created_at' => Carbon::now(),
                'detail' => $request->detail,
                'type' => 'egress',
            ]);

            $productsStockMin = [];

            foreach ($request->products as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $id_lote = $product['lote'];
                $product = Products::find($product_id);
                $stock_diff = 0;

                if ($product->amount > 0) {
                    $stock_diff = $quantity * $product->amount;
                    $product->stock -= $stock_diff;
                } else {
                    $stock_diff = $quantity;
                    $product->stock -= $quantity;
                }
                $stock_current = $product->stock - $stock_diff;

                if ($product->stock < 0) {
                    $product->stock = 0;
                    $lote = Lote::where('lote', $id_lote)
                        ->where('products_id', $product_id)
                        ->first();
                    if ($lote) {
                        $lote->delete();
                    }
                }

                if ($product->stock < $product->stock_min) {
                    $productsStockMin[] = $product;
                }

                $product->save();
                $kardex->products()->attach($product_id, ['quantity' => $quantity, 'stock_diff' => $stock_diff, 'stock_current' => $stock_current <= 0 ? 0 : $stock_current]);
            }

            if (count($productsStockMin) > 0) {
                $users = User::with(['roles' => function ($query) {
                    $query->where('name', 'Administrador');
                }])->pluck('email')->toArray();
                Mail::to($users)->send(new SendNotifyMinStock($productsStockMin));
            }

            DB::commit();

            return redirect()->route('dashboard.products-egress.show', $kardex)->with('success', __('The discharge of products has been registered'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-egress.create')->with('error', __('It has not been possible to register the discharge of products'));
        }
    }

    public function edit($id)
    {
        $kardex = kardexes::with('products')->where('id', $id)->first();
        $count = $kardex->id;

        $products = [];
        $lotes = Lote::select('id', 'lote', 'expire', 'products_id')->get();

        foreach ($kardex->products as $product) {
            $lote = $lotes->where('products_id', $product->id)->first();
            $lotes_ = $lotes->where('products_id', $product->id)->pluck('id', 'lote');
            $products[] = [
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'lote' => $lote->lote ?? '',
                'expire' =>  date('Y-m-d', strtotime($lote->expire ?? '')),
                'lotes' => $lotes_
            ];
        }
        return view('dashboard.products-egress.edit', compact('kardex', 'count', 'products'));
    }

    public function update(KardexesEgressRequest $request, Products $product)
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
                    $product->stock -= $stock_diff;
                } else {
                    $stock_diff = $quantity;
                    $product->stock -= $quantity;
                }
                $stock_current = $product->stock - $stock_diff;

                if ($product->stock < 0) {
                    $product->stock = 0;
                    if ($lote_existe) {
                        $lote_existe->delete();
                    }
                }

                $product->save();
                $kardex->products()->attach($product_id, ['quantity' => $quantity, 'stock_diff' => $stock_diff, 'stock_current' => $stock_current]);
            }

            DB::commit();

            return redirect()->route('dashboard.products-egress.show', $kardex)->with('success', __('The entry of products has been updated'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-egress.edit', $product)->with('error', __('Unable to update product entry'))->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $kardex = kardexes::find($id);
            $kardex->delete();
            return redirect()->route('dashboard.products-egress.index')->with('success', __('The entry of products has been deleted'));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.products-egress.index')->with('error', __('Unable to delete product entry'));
        }
    }
}
