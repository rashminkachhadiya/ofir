<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('backend.layouts.head')
</head>
<body>
<a href="#main-content" class="skip-link">{{ __('Skip to main content') }}</a>
<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
    @include('backend.layouts.user_topbar')
    <div class="app-main">
        @include('backend.layouts.user_sidebar')
        <div class="app-main__outer">
            <main class="app-main__inner" id="main-content" role="main">
                @yield('content')
            </main>
        </div>
    </div>
    <div class="app-wrapper-footer">
        @include('backend.layouts.footer')
        @include('backend.layouts.modal')
        @include('backend.layouts.datatable')
        @stack('script')
    </div>
</div>
<script>
(function () {
    var overlay = document.getElementById('sidebarOverlay');
    if (!overlay) return;

    function closeSidebar() {
        document.body.classList.remove('sidebar-mobile-open');
        overlay.classList.remove('is-visible');
        overlay.setAttribute('aria-hidden', 'true');
    }

    function openSidebar() {
        document.body.classList.add('sidebar-mobile-open');
        overlay.classList.add('is-visible');
        overlay.setAttribute('aria-hidden', 'false');
    }

    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('.mobile-toggle-nav');
        if (toggle) {
            if (document.body.classList.contains('sidebar-mobile-open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 991) closeSidebar();
    });
})();
</script>
</body>
</html>
