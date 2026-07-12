<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>@yield('title', 'Dashboard') | LEBAR</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content="LEBAR Admin Panel">
<meta name="author" content="LEBAR">
<meta name="msapplication-tap-highlight" content="no">
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/design-system.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/custom_admin_style.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/admin-forms.css') }}">

@stack('styles')

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>

<script>
    var CSRF_TOKEN = "{{ csrf_token() }}";
</script>
