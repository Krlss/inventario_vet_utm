<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SINVET') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>

    @include('layouts.navbar')

    <div class="flex flex-row">
        @include('layouts.sidebar')

        <div class="py-5 pr-5 md:pl-20 pl-5 w-full">
            <!-- Content page -->
            @yield('content')
        </div>

    </div>


</body>

@stack('scripts_lib')

</html>