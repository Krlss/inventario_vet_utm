@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/buttons.dataTables.min.css') }}">
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

        <div class="text-center">
            <span>{{__('History of expenses made and creation of new expenses of products and medical equipment')}}</span>
        </div>

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">

            <x-input-search element="search" placeholder="{{__('Search by reason')}}" label="{{__('Reason')}}" />

            <div class="flex xs:items-end items-start justify-between w-full xs:flex-row flex-col gap-2">
                <x-input-date label="Fecha" element="date" />
                @can('inventory.egress-products.create')
                <a href="{{ route('dashboard.products-egress.create') }}" class="bg-green-page text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium hover:no-underline">
                    {{__('New Expenses')}}
                </a>
                @endcan
            </div>


        </div>

        <x-flash-messages />
        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('N° Expenses')}}</th>
                    <th>{{__('Date/Time')}}</th>
                    <th>{{__('Reason')}}</th>
                    <th>{{__('N° Products')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection

@push('js')
@include('dashboard.products-egress.scripts')
@endpush