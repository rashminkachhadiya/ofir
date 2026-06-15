@php
    $supportedLocales = ['en' => 'English', 'ru' => 'Russian'];
    $currentLocale = app()->getLocale();
@endphp
<div style="position: fixed; right: 16px; top: 16px; z-index: 1030; width: 140px;">
    <select class="form-control input-sm"
            aria-label="{{ __('Language') }}"
            onchange="window.location='{{ url('/language') }}/' + this.value">
        @foreach($supportedLocales as $localeCode => $localeName)
            <option value="{{ $localeCode }}" {{ $currentLocale === $localeCode ? 'selected' : '' }}>{{ $localeName }}</option>
        @endforeach
    </select>
</div>
