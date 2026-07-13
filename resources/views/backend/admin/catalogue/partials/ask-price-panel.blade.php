@php
    $item = $item ?? null;
    $value = function ($field, $default = '') use ($item) {
        return old($field, $item ? ($item->{$field} ?? $default) : $default);
    };
    $checked = function ($field, $compare) use ($item) {
        $current = old($field, $item ? $item->{$field} : null);
        if ($current === null) {
            return false;
        }
        return (string) $current === (string) $compare;
    };
@endphp

<div class="form-price-panel">
    <h5 class="form-price-panel__title">{{ __('Ask for Price') }}</h5>

    <div class="form-price-section">
        <p class="form-price-section__label">{{ __('Cost breakdown') }}</p>
        <div class="form-price-row form-price-row--4">
            <div class="form-group">
                <label for="cost_fee">{{ __('Work') }}</label>
                <input type="text" class="form-control" id="cost_fee" name="cost_fee" value="{{ $value('cost_fee') }}" placeholder="{{ __('Work') }}">
            </div>
            <div class="form-group">
                <label for="setting">{{ __('Setting') }}</label>
                <input type="text" class="form-control" id="setting" name="setting" value="{{ $value('setting') }}" placeholder="{{ __('Setting') }}">
            </div>
            <div class="form-group">
                <label for="diamond">{{ __('Diamond') }}</label>
                <input type="text" class="form-control" id="diamond" name="diamond" value="{{ $value('diamond') }}" placeholder="{{ __('Diamond') }}">
            </div>
            <div class="form-group">
                <label for="loss">{{ __('Loss') }}</label>
                <input type="text" class="form-control" id="loss" name="loss" value="{{ $value('loss') }}" placeholder="{{ __('Loss') }}">
            </div>
        </div>
        <div class="form-price-row form-price-row--full">
            <div class="form-group">
                <label for="diamond_note">{{ __('Note') }}</label>
                <input type="text" class="form-control" id="diamond_note" name="diamond_note" value="{{ $value('diamond_note') }}" placeholder="{{ __('Additional note') }}">
            </div>
        </div>
    </div>

    <div class="form-price-section">
        <p class="form-price-section__label">{{ __('Estimated price') }}</p>
        <div class="form-price-row form-price-row--3">
            <div class="form-group">
                <label for="price_usd">{{ __('USD') }} ($)</label>
                <input type="text" class="form-control" id="price_usd" name="price_usd" value="{{ $value('price_usd') }}" placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="price_pound">{{ __('GBP') }} (&pound;)</label>
                <input type="text" class="form-control" id="price_pound" name="price_pound" value="{{ $value('price_pound') }}" placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="price_eur">{{ __('EUR') }} (&euro;)</label>
                <input type="text" class="form-control" id="price_eur" name="price_eur" value="{{ $value('price_eur') }}" placeholder="0.00">
            </div>
        </div>
    </div>

    <div class="form-price-row form-price-row--full">
        <div class="form-group mb-0">
            <label for="price_notes">{{ __('Price notes') }}</label>
            <input type="text" class="form-control" id="price_notes" name="price_notes" value="{{ $value('price_notes') }}" placeholder="{{ __('Internal price notes') }}">
        </div>
    </div>
</div>

<div class="form-options-panel">
    <div class="form-options-grid">
        <div class="form-option-group">
            <span class="form-option-group__label">{{ __('All Collection') }}</span>
            <div class="form-option-group__choices">
                <label class="form-option-choice">
                    <input type="radio" name="is_allcollection" class="flat-green" value="1"
                        {{ $item ? ($checked('is_allcollection', 1) ? 'checked' : '') : '' }}/>
                    <span>{{ __('Yes') }}</span>
                </label>
                <label class="form-option-choice">
                    <input type="radio" name="is_allcollection" class="flat-green" value="0"
                        {{ $item ? ($checked('is_allcollection', 0) ? 'checked' : '') : 'checked' }}/>
                    <span>{{ __('No') }}</span>
                </label>
            </div>
        </div>

        <div class="form-option-group">
            <span class="form-option-group__label">{{ __('Is Active?') }}</span>
            <div class="form-option-group__choices">
                <label class="form-option-choice">
                    <input type="radio" name="is_active" class="flat-green" value="1"
                        {{ $item ? ($checked('is_active', 1) ? 'checked' : '') : '' }}/>
                    <span>{{ __('Yes') }}</span>
                </label>
                <label class="form-option-choice">
                    <input type="radio" name="is_active" class="flat-green" value="0"
                        {{ $item ? ($checked('is_active', 0) ? 'checked' : '') : 'checked' }}/>
                    <span>{{ __('No') }}</span>
                </label>
            </div>
        </div>

        <div class="form-option-group">
            <span class="form-option-group__label">{{ __('Available') }}</span>
            <div class="form-option-group__choices">
                <label class="form-option-choice">
                    <input type="radio" name="is_available" class="flat-green" value="1"
                        {{ $item ? ($checked('is_available', 1) ? 'checked' : '') : 'checked' }}/>
                    <span>{{ __('Yes') }}</span>
                </label>
                <label class="form-option-choice">
                    <input type="radio" name="is_available" class="flat-green" value="0"
                        {{ $item ? ($checked('is_available', 0) ? 'checked' : '') : '' }}/>
                    <span>{{ __('No') }}</span>
                </label>
            </div>
        </div>
    </div>
</div>
