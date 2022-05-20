@extends('layouts.app')

@section('content')

<div class="pt-4">
    <ul class="flex md:flex-row flex-col border-b">
        <x-tabs routeTo='dashboard.inventory.index' routeCurrent='inventory*' title='Busqueda' />
        <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*' title='Ingreso Productos' />
        <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*' title='Egreso Productos' />
        <x-tabs routeTo='dashboard.products.index' routeCurrent='products*' title='Crear Producto' />
    </ul>
    <div class="card-body">
        Busque los productos y equipamientos registrados en el sistema

    </div>
</div>

@endsection