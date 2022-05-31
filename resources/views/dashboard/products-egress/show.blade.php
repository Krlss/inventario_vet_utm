@extends('layouts.app')

@push('css_lib')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush

@section('content_header')
<div class="flex flex-col justify-between md:items-center items-start md:flex-row gap-2">
    <div class="flex flex-col">
        <div class="text-2xl font-extrabold">{{ __('Expense Visualization') }}</div>
        <span class="text-bold">{{__('Access a discharge order registered in the system')}}</span>
    </div>

    <div class="flex items-center justify-center gap-1">
        <a href="{{route('dashboard.products-egress.create')}}" class="bg-green-1000 py-2 px-4 hover:bg-green-900 rounded-md text-white font-medium hover:no-underline">
            {{__('New Expenses')}}
        </a>
        <a href="{{route('dashboard.products-egress.index')}}" class="bg-red-700 text-white py-2 px-4 hover:bg-red-800 rounded-md font-medium hover:no-underline">{{__('Back')}}</a>
    </div>
</div>
@endsection

@section('content')

<x-card-kardex id="{{$kardex->id}}" date="{{$kardex->created_at}}" detail="{{$kardex->detail}}" readonly={{true}} />

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('success') }}
</div>
@endif

<table id="table" class="table table-hover table-striped">
    <thead class="bg-black text-white">
        <tr>
            <th>{{__('Code')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Unit')}}</th>
            <th>{{__('Amount')}}</th>
            <th>- {{__('Stock')}}</th>
            <th>{{__('Stock')}}</th>
            <th>{{__('Type')}}</th>
            <th>{{__('Category')}}</th>
            <th>{{__('Expire')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kardex->products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->unit}}</td>
            <td>{{$product->amount}}</td>
            <td class="text-red-400">-{{$product->pivot->stock_diff}}</td>
            <td>{{$product->stock}}</td>

            <td>
                @forelse ($product->types as $type)
                <span class='badge badge-primary truncate max-w-100px text-left'>{{$type->name}}</span>
                @empty
                <span class="badge badge-pill badge-secondary">{{__('Undefined')}}</span>
                @endforelse
            </td>
            <td>
                @forelse ($product->categories as $category)
                <span class='badge badge-primary truncate max-w-100px text-left'>{{$category->name}}</span>
                @empty
                <span class="badge badge-pill badge-secondary">{{__('Undefined')}}</span>
                @endforelse
            </td>

            <td>{{$product->expire}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts_lib')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('json/table.json') }}"></script>
<script type="text/javascript">
    $('#table').DataTable({
        processing: true,
        responsive: true,
        autoWidth: false,
        language: len
    });
</script>
@endpush