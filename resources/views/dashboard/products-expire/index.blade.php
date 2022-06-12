@extends('layouts.app')

@push('css_lib')
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
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Productos por Caducar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                aria-controls="pills-profile" aria-selected="false">Productos con poco Stock </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"></div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">
                <x-input-search element="search" placeholder="{{ __('Search by product name') }}"
                    label="{{ __('Product name') }}" />

            </div>
            <table id="tablestock" class="table table-hover table-striped">
                <thead class="bg-black text-white">
                    <tr>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Stock') }}</th>
                        <th>{{ __('Min Stock') }}</th>
                        <th>{{ __('Amount') }}</th>
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
            search: ''
        });

        function fetch_data(params) {
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
                    },

                ]
            });
        }

        $('.filter-input').keyup(function() {
            var search = $('#search').val();
            $('#tablestock').DataTable().clear().draw();
            $('#tablestock').DataTable().destroy();
            fetch_data({
                search: search
            })
        });
    </script>
@endpush
