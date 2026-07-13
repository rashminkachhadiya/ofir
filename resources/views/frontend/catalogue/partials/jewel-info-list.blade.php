@if(!empty($rows))
    <div class="catalogue-jewel-block">
        <h6 class="catalogue-jewel-block__title">{{ $title }}</h6>
        @foreach($rows as $index => $row)
            <div class="catalogue-jewel-entry @if(!$loop->last) catalogue-jewel-entry--spaced @endif">
                @if(count($rows) > 1)
                    <div class="catalogue-jewel-entry__heading">{{ __('Entry') }} {{ $index + 1 }}</div>
                @endif
                <div class="row catalogue-jewel-entry__grid">
                    @foreach($fields as $label => $key)
                        @if(!empty($row[$key]))
                            <div class="col-6 col-md-4 catalogue-jewel-field">
                                <span class="catalogue-jewel-field__label">{{ __($label) }}</span>
                                <span class="catalogue-jewel-field__value">{{ $row[$key] }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif
