@include('sweetalert::alert')
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@yield('content_header')
@stop

@section('content')
@yield('content')
@stop

@section('footer')
<div class="float-right d-none d-md-block">
    <b>Version</b> 1.0.0
</div>
<strong>Copyright © Facultad de Ciencias informáticas UTM.</strong> Todos los derechos reservados.
@endsection

@section('css')
@stop

@section('js')
@livewireScripts
<script>
    $('form').submit(function(event) {
        console.log('submit');
        if ($(this).hasClass('submitted')) {
            event.preventDefault();
        } else {
            if ($(this).find(':submit').hasClass('save')) {
                $(this).find(':submit').html('Cargando... <i class="fa fa-spinner fa-spin"></i>');
            } else {
                //find input type submit and change text
                $(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
            }
            $(this).find(':submit').prop('disabled', true);
        }
    });
</script>
@stop