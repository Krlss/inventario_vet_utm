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
                <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*'
                    title='Ingreso Productos' />
                <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*'
                    title='Egreso Productos' />
                <x-tabs routeTo='dashboard.products.index' routeCurrent='products*' title='Crear Producto' />
            </ul>
        </div>
        <div class="card-body pt-0 mt-0">
            <div class="grid grid-rows-4 divide-y divide-gray-100">
                <div class="py-1">
                    <h2 class="text-lg font-semibold">
                        Producto
                    </h2>
                    <p class="text-gray-500">
                        Completa la informacion e ingresa un nuevo producto al almacen.
                    </p>
                </div>
                <div class="py-1">
                    <div class="flex flex-col md:flex-row  justify-between ">
                        <div class="sm:my-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"></span>
                                </div>
                                <input type="text" name="name" id="name"
                                    class="focus:ring-indigo-100 focus:border-indigo-100 block w-full pl-7 h-12 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Nombre del Producto">
                            </div>
                        </div>
                        <div class="sm:my-4">
                            <label for="container" class="block text-sm font-medium text-gray-700">Btu</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"></span>
                                </div>
                                <input type="number" name="container" id="container"
                                    class="focus:ring-indigo-100 focus:border-indigo-100 block w-full pl-7 h-12 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="sm:my-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"> $ </span>
                                </div>
                                <input type="text" name="price" id="price"
                                    class="focus:ring-indigo-100 focus:border-indigo-100 block w-full pl-7 h-12 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label for="currency" class="sr-only">Currency</label>
                                    <select id="currency" name="currency"
                                        class="focus:ring-indigo-100 focus:border-indigo-100 py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                        <option>USD</option>
                                        <option>CAD</option>
                                        <option>EUR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="sm:my-4">
                            <label for="country" class="block text-sm font-medium text-gray-700">Unidad de medida</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"></span>
                                </div>
                                <select id="country" name="country" autocomplete="country-name"
                                    class="mocus:ring-indigo-100 focus:border-indigo-100 block w-full pl-7 h-12 pr-12 sm:text-sm border-gray-300 rounded-md">
                                    <option>Miligramos (GR)</option>
                                    <option>Mililitros (ML)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="flex flex-col md:flex-row  justify-between">
                        <div class="md:my-4">
                            <label for="stock_min" class="block text-sm font-medium text-gray-700">Stock minímo</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm"></span>
                                </div>
                                <input type="number" name="stock_min" id="stock_min"
                                    class="focus:ring-indigo-100 focus:border-indigo-100 block w-full pl-7 h-12 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="md:my-4 w-60 ">
                            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria
                                <span
                                    class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Agregar</span>
                            </label>
                            <select id="categoria" name="categoria" autocomplete="country-name"
                                class="mt-1 block mocus:ring-indigo-100 w-full h-12 py-2 px-3  border-gray-300 bg-white rounded-md shadow-sm  focus:border-indigo-100 sm:text-sm">
                                <option selected>Abrir el menú</option>
                                @foreach ($categories as $category)
                                    <option value={{$category->id}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:my-4 w-60 ">
                            <label for="categoria" class="block text-sm font-medium text-gray-700">Tipo
                                <span
                                    class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Agregar</span>
                            </label>
                            <select id="tipo" name="tipo" autocomplete="country-name"
                                class="mt-1 block w-full h-12 py-2 px-3  border-gray-300 bg-white rounded-md shadow-sm  focus:border-indigo-100 sm:text-sm">
                                <option selected>Abrir el menú</option>
                                @foreach ($types as $type)
                                    <option value={{$type->id}}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:my-4 w-48 ">
                            
                        </div>
                        
                    </div>
                </div>
                <div class="py-3">
                    <div class="flex flex-row-reverse">
                        <div class="mx-3">
                            <button type="button"
                                class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Guardar</button>
                        </div>
                        <div class="mx-3">
                            <button type="button"
                                class="inline-block px-6 py-2 border-2 border-yellow-500 text-yellow-500 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Limpiar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
