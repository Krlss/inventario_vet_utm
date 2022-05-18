@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center">
    <div class="md:text-6xl text-xl font-bold text-center">
        {{ __('Title Home') }}
    </div>
    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 mt-5 w-full">
        <div class="bg-gray-100 border border-gray-400 p-5">
            <div class="text-2xl font-bold">{{ __('Modules') }}</div>
            <div class="space-y-4 mt-4 px-5">
                <button class="w-full h-40 bg-green-1000 rounded-xl hover:bg-green-900 flex flex-col items-center justify-center relative">
                    <span class="md:text-5xl sm:text-4xl lg:text-7xl text-xl font-bold text-white mb-5"> {{__('Inventory')}}</span>
                    <span class="absolute bottom-4 right-5 text-white font-medium flex md:text-base text-sm items-center justify-center text-right">
                        {{__('Manage products and equipment')}}
                        <x-icon class="ml-2" icon="arrow-right-sidebar" width=15 height=15 viewBox="1024 1024" strokeWidth=0 fill="white" />
                    </span>
                </button>
                <button class="w-full h-40 bg-green-1000 rounded-xl hover:bg-green-900 flex flex-col items-center justify-center relative">
                    <span class="md:text-5xl sm:text-4xl lg:text-7xl text-xl font-bold text-white mb-5">{{__('Reports')}}</span>
                    <span class="absolute bottom-4 right-5 text-white font-medium flex  md:text-base text-sm items-center justify-center text-right">
                        {{ __('Information for decision making')}}
                        <x-icon class="ml-2" icon="arrow-right-sidebar" width=15 height=15 viewBox="1024 1024" strokeWidth=0 fill="white" />
                    </span>
                </button>
            </div>
        </div>

        <div class="bg-gray-100 border border-gray-400 p-5">
            <div class="text-2xl font-bold mb-4">{{__('metrics')}}</div>

            <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 px-5 mb-4">
                <div class="w-full h-24 border border-gray-400 bg-white rounded-lg shadow flex flex-col px-4 py-2 justify-between">
                    <span class="text-xl">{{__('Total Products')}}</span>
                    <span class="font-medium text-xl text-right">100</span>
                </div>
                <div class="w-full h-24 border border-gray-400 bg-white rounded-lg shadow flex flex-col px-4 py-2 justify-between">
                    <span class="text-xl">{{__('Recived Today')}}</span>
                    <span class="font-medium text-xl text-right">10</span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 px-5 mb-4">
                <div class="w-full h-24 border border-gray-400 bg-white rounded-lg shadow flex flex-col px-4 py-2 justify-between">
                    <span class="text-xl">{{__('Total Income')}}</span>
                    <span class="font-medium text-xl text-right">9</span>
                </div>
                <div class="w-full h-24 border border-gray-400 bg-white rounded-lg shadow flex flex-col px-4 py-2 justify-between">
                    <span class="text-xl">{{__('Total Egress')}}</span>
                    <span class="font-medium text-xl text-right">5</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 px-5 mb-4">
                <div class="w-full h-24 border border-gray-400 bg-white rounded-lg shadow flex flex-col px-4 py-2 justify-between">
                    <span class="text-xl">{{__('Total receipts generated')}}</span>
                    <span class="font-medium text-xl text-right">50</span>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection