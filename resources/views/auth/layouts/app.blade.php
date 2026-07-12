<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'LEBAR'))</title>

    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom_frontend_style.css') }}">

    @stack('auth-styles')
    @if(View::hasSection('use-login-theme'))
        <link href="{{ asset('assets/login/css/util.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/login/css/main.css') }}" rel="stylesheet">
    @endif

    @stack('styles')
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
@if(View::hasSection('use-login-theme'))
    <script src="{{ asset('/assets/login/js/main.js') }}"></script>
@endif
@stack('script')
</body>
</html>
