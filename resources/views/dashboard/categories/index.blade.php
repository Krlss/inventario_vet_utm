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
            <span class="font-bold text-lg">{{__('Categories registered in the system')}}</span>
            <x-button-add-modal target="category" />
        </div>

        <x-flash-messages />
        <div class="flash-message"></div>

        <table id="table" class="table table-hover table-striped">
            <thead class="bg-black text-white">
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Created_at')}}</th>
                    <th>{{__('Updated_at')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('partials.modals.universal-modal')
</div>

@endsection

@push('js')
@include('dashboard.categories.datatable')
@include('partials.js_modals.universal-modal')

<script>
    $('#add_data').click(function() {
        $('#universalModal').modal('show');
        $('#modal_form')[0].reset();
        $('.error_modal').html('');
        $('#button_action').val('insert');
        $('#modal_class').val('categories'); // This is the class that will be used in the model 
        $('div.flash-message').html('');
        $('.modal-title').text("{{__('Creating a new category')}}");
    });

    $('#universalModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal 

        var id = button.data('id')
        var name = button.data('name')

        var modal = $(this)

        $('.modal-title').text("{{__('Editing category')}}");
        $('#button_action').val("update");
        $('#modal_class').val('categories'); // This is the class that will be used in the model 
        $('.error_modal').html('');
        $('div.flash-message').html('');
        $('#universalModal').find('#modal_id').val(id);
        $('#universalModal').find('#name').val(name);

    })
</script>
@endpush