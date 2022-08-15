@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatable/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatable/responsive.bootstrap4.min.css') }}">
@endpush

@section('content_header')
<div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body pt-0 mt-0">

        <div class="mt-2 mb-4 flex md:flex-row flex-col md:items-center items-start justify-between gap-2">
            <span class="font-bold text-lg">{{__('Lotes registered in the system')}}</span>
        </div>

        <x-flash-messages />
        <div class="flash-message"></div>

        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Expire')}}</th>
                    <th>{{__('Created_at')}}</th>
                    <th>{{__('Updated_at')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
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
<script type="text/javascript">
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        dataType: 'json',
        dom: 'lfrtip',
        language: len,
        order: [
            [0, "desc"]
        ],
        ajax: {
            url: "{{ route('dashboard.lotes.index') }}"
        },
        columns: [{
                data: 'lote',
                name: 'lote'
            },
            {
                data: 'expire',
                name: 'expire',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'updated_at',
                name: 'updated_at',
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false,
            },

        ]
    });
</script>
@endpush