@php
    $supportedLocales = ['en' => 'English', 'ru' => 'Russian'];
    $currentLocale = app()->getLocale();
@endphp
<div class="lang-switcher">
    <select class="form-control form-control-sm"
            aria-label="{{ __('Language') }}"
            onchange="window.location='{{ url('/language') }}/' + this.value">
        @foreach($supportedLocales as $localeCode => $localeName)
            <option value="{{ $localeCode }}" {{ $currentLocale === $localeCode ? 'selected' : '' }}>{{ $localeName }}</option>
        @endforeach
    </select>
</div>
