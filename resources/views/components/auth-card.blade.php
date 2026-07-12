@props([
    'title' => '',
    'subtitle' => '',
    'wide' => false,
    'catalogue' => false,
    'form' => false,
    'cart' => false,
])

@php
    $classes = 'auth-card';
    if ($wide) $classes .= ' auth-card--wide';
    if ($catalogue) $classes .= ' auth-card--catalogue';
    if ($form) $classes .= ' auth-card--form';
    if ($cart) $classes .= ' auth-card--cart';
@endphp

<div class="auth-shell">
    <div {{ $attributes->merge(['class' => $classes]) }}>
        @if($title)
            <h1 class="auth-card__title">{{ $title }}</h1>
        @endif
        @if($subtitle)
            <p class="auth-card__subtitle">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
</div>
