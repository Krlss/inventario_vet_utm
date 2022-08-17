<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\kardexes;
use App\Models\Products;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Report extends Controller
{

    public function index()
    {

        $metricas = [
            'Total item' => Products::count(),
            'Stock on Hand' => Products::sum('stock'),
            'Items Available for Sale' => Products::where('stock', '>', 0)->count(),
            'Items committed for Sales' => Products::where('stock', '>', 0)->where('stock', '<', 100)->count(),
            'Items Quantity In' => kardexes::where('type', 'ingress')->count(),
            'Items Quantity Out' => kardexes::where('type', 'egress')->count(),
        ];
        return view('dashboard.report.index', compact('metricas'));
    }

    /* cantidad de productos egresados por dia en un mes */
    public function egressByDayMes()
    {
        $date = Carbon::now();
        $date->subDays(30);
        $egress = kardexes::where('type', 'egress')->whereDate('created_at', '>=', date('Y-m-d', strtotime('-30 days')))->get();
        $egress_by_day = [];
        foreach ($egress as $item) {
            $date = date_create($item->created_at);
            $day = date_format($date, "d");
            $egress_by_day[$day] = $egress_by_day[$day] ?? 0;
            $egress_by_day[$day] += $item->products->count();
        }
        return response()->json($egress_by_day);
    }
    public function ingressByDayMes()
    {
        $date = Carbon::now();

        // last ingress in 30 days
        $date->subDays(30);
        $ingress = kardexes::where('type', 'ingress')->whereDate('created_at', '>=', date('Y-m-d', strtotime('-30 days')))->get();
        $ingress_by_day = [];
        foreach ($ingress as $item) {
            $date = date_create($item->created_at);
            $day = date_format($date, "d");
            $ingress_by_day[$day] = $ingress_by_day[$day] ?? 0;
            $ingress_by_day[$day] += $item->products->count();
        }
        return response()->json($ingress_by_day);
    }
}
