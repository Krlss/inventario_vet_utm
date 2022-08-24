<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\kardexes;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // count of products table
        $products_count = Products::count();

        // count of kardexes table ingress today 
        $kardexes_ingress_today_count = kardexes::where('type', 'ingress')->whereDate('updated_at', date('Y-m-d'))->count();

        // count of kardexes table egress today
        $kardexes_egress_today_count = kardexes::where('type', 'egress')->whereDate('updated_at', date('Y-m-d'))->count();

        // sum of stock_diff ingress today
        $kardexes_ingress = kardexes::with('products')
            ->where('type', 'ingress')
            ->whereDate('updated_at', date('Y-m-d'))
            ->get();

        $sum_stock_diff_ingress = 0;
        foreach ($kardexes_ingress as $kardex_ingress) {
            foreach ($kardex_ingress->products as $product) {
                $sum_stock_diff_ingress += $product->pivot->stock_diff;
            }
        }

        // sum of stock_diff egress today
        $kardexes_egress = kardexes::with('products')
            ->where('type', 'egress')
            ->whereDate('updated_at', date('Y-m-d'))
            ->get();

        $sum_stock_diff_egress = 0;
        foreach ($kardexes_egress as $kardex_egress) {
            foreach ($kardex_egress->products as $product) {
                $sum_stock_diff_egress += $product->pivot->stock_diff;
            }
        }

        // count of kardexes table inngress in last 30 days
        $kardexes_ingress_last_30_days_count = kardexes::where('type', 'ingress')->whereDate('updated_at', '>=', date('Y-m-d', strtotime('-30 days')))->count();

        // count of kardexes table egress in last 30 days
        $kardexes_egress_last_30_days_count = kardexes::where('type', 'egress')->whereDate('updated_at', '>=', date('Y-m-d', strtotime('-30 days')))->count();

        return view('dashboard.index', compact('products_count', 'kardexes_ingress_today_count', 'kardexes_egress_today_count', 'kardexes_ingress_last_30_days_count', 'kardexes_egress_last_30_days_count', 'sum_stock_diff_ingress', 'sum_stock_diff_egress'));
    }
}
