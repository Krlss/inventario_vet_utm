@extends('layouts.app')

@section('content_header')
<div class="flex flex-col justify-between md:items-center items-start md:flex-row gap-2">
    <div class="flex flex-col">
        <div class="text-2xl font-extrabold">{{ __('Product revenue') }}</div>
        <span class="text-bold">{{__('Register an entry order for your products')}}</span>
    </div>
    <a href="{{route('dashboard.products-ingress.index')}}" class="bg-red-700 text-white py-2 px-4 hover:bg-red-800 rounded-md font-medium hover:no-underline">Regresar</a>
</div>
@endsection

@section('content')

<x-card-kardex id="{{$count+1}}" date="{{date('Y-m-d')}}" detail="" />

@endsection