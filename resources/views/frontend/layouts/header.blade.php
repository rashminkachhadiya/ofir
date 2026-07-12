@php
    $supportedLocales = ['en' => 'English', 'ru' => 'Russian'];
    $currentLocale = app()->getLocale();
@endphp
<header class="site-header">
    <nav class="navbar navbar-expand-md site-navbar">
        <div class="container">
            <div class="nav-link-slot">
                @yield('nav_link')
            </div>

            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="#siteNavbar" aria-controls="siteNavbar"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="siteNavbar">
                <ul class="navbar-nav ml-auto align-items-md-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/cart') }}">
                            <i class="fa fa-shopping-cart mr-1"></i>{{ __('Cart') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="lang-switcher lang-switcher--inline px-md-2 py-2">
                            <select class="form-control form-control-sm"
                                    aria-label="{{ __('Language') }}"
                                    onchange="window.location='{{ url('/language') }}/' + this.value">
                                @foreach($supportedLocales as $localeCode => $localeName)
                                    <option value="{{ $localeCode }}" {{ $currentLocale === $localeCode ? 'selected' : '' }}>{{ $localeName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
