<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\kardexes;
use Illuminate\Http\Request;

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
                ->where('type', 'income')
                ->get();
            return datatables()->of($data)->toJson();
        } else {
            $kardexes = [];
        }

        return view('dashboard.products-ingress.index', compact('kardexes'));
    }
}
