@extends('layouts.app')

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')
<div class="flex flex-col items-center">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 w-full">

        @canany(['inventory.products.index', 'inventory.reports'])
        <div class="p-4 bg-gray-100 border border-gray-400">
            <div class="text-2xl font-bold mb-4">{{ __('Modules') }}</div>
            <div class="flex flex-col gap-2">
                @can('inventory.products.index')
                <x-link-module name="{{__('Inventory')}}" desc="{{__('Manage products and equipment')}}" route="{{ route('dashboard.inventory.index') }}" />
                <x-link-module name="{{__('Reports')}}" desc="{{ __('Information for decision making')}}" route="#" />
            </div>
        </div>
        @endcanany

        @canany(['inventory.products.index', 'inventory.ingress-productos.index', 'inventory.egress-productos.index'])
        <div class="bg-gray-100 border border-gray-400 p-4">
            <div class="text-2xl font-bold mb-4">{{__('metrics')}}</div>

            <div class="flex flex-col gap-2">
                @can('inventory.products.index')
                <x-metric-home title="{{__('Total Products')}}" value="{{$products_count}}" url="{{ route('dashboard.inventory.index') }}" />
                @endcan
                @can('inventory.ingress-products.index')
                <x-metric-home title="{{__('Total de productos ingresados hoy día')}}" value="{{$sum_stock_diff_ingress}}" url="{{ route('dashboard.products-ingress.index') }}" />
                @endcan
                @can('inventory.egress-products.index')
                <x-metric-home title="{{__('Total de productos egresados hoy día')}}" value="{{$sum_stock_diff_egress}}" url="{{ route('dashboard.products-egress.index') }}" />
                @endcan
                @can('inventory.ingress-products.index')
                <x-metric-home title="{{__('Cantidad de ingresos hoy día')}}" value="{{$kardexes_ingress_today_count}}" url="{{ route('dashboard.products-ingress.index') }}" />
                @endcan
                @can('inventory.egress-products.index')
                <x-metric-home title="{{__('Cantidad de egresos hoy día')}}" value="{{$kardexes_egress_today_count}}" url="{{ route('dashboard.products-egress.index') }}" />
                @endcan
                @can('inventory.ingress-products.index')
                <x-metric-home title="{{__('Cantidad de ingresos en los últimos 30 días')}}" value="{{$kardexes_ingress_last_30_days_count}}" url="{{ route('dashboard.products-ingress.index') }}" />
                @endcan
                @can('inventory.egress-products.index')
                <x-metric-home title="{{__('Cantidad de egresos en los últimos 30 días')}}" value="{{$kardexes_egress_last_30_days_count}}" url="{{ route('dashboard.products-egress.index') }}" />
                @endcan
            </div>
        </div>
        @endcanany
    </div>
</div>
@endsection