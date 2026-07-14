@php
    $diamondRows = \App\Services\ItemJewelInfoService::displayDiamondRows($item);
    $gemRows = \App\Services\ItemJewelInfoService::displayGemRows($item);
    $cartGemDefaults = \App\Services\ItemJewelInfoService::firstGemRowForCart($item);
@endphp

<div class="modal-dialog modal-lg modal-dialog-centered frontend-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Hi, :name', ['name' => Auth()->user()->f_name]) }}</h5>
            <a href="{{ URL::to('/pdf-print') }}/{{ $item->id }}" item-id="" class="close print" title="{{ __('Print') }}"><i class="fa fa-print" aria-hidden="true"></i></a>
            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">&times;</button>
        </div>
        <div class="modal-body">
            <div class="product-details-inner catalogue-qv">
                {{-- Hidden gem defaults for add-to-cart (shown as read-only Gem Info) --}}
                <input type="hidden" id="gem" name="gem" value="{{ $cartGemDefaults['gem'] ?? $item->gem }}">
                <input type="hidden" id="shape" name="shape" value="{{ $cartGemDefaults['shape'] ?? $item->shape }}">
                <input type="hidden" id="carat" name="carat" value="{{ $cartGemDefaults['carat'] ?? $item->carat }}">
                <input type="hidden" id="colour" name="colour" value="{{ $cartGemDefaults['colour'] ?? $item->colour }}">
                <input type="hidden" id="cleaerty" name="cleaerty" value="{{ $cartGemDefaults['cleaerty'] ?? $item->cleaerty }}">
                <input type="hidden" id="pcs" name="pcs" value="{{ $cartGemDefaults['pcs'] ?? $item->pcs }}">

                <div class="row catalogue-qv__layout">
                    {{-- Left: image + order fields --}}
                    <div class="col-12 col-lg-5 catalogue-qv__media">
                        <div class="product-large-slider">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset($item->photo) }}" alt="{{ $item->item_title }}">
                                    </div>
                                    @if(!is_null($item->photo_2))
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset($item->photo_2) }}" alt="{{ $item->item_title }}">
                                    </div>
                                    @endif
                                    @if(!is_null($item->photo_3))
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset($item->photo_3) }}" alt="{{ $item->item_title }}">
                                    </div>
                                    @endif
                                    @if(!is_null($item->photo_4))
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset($item->photo_4) }}" alt="{{ $item->item_title }}">
                                    </div>
                                    @endif
                                </div>
                                <div class="catalogue-qv__sku-row">
                                    <strong class="catalogue-qv__sku">{{ $item->sku }}</strong>
                                    <ol class="carousel-indicators catalogue-qv__dots">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        @if(!is_null($item->photo_2))
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        @endif
                                        @if(!is_null($item->photo_3))
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        @endif
                                        @if(!is_null($item->photo_4))
                                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="catalogue-qv__order-fields">
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="metal_type">{{ __('Metal') }}</label>
                                {!! Form::select('metal_type', $metalType ?? [], $item->metal_type ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'metal_type']) !!}
                            </div>
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="metal_colour">{{ __('Colour') }}</label>
                                {!! Form::select('metal_colour', $metalColour ?? [], $item->metal_colour ?? '', ['class' => 'form-control', 'data-control' => 'select2', 'id' => 'metal_colour']) !!}
                            </div>
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="weight">{{ __('Weight') }}</label>
                                <input type="text" class="form-control" id="weight" name="weight" value="{{ $item->weight }}" placeholder="{{ __('Weight') }}">
                            </div>
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="size">{{ __('Size') }}</label>
                                <input type="text" class="form-control" id="size" name="size" value="{{ $item->size }}" placeholder="{{ __('Size') }}">
                            </div>
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="item-qty">{{ __('Qty') }}</label>
                                <div class="catalogue-qv__qty">
                                    <input class="form-control" name="qty" type="text" id="item-qty" value="1">
                                    <button type="button" class="catalogue-qv__qty-btn fa-plus-circle" aria-label="{{ __('Increase quantity') }}">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="catalogue-qv__field">
                                <label class="catalogue-qv__label" for="ref">{{ __('Ref') }}</label>
                                <input type="text" class="form-control" name="reference" id="ref" placeholder="{{ __('Reference') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Right: title, specs, notes --}}
                    <div class="col-12 col-lg-7 catalogue-qv__info">
                        <div class="product-details-des">
                            <h3 class="product-name catalogue-qv__title">{{ $item->item_title }}</h3>
                            @if(!empty($item->description))
                                <p class="pro-desc catalogue-qv__desc">{{ $item->description }}</p>
                            @endif

                            @if(!empty($diamondRows) || !empty($gemRows))
                                <div class="catalogue-jewel-specs">
                                    @include('frontend.catalogue.partials.jewel-info-list', [
                                        'title' => __('Diamond Info'),
                                        'rows' => $diamondRows,
                                        'fields' => [
                                            'Shape' => 'shape',
                                            'Carat' => 'carat',
                                            'Pcs' => 'pcs',
                                            'Colour' => 'colour',
                                            'Cleaerty' => 'cleaerty',
                                        ],
                                    ])
                                    @include('frontend.catalogue.partials.jewel-info-list', [
                                        'title' => __('Gem Info'),
                                        'rows' => $gemRows,
                                        'fields' => [
                                            'Gem' => 'gem',
                                            'Shape' => 'shape',
                                            'Carat' => 'carat',
                                            'Colour' => 'colour',
                                            'Cleaerty' => 'cleaerty',
                                            'Pcs' => 'pcs',
                                        ],
                                    ])
                                </div>
                            @endif

                            <div class="catalogue-qv__notes">
                                <label class="catalogue-qv__label" for="notes">{{ __('Notes') }}</label>
                                <textarea class="form-control" id="notes" name="notes" placeholder="{{ __('Notes') }}" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="catalogue-qv__actions">
                    @if(!is_null($item->price_usd) || !is_null($item->price_pound) || !is_null($item->price_eur))
                    <a class="btn btn-cart catalogue-qv__btn ask_for_price" item-id="{{ $item->id }}" href="javascript:void(0)">
                        <strong>{{ __('Ask for Price') }}</strong>
                    </a>
                    @endif
                    <a class="btn btn-cart catalogue-qv__btn add-to-cart" item-id="{{ $item->id }}" href="javascript:void(0)">
                        <strong>{{ __('Add to cart') }}</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".fa-minus-circle").click(function () {
        var qty = $('#item-qty').val();
        if (qty > 1) {
            $('#item-qty').val(parseInt(qty) - 1);
        }
    });

    $(".print").click(function () {
        var itemId = $(this).attr('item-id');
    });

    $(".fa-plus-circle").click(function () {
        var qty = $('#item-qty').val();
        $('#item-qty').val(parseInt(qty) + 1);
    });

    $('.favorite').on('click', function () {
        var itemId = $(this).attr('data-id');
        $.ajax({
            url: 'favorite',
            data: {'item_id': itemId, '_token': "{{ csrf_token() }}"},
            dataType: 'json',
            type: 'POST',
            success: function () {
                location.reload(true);
            },
            error: function () {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
        });
    });

    $('.unfavorite').on('click', function () {
        var itemId = $(this).attr('data-id');
        $.ajax({
            url: 'unfavorite',
            data: {'item_id': itemId, '_token': "{{ csrf_token() }}"},
            dataType: 'json',
            type: 'POST',
            success: function () {
                location.reload(true);
            },
            error: function () {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
        });
    });
</script>
