<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Lote;
use Carbon\Carbon;
use App\Models\kardexes;

class ProductsExpire extends Controller
{
    public function index(Request $request)
    {
        $lotes = Lote::all();
        $lotes = collect($lotes)->map(function ($lote) {
            $date = Carbon::parse($lote->expire);
            return  $date->year . ' ' . ucwords($date->monthName);
        });
        $dates = $lotes->unique();

        return view('dashboard.products-expire.index', compact('dates'));
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
