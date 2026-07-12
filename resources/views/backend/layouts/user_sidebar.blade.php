<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src">
            <span class="logo-brand" style="font-size: 0.875rem; font-weight: 600;">{{ __('Dashboard') }}</span>
        </div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic is-active"
                        data-class="closed-sidebar"
                        aria-label="{{ __('Collapse sidebar') }}">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"
                    aria-label="{{ __('Open navigation menu') }}">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"
                    aria-label="{{ __('More options') }}">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu" role="navigation" aria-label="{{ __('User navigation') }}">
                <li>
                    <a href="{{ URL::to('/user/dashboard') }}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('/user/profile') }}">
                        <i class="metismenu-icon pe-7s-user"></i>
                        {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('/user/change_password') }}">
                        <i class="metismenu-icon pe-7s-lock"></i>
                        {{ __('Change Password') }}
                    </a>
                </li>
                <li class="sidebar-divider mt-3 mb-2">
                    <span class="sidebar-divider-text">{{ __('Account') }}</span>
                </li>
                <li>
                    <a href="{{ URL::to('/user_login/logout') }}">
                        <i class="metismenu-icon pe-7s-power"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var currentPath = window.location.pathname;
        $('.app-sidebar__inner .vertical-nav-menu > li').each(function () {
            var link = $(this).find('a:first').attr('href');
            if (link && currentPath.indexOf(link.replace(window.location.origin, '')) === 0) {
                $(this).addClass('mm-active');
            }
        });
    });
</script>
