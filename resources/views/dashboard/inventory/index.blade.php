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
            <x-tabs routeTo='dashboard.products.index' routeCurrent='products*' title='Crear Producto' />
        </ul>
    </div>
    <div class="card-body pt-0 mt-0">

        <!-- <span class="font-extrabold">Busque los productos y equipamientos registrados en el sistema</span> -->

        <div class="flex md:flex-row flex-col justify-between md:items-end items-start gap-2 mb-2">

            <x-input-search element="search" placeholder="{{__('Search to product name')}}" label="{{__('Product name')}}" />

            <div class="flex md:flex-row flex-col gap-2">
                <x-select-search :array="$types" label="{{__('Type')}}" optionDefault="{{__('All')}}" element="type" />
                <x-select-search :array="$categories" label="{{__('Category')}}" optionDefault="{{__('All')}}" element="category" />
            </div>

        </div>

        <table id="table" class="table table-hover">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('Code')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Cost')}}</th>
                    <th>{{__('Categories')}}</th>
                    <th>{{__('Types')}}</th>
                    <th>{{__('Expire')}}</th>
                    <th>{{__('created_at')}}</th>
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
            autoWidth: false,
            lengthChange: false,
            dom: 'lrtip',
            columnDefs: [{
                orderable: false,
                targets: -1,
            }],
            language: len,
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
                },
                {
                    data: 'name',
                },
                {
                    data: 'amount',
                },
                {
                    data: 'cost',
                },
                {
                    data: 'categories',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small += `<span class='badge badge-primary truncate max-w-100px text-left'>${e.name}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'types',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var small = '';
                        data.forEach(e => {
                            small += `<span class='badge badge-primary truncate max-w-100px text-left'>${e.name}</span><br>`;
                        })
                        return small;
                    }
                },
                {
                    data: 'expire',
                },
                {
                    data: 'created_at',
                }
            ]
        });
    }

    $('#type').change(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        $('#search').val('');
        $('#table').DataTable().destroy();
        fetch_data({
            search: '',
            category: category_id,
            type: type_id
        })
    })

    $('#category').change(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        $('#search').val('');
        $('#table').DataTable().destroy();
        fetch_data({
            search: '',
            category: category_id,
            type: type_id
        })
    })

    $('#search').keyup(function() {
        var type_id = $('#type').val();
        var category_id = $('#category').val();
        var search = $('#search').val();
        $('#table').DataTable().destroy();
        fetch_data({
            search: search,
            category: category_id,
            type: type_id
        })
    })

    /*  $('.filter-input').keyup(function() {
         table.column($(this).data('column'))
             .search($(this).val())
             .draw();
     });
     // dropdown
     $('.filter-select').change(function() {
         table.column($(this).data('column'))
             .search($(this).val())
             .draw();
     }); */
</script>
@endpush

<!-- @foreach($products as $product)
<tr>
    <td>{!! $product->id !!}</td>
    <td>{!! $product->name !!}</td>
    <td>{!! $product->amount !!}</td>
    <td>{!! $product->cost !!}</td>
    <td>{!! $product->categories->map(function($category) {
        return "<span class='badge badge-primary truncate max-w-100px text-left'>".$category->name."</span>";
        })->implode('<br>') !!}</td>
    </td>

    <td>{!! $product->types->map(function($type) {
        return "<span class='badge badge-primary truncate max-w-100px text-left'>".$type->name."</span>";
        })->implode('<br>') !!}</td>
    </td>

    <td>{!! $product->expire !!}</td>
    <td>{!! $product->created_at !!}</td>
</tr>
@endforeach -->