@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush

@section('content_header')
<div>
    <h2 class="text-2xl font-extrabold"> {{ __('Title Home') }} </h2>
    <h3 class="text-lg uppercase font-semibold">Stock Críticos y Productos por Caducar</h3>
    <h4 class="text-md font-normal">Listado de productos escasos y próximos a llegar a su fecha de vencimiento</h4>
</div>
@endsection

@section('content')
<ul class="nav nav-pills  nav-justified mb-3" id="pills-tab" role="tablist">
    <li class="nav-item custom-item" role="presentation">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Productos por Caducar</a>
    </li>
    <li class="nav-item custom-item " role="presentation">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Productos con poco Stock </a>
    </li>

</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">
            <x-input-select-date element="search-expire" :dates="$dates" placeholder="{{ __('Search by product name') }}" label="{{ __('Expire-date') }}" />

        </div>
        <table id="tablesexpire" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Stock') }}</th>
                    <th>{{ __('Lote') }}</th>
                    <th>{{ __('Expire') }}</th>
                    <th>{{ __('State') }}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">
            <x-input-search element="search-stock" placeholder="{{ __('Search by product name') }}" label="{{ __('Product name') }}" />

        </div>
        <table id="tablestock" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Stock') }}</th>
                    <th>{{ __('Min Stock') }}</th>
                    <th>{{ __('State') }}</th>
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
<script src="{{ asset('json/table.json') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script type="text/javascript">
    fetch_data_stock({
        search: ''
    });

    fetch_data_expire({
        month: '',
        year: ''
    })


    function fetch_data_stock(params) {
        $('#tablestock').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            order: [
                [0, "desc"]
            ],
            "dom": 'ftipr',
            columnDefs: [{
                orderable: false,
                targets: -1,
            }],
            language: len,
            ajax: {
                url: "{{ route('dashboard.products-minstock') }}",
                data: {
                    search: params.search
                }
            },
            columns: [{
                    data: 'id',
                },
                {
                    data: 'name',
                },
                {
                    data: 'stock'
                },
                {
                    data: 'stock_min',
                },
                {
                    data: 'amount',
                    render: function(data, type, row) {
                        const {
                            stock,
                            stock_min
                        } = row;
                        let span = '';
                        if (stock == 0) {
                            /* Sin stock */
                            span = '<span class="badge badge-danger"> Sin stock</span>';
                        } else if (stock <= Math.round(stock_min * 0.5) && stock > 0) {
                            span = '<span class="badge badge-warning"> Stock moderado</span>';
                            /* Moderado */
                        } else if (stock <= stock_min) {
                            /* Stock Minimo */
                            span = '<span class="badge badge-success"> Stock minímo</span>';
                        }
                        return span;
                    }
                },

            ]
        });
    }

    function fetch_data_expire(params) {
        $('#tablesexpire').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            order: [
                [0, "desc"]
            ],
            "dom": 'ftipr',
            columnDefs: [{
                orderable: false,
                targets: -1,
            }],
            language: len,
            ajax: {
                url: "{{ route('dashboard.products-expire') }}",
                data: {
                    year: params.year,
                    month: params.month
                }
            },
            columns: [{
                    data: 'id',
                },
                {
                    data: 'name',
                },
                {
                    data: 'stock'
                },
                {
                    data: 'lote',
                    render: function(data, type, row) {
                        return `<span class="badge badge-primary">${data}</span> `;
                    }
                },
                {
                    data: 'expire',
                    render: function(data, type, row) {
                        return moment(data).format("MMMM Do YYYY");
                    }
                },
                {
                    data: 'amount',
                    render: function(data, type, row) {
                        const {
                            expire
                        } = row;
                        if (moment(expire).diff(moment(), 'days') <= 0) return '<span class="badge badge-danger">Producto caducado</span>';
                        return `<span class="badge badge-success">${moment(expire).toNow(true)}</span>`;
                    }
                },

            ]
        });
    }

    $('#search-stock').keyup(function() {
        var search = $('#search-stock').val();
        $('#tablestock').DataTable().clear().draw();
        $('#tablestock').DataTable().destroy();
        fetch_data_stock({
            search: search
        })
    });
    var month_name = {
        'Enero': '01',
        'Febrero': '02',
        'Marzo': '03',
        'Abril': '04',
        'Mayo': '05',
        'Junio': '06',
        'Julio': '07',
        'Agosto': '08',
        'Septiembre': '09',
        'Octubre': '10',
        'Noviembre': '11',
        'Diciembre': '12'
    }
    $('#search-expire').on('change', function() {
        var search = $('#search-expire').val();
        var month = '';
        var year = '';
        if (search !== 0) {
            month = search.split(' ')[1];
            year = search.split(' ')[0];
        };
        console.log(month, "---", year);
        $('#tablesexpire').DataTable().clear().draw();
        $('#tablesexpire').DataTable().destroy();
        fetch_data_expire({
            month: month_name[month],
            year: year
        })
    });
</script>
@endpush