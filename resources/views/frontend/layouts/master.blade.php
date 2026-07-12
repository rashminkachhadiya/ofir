<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layouts.head')
</head>
<body>
    <a href="#main-content" class="skip-link">{{ __('Skip to main content') }}</a>
    @include('frontend.layouts.language_switcher')
    <div class="container-fluid p-0">
        <main id="main-content" role="main">
            @yield('content')
        </main>
        @include('frontend.layouts.footer')
    </div>
    @stack('script')
</body>
</html>
