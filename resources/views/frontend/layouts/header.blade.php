<header class="header">
        @php
            $supportedLocales = ['en' => 'English', 'ru' => 'Russian'];
            $currentLocale = app()->getLocale();
        @endphp
        <nav class="navbar navbar-style">
            <div class="container">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#micon" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

                <div class="navbar-header">
                    @yield('nav_link')
                </div>

                <div class="collapse navbar-collapse" id="micon">
                <ul class="nav navbar-nav navbar-right">
                    <li><a style="color: black;" href="{{ URL::to('/cart') }}">{{ __('Cart') }}</a></li>
                    <li style="padding: 8px 0 8px 8px;">
                        <select class="form-control input-sm"
                                aria-label="{{ __('Language') }}"
                                style="min-width: 130px;"
                                onchange="window.location='{{ url('/language') }}/' + this.value">
                            @foreach($supportedLocales as $localeCode => $localeName)
                                <option value="{{ $localeCode }}" {{ $currentLocale === $localeCode ? 'selected' : '' }}>{{ $localeName }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                </div>
            </div>
            
        </nav>      
    </header>
