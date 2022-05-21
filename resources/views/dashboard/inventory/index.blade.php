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

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">

            <x-input-search element="search" placeholder="{{__('Search to product name')}}" label="{{__('Product name')}}" />

            <div class="flex md:flex-row flex-col gap-2">
                <x-select-search :array="$types" label="{{__('Type')}}" optionDefault="{{__('All')}}" element="type" />
                <x-select-search :array="$categories" label="{{__('Category')}}" optionDefault="{{__('All')}}" element="category" />
            </div>

        </div>

        <table id="table" class="table table-striped table-bordered table-hover rounded-lg">
            <thead class="bg-black text-white">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>amount</th>
                    <th>cost</th>
                    <th>stock</th>
                    <th>stock min</th>
                    <th>expire</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{!! $product->id !!}</td>
                    <td>{!! $product->name !!}</td>
                    <td>{!! $product->amount !!}</td>
                    <td>{!! $product->cost !!}</td>
                    <td>{!! $product->stock !!}</td>
                    <td>{!! $product->stock_min !!}</td>
                    <td>{!! $product->expire !!}</td>
                    <td>{!! $product->created_at !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts_lib')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('json/table.json') }}"></script>
<script type="text/javascript">
    $('#table').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1,
        }],
        lengthChange: false,
        processing: true,
        searching: false,
        responsive: true,
        autoWidth: false,
        "language": len,
        "ajax": {
            "url": "{{route('dashboard.inventory.index')}}",
        }
    });
</script>
@endpush