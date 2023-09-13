<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts.head')
</head>
<body>
    <div class="container-fluid">    
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
