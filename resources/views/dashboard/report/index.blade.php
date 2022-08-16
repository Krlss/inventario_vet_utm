@extends('layouts.app')

@section('content_header')
    <div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
    <h3 class="text-lg text-gray-700 uppercase font-bold">Cuadro de Mando</h3>
@endsection


@section('content')
    <div class="container bg-slate-50">
        <div class="grid grid-rows-2 gap-4">
            <div class="flex flex-row flex-grow flex-wrap gap-4">

                @foreach ($metricas as $key => $value)
                    <x-card-report :title=$key :value=$value />
                @endforeach
            </div>
            <div class="">
                <canvas id="grafico"></canvas>
            </div>
        </div>
    </div>
@endsection
