<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layouts.head')
</head>
<body>
    @include('frontend.layouts.language_switcher')
    <div class="container-fluid p-0">    
        <section>
            @yield('content')
        </section>
        <!-- Footer section -->
        <footer>
            @include('frontend.layouts.footer')
        </footer>
    </div>
    @stack('script')
</body>
</html>
