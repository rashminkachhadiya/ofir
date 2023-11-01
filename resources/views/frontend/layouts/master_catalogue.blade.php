<!DOCTYPE html>
<html>
<head>
    @include('frontend.layouts.head')
</head>
<body>
    @include('frontend.layouts.header')    
    @yield('content')
    @include('frontend.layouts.footer')    
    @stack('script')
</body>
</html>
