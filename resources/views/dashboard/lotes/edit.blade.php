@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush

@section('content_header')
<div class="flex flex-col justify-between md:items-center items-start md:flex-row gap-2">
    <div class="flex flex-col">
        <div class="text-2xl font-extrabold">{{ __('Editing a lote') }}</div>
    </div>

    <div>
        <button form="form-lote" class="bg-green-page text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium" type="submit">{{__('Save')}}</button>

        <a href="{{route('dashboard.lotes.index')}}">
            <button class="bg-red-700 py-2 px-4 hover:bg-red-800 rounded-md text-white font-medium">
                {{__('Back')}}
            </button>
        </a>

    </div>


</div>
@endsection

@section('content')

{!! Form::model($lote, ['route' => ['dashboard.lotes.update', $lote], 'autocomplete' => 'off', 'method' => 'put', 'id' => 'form-lote', 'class' => 'md:mb-0 mb-10']) !!}
<x-flash-messages />
<div class="card">

    <div class="flex flex-col gap-2 p-4">
        <div>
            <label for="lote">{{ __('Lote') }}*</label>
            {!! Form::text('lote', $lote->lote ?? null, ['class' => 'form-control','placeholder' => __('Lote'), 'required' => true]) !!}
            @error('lote')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="products_id">{{ __('Products') }}</label>
            {!! Form::select('products_id[]', $products, $products_id, ['class' => 'select2 form-control','multiple' => true, 'id' => 'products_id']) !!}
        </div>

    </div>
</div>
{!! Form::close() !!}
@endsection


@push('js')

<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    $('#products_id').select2({
        width: '100%',
        placeholder: 'Selecciona los productos',
        allowClear: true,
    });
</script>
@endpush