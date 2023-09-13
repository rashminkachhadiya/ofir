<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/santral-blackitalic" rel="stylesheet">
    <link href="{{ asset('assets/login/css/util.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/vendor/bootstrap.min.css') }}">
    <link href="{{ asset('assets/login/css/main.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('/assets/login/js/main.js') }}"></script>
@stack('script')
</body>
</html>
