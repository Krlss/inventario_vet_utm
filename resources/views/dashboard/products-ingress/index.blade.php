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
            <x-tabs routeTo='dashboard.products-ingress.index' routeCurrent='products-ingress*' title='Ingreso Productos' />
            <x-tabs routeTo='dashboard.products-egress.index' routeCurrent='products-egress*' title='Egreso Productos' />
            <x-tabs routeTo='dashboard.products.index' routeCurrent='products/*' title='Crear Producto' />
        </ul>
    </div>
    <div class="card-body pt-0 mt-0">

        <div class="text-center">
            <span>{{__('History of realized income and creation of new income from medical products and equipment')}}</span>
        </div>

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">

            <x-input-search element="search" placeholder="{{__('Search by reason')}}" label="{{__('Reason')}}" />

            <div class="flex xs:items-end items-start justify-between w-full xs:flex-row flex-col gap-2">
                <x-input-date label="Fecha" element="date" />
                <a href="{{ route('dashboard.products-ingress.create') }}" class="bg-green-1000 text-white py-2 px-4 hover:bg-green-900 rounded-md font-medium hover:no-underline">
                    {{__('New Income')}}
                </a>
            </div>


        </div>

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
        </div>
        @endif

        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('N° Income')}}</th>
                    <th>{{__('Date/Time')}}</th>
                    <th>{{__('Reason')}}</th>
                    <th>{{__('N° Products')}}</th>
                    <th>{{__('View Log')}}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts_lib')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
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
            lengthChange: false,
            "dom": 'lrtip',
            columnDefs: [{
                orderable: false,
                targets: -1,
            }],
            language: len,
            ajax: {
                url: "{{ route('dashboard.products-ingress.index') }}",
                data: {
                    search: params.search,
                    date: params.date
                },
                type: 'GET'
            },
            columns: [{
                    data: 'id',
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'detail',
                },
                {
                    data: 'products',
                    render: function(data, type, row, meta) {
                        return data.length
                    }
                },
                {
                    data: 'link'
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