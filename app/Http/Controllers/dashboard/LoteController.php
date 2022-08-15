<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lote;
use App\Models\Products;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inventory.lotes.index')->only('index');
        $this->middleware('can:inventory.lotes.edit')->only('edit');
        $this->middleware('can:inventory.lotes.update')->only('update');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Lote::orderBy('created_at')->get();

            return datatables()->of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at->format('d-m-Y H:i:s');
                })
                ->addColumn('actions', function ($lote) {
                    return view('dashboard.lotes.partials.actions', compact('lote'));
                })
                ->make();
        }
        return view('dashboard.lotes.index');
    }

    public function edit(Lote $lote)
    {
        $products_id = Lote::where('lote', $lote->lote)->pluck('products_id', 'products_id');
        $products = Products::pluck('name', 'id');
        return view('dashboard.lotes.edit', compact('lote', 'products_id', 'products'));
    }

    public function update(Request $request, Lote $lote)
    {
        $request->validate([
            'lote' => 'required',
        ]);

        $loteCurrent = Lote::where('lote', $lote->lote)->get();

        if ($loteCurrent->count() > 0) {
            $loteCurrent->each(function ($lote) use ($request) {
                $lote->lote = $request->lote;
                $lote->save();
            });
        } else {
            $lote->lote = $request->lote;
            $lote->save();
        }

        $lote->update($request->all());
        return redirect()->route('dashboard.lotes.index')->with('success', 'Lote actualizado con éxito');
    }
}
