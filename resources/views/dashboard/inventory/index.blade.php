@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">



@endpush

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')
<div class="card">
    @canany(['inventory.products.index', 'inventory.ingress-products.index', 'inventory.egress-products.index', 'inventory.products.create'])
    <div class="card-head">
        <ul class="flex md:flex-row flex-col border-b">
            @can('inventory.products.index')
            <x-tabs routeTo='dashboard.inventory.index' routeCurrent='inventory*' title='Busqueda' />
            @endcan
            @can('inventory.ingress-products.index')
            <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*' title='Ingreso Productos' />
            @endcan
            @can('inventory.egress-products.index')
            <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*' title='Egreso Productos' />
            @endcan
            @can('inventory.products.create')
            <x-tabs routeTo='dashboard.products.create' routeCurrent='products/*' title='Crear Producto' />
            @endcan
        </ul>
    </div>
    @endcanany
    <div class="card-body pt-0 mt-0">

        <div class="text-center">
            <span>{{ __('Search for the products and equipment registered in the system') }}</span>
        </div>

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">
            <x-input-search element="search" placeholder="{{ __('Search by product name') }}" label="{{ __('Product name') }}" />

            <div class="flex md:flex-row flex-col gap-2">
                <x-select-search :array="$types" label="{{ __('Type') }}" optionDefault="{{ __('All') }}" element="type" />
                <x-select-search :array="$categories" label="{{ __('Category') }}" optionDefault="{{ __('All') }}" element="category" />
            </div>

        </div>

        <x-flash-messages />

        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Stock') }}</th>
                    <th>{{ __('Unit') }}</th>
                    <th>{{ __('Amount') }}</th>
                    <th>{{ __('Cost') }}</th>
                    <th>{{ __('Types') }}</th>
                    <th>{{ __('Categories') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/buttons.html5.min.js') }}"></script>

<script src="{{ asset('json/table.json') }}"></script>
<script type="text/javascript">
    fetch_data({
        type: '',
        category: '',
        search: ''
    });

    function fetch_data(params) {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            dataType: 'json',
            dom: "<'row'<'col-sm-4'B><'col-sm-4'><'col-sm-2'><'col-sm-2'l>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'collection',
                className: 'exportButton',
                text: 'Exportar',
                buttons: [
                    { 
                        extend: 'excel',
                        text: 'Excel',     
                        title: 'Reporte de productos '+new Date().toLocaleDateString(),              
                    },{
                        extend: 'csv',
                        text: 'CSV',
                        title: 'Reporte de productos '+new Date().toLocaleDateString(),    
                    }]
                }],
            language: len,
            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "{{ route('dashboard.inventory.index') }}",
                data: {
                    type: params.type,
                    category: params.category,
                    search: params.search
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'stock',
                    name: 'stock',
                    searchable: false,
                },
                {
                    data: 'unit.name',
                    name: 'unit.name',
                    searchable: false,
                },
                {
                    data: 'amount',
                    name: 'amount',
                    searchable: false,
                },
                {
                    data: 'cost',
                    name: 'cost',
                    searchable: false,
                },
                {
                    data: 'types[].name',
                    name: 'types[].name',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small +=
                                `<span class='badge badge-primary truncate max-w-100px text-left'>${e}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'categories[].name',
                    name: 'categories[].name',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small +=
                                `<span class='badge badge-primary truncate max-w-100px text-left'>${e}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                },

            ]
        });
    }

    $('.filter-input').keyup(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        var search = $('#search').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search: search,
            category: category_id,
            type: type_id
        })
    });

    $('.filter-select').change(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search: '',
            category: category_id,
            type: type_id
        })
    });
</script>
@endpush