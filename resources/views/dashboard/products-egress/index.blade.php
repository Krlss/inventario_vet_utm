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
            <span>{{__('History of expenses made and creation of new expenses of products and medical equipment')}}</span>
        </div>

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">

            <x-input-search element="search" placeholder="{{__('Search by reason')}}" label="{{__('Reason')}}" />

            <div class="flex xs:items-end items-start justify-between w-full xs:flex-row flex-col gap-2">
                <x-input-date label="Fecha" element="date" />
                @can('inventory.egress-products.create')
                <a href="{{ route('dashboard.products-egress.create') }}" class="bg-green-page text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium hover:no-underline">
                    {{__('New Expenses')}}
                </a>
                @endcan
            </div>


        </div>

        <x-flash-messages />
        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('N° Expenses')}}</th>
                    <th>{{__('Date/Time')}}</th>
                    <th>{{__('Reason')}}</th>
                    <th>{{__('N° Products')}}</th>
                    <th>{{__('Actions')}}</th>
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
        search: '',
        date: null
    });

    function fetch_data(params) {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            autoWidth: false,
            order: [
                [0, "desc"]
            ],
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
                        title: 'Reporte de egresos de productos '+new Date().toLocaleDateString(),              
                        exportOptions: {
                            columns: [0,1,2,3]
                        }  
                    },{
                        extend: 'csv',
                        text: 'CSV',
                        title: 'Reporte de egresos de productos '+new Date().toLocaleDateString(),              
                        exportOptions: {
                            columns: [0,1,2,3]
                        }  
                    }]
                }],
            dataType: 'json',
            language: len,
            ajax: {
                url: "{{ route('dashboard.products-egress.index') }}",
                data: {
                    search: params.search,
                    date: params.date
                },
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },
                {
                    data: 'products[]',
                    render: function(data, type, row, meta) {
                        return data.length
                    }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    }

    $('.filter-input').keyup(function() {
        var search = $('#search').val();
        var date = $('#date').val();
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search,
            date
        })
    });


    $('.filter-select').change(function() {
        var search = $('#search').val();
        var date = $('#date').val();
        console.log(date)
        $('#table').DataTable().clear().draw();
        $('#table').DataTable().destroy();
        fetch_data({
            search,
            date
        })
    });
</script>
@endpush