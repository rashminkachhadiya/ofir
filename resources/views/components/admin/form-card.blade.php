@props(['title' => ''])

<div {{ $attributes->merge(['class' => 'main-card mb-3 card profile-form-card admin-form-page']) }}>
    @if($title)
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 font-weight-semibold">{{ $title }}</h5>
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
