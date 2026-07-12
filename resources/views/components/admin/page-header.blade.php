@props([
    'title',
    'icon' => null,
    'iconClass' => 'bg-mean-fruit',
])

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            @if($icon)
                <div class="page-title-icon">
                    <i class="pe-7s-{{ $icon }} icon-gradient {{ $iconClass }}"></i>
                </div>
            @endif
            <div>{{ $title }}</div>
            @isset($actions)
                <div class="d-inline-block ml-2">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</div>
