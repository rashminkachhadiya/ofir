@props(['label', 'for' => ''])

<div class="form-jewel-field">
    <label class="form-jewel-field__label" @if($for) for="{{ $for }}" @endif>{{ $label }}</label>
    {{ $slot }}
</div>
