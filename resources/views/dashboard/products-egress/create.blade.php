@extends('layouts.app')

@section('content_header')
<div class="flex flex-col justify-between md:items-center items-start md:flex-row gap-2">
    <div class="flex flex-col">
        <div class="text-2xl font-extrabold">{{ __('Output of products') }}</div>
        <span class="text-bold">{{__('Register a release order for your products')}}</span>
    </div>

    <div>
        <button form="form-kardex" class="bg-green-1000 text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium" type="submit">{{__('Save')}}</button>

        <a href="{{route('dashboard.products-egress.index')}}">
            <button class="bg-red-700 py-2 px-4 hover:bg-red-800 rounded-md text-white font-medium">
                {{__('Back')}}
            </button>
        </a>

    </div>


</div>
@endsection

@section('content')


<form id="form-kardex" class="md:mb-0 mb-10" action="{{ route('dashboard.products-egress.store') }}" method="POST">

    <x-flash-messages />

    @csrf
    <x-card-kardex id="{{$count}}" date="{{ old('created_at') ?? date('Y-m-d') }}" detail="{{ old('detail') ?? '' }}" readonly={{false}} />

    @livewire('products-kardexes', ['products' =>  old('products') ? old('products') : [], 'type' => 'egress', 'expire'=> false])

</form>

@endsection