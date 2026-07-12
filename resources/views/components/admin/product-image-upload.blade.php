@props([
    'slotId' => 1,
    'inputName' => 'photo_1',
    'label' => 'Photo',
    'src' => '',
    'primary' => false,
])

@php
    $hasImage = !empty($src);
    $displaySrc = $hasImage ? asset($src) : '';
@endphp

<div class="product-image-slot {{ $primary ? 'product-image-slot--primary' : 'product-image-slot--thumb' }}">
    <span class="product-image-slot__badge">{{ $label }}</span>
    <div class="product-image-slot__frame uploadImage {{ $hasImage ? '' : 'is-empty' }}"
         data-id="{{ $slotId }}"
         role="button"
         tabindex="0"
         aria-label="{{ __('Upload :label', ['label' => $label]) }}">
        <img id="preview-{{ $slotId }}"
             src="{{ $displaySrc }}"
             alt="{{ $label }}"
             class="product-image-slot__img {{ $hasImage ? 'has-image' : '' }}"
             @unless($hasImage) style="display: none;" @endunless
             onerror="this.style.display='none'; this.classList.remove('has-image'); this.closest('.product-image-slot__frame').classList.add('is-empty'); this.closest('.product-image-slot__frame').querySelector('.product-image-slot__empty').classList.add('is-visible');">
        <div class="product-image-slot__empty {{ $hasImage ? '' : 'is-visible' }}">
            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
            <span>{{ $primary ? __('Upload main photo') : __('Add photo') }}</span>
            <small>{{ __('JPG, PNG') }}</small>
        </div>
    </div>
    <input id="photo-{{ $slotId }}"
           type="file"
           accept="image/*"
           class="d-none"
           name="{{ $inputName }}"
           onchange="showImage({{ $slotId }})">
</div>
