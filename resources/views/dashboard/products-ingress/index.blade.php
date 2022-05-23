@extends('layouts.app')

@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')

<div class="card">
    <div class="card-head">
        <ul class="flex md:flex-row flex-col border-b">
            <x-tabs routeTo='dashboard.inventory.index' routeCurrent='inventory*' title='Busqueda' />
            <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*' title='Ingreso Productos' />
            <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*' title='Egreso Productos' />
            <x-tabs routeTo='dashboard.products.index' routeCurrent='products*' title='Crear Producto' />
        </ul>
    </div>
    <div class="card-body pt-0 mt-0">

        <!-- <span class="font-extrabold">Busque los productos y equipamientos registrados en el sistema</span> -->
       
        
    </div>
</div>
@endsection

