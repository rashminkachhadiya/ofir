<footer class="site-footer">
    <p>&copy; {{ date('Y') }} {{ config('app.name', 'LEBAR') }}. {{ __('All rights reserved.') }}</p>
</footer>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>

<script>
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
