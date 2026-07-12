<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layouts.head')
</head>
<body>
    <a href="#main-content" class="skip-link">{{ __('Skip to main content') }}</a>
    @include('frontend.layouts.header')
    <main id="main-content" role="main">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    @stack('script')
</body>
</html>
