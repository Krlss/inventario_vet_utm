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
@stack('css_lib')
@stop

@section('js')
@stack('scripts_lib')
@stop