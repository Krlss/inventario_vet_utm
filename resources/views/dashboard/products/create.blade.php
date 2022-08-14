@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">

@endpush

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')
<div class="card">
    @canany(['inventory.products.index', 'inventory.ingress-products.index', 'inventory.egress-products.index', 'inventory.products.create'])
    <div class="card-head">
        <ul class="flex md:flex-row flex-col border-b">
            @can('inventory.products.index')
            <x-tabs routeTo='dashboard.inventory.index' routeCurrent='inventory*' title='Busqueda' />
            @endcan
            @can('inventory.ingress-products.index')
            <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*' title='Ingreso Productos' />
            @endcan
            @can('inventory.egress-products.index')
            <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*' title='Egreso Productos' />
            @endcan
            @can('inventory.products.create')
            <x-tabs routeTo='dashboard.products.create' routeCurrent='products/*' title='Crear Producto' />
            @endcan
        </ul>
    </div>
    @endcanany
    <div class="card-body pt-0 mt-0">

        <x-flash-messages />

        <div class="flex md:flex-row flex-col gap-4 justify-between">
            <div class="leading-none">
                <h4 class="font-bold leading-none">Creación de un nuevo producto</h4>
                <span class="font-medium">Cree nuevos productos o equipamiento medico</span>
            </div>
            <div class="flex items-center md:justify-center justify-start gap-2">
                <button form="create_product" type="submit" class="bg-green-page hover:bg-green-900 px-3 py-1 rounded text-white shadow-sm">Guardar</button>
                <button type="button" class="bg-red-700 hover:bg-red-800 px-3 py-1 rounded text-white shadow-sm clear">Cancelar</button>
            </div>
        </div>

        <form id="create_product" method="POST" action="{{route('dashboard.products.store')}}" autocomplete="off" class="mt-4">
            @csrf
            @include('dashboard.products.fields')
        </form>

        @include('dashboard.types.modal')
        @include('dashboard.categories.modal')
        @include('dashboard.units.modal')


    </div>
</div>
@endsection