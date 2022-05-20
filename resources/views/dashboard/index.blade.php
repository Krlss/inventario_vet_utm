@extends('layouts.app')

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')
<div class="flex flex-col items-center">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 w-full">

        <div class="p-4 bg-gray-100 border border-gray-400 flex flex-col">
            <div class="text-2xl font-bold mb-4">{{ __('Modules') }}</div>
            <x-link-module name="{{__('Inventory')}}" desc="{{__('Manage products and equipment')}}" route="{{ route('dashboard.inventory.index') }}" />
            <x-link-module name="{{__('Reports')}}" desc="{{ __('Information for decision making')}}" route="#" />
        </div>

        <div class="bg-gray-100 border border-gray-400 p-4">
            <div class="text-2xl font-bold mb-4">{{__('metrics')}}</div>

            <div class="flex flex-wrap gap-2">
                <x-metric-home title="{{__('Total Products')}}" value="5453645" />
                <x-metric-home title="{{__('Recived Today')}}" value="200" />
                <x-metric-home title="{{__('Total Income')}}" value="45654" />
                <x-metric-home title="{{__('Total Egress')}}" value="321345" />
                <x-metric-home title="{{__('Total receipts generated')}}" value="45678974563" />
            </div> 

        </div>
    </div>
</div>
@endsection