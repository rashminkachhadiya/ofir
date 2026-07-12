<div class="modal-view-shell product-details-inner">
    <div class="row">
        <div class="col-md-9 row">
            <div class="col-md-4">
                <div class="product-large-slider">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        @php
                        $count = 0;
                        @endphp
                        @foreach($order->orderPicture as $image)
                        @if($count == 0)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('assets/images/users/order/').'/'.$image->images}}" alt="Second slide">
                        </div>

                        @else
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('assets/images/users/order/').'/'.$image->images}}" alt="Second slide">
                        </div>
                        @endif
                        @php
                        $count++;
                        @endphp
                        @endforeach
                    </div>
                    <div>
                        <div>
                            <strong>{{ $order->sku }}</strong>
                        </div>
                        <div>
                            <ol class="carousel-indicators">
                                @php
                                $countOl = 0;
                                @endphp
                                @foreach($order->orderPicture as $image)
                                @if($countOl == 0)
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @else
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $countOl }}"></li>
                                @endif
                                @php
                                $countOl++;
                                @endphp
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="d-flex">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Date') }}: </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Order No') }}: </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->order_number }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Order By') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->orderUser->f_name }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Email') }} : </strong>
                </div>
                <div class="col-md-8 p-0" style="word-wrap: break-word;">
                    {{ $order->orderUser->email }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Ref') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->ref }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Category') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ config('params.categories')[$order->category_id] }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Status') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ config('params.order_status')[$order->order_status] }}
                </div>
            </div>
        </div>
        <div class="col-md-4 pl-2">
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Type') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    @if(!is_null($order->metal_type))
                    {{ config('params.metal_type')[$order->metal_type] }}
                    @endif
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Colour') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    @if(!is_null($order->metal_colour))
                    {{ config('params.metal_colour')[$order->metal_colour] }}
                    @endif
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Size') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->size }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Weight') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->weight }}
                </div>
            </div>
            <div class="d-flex p-0">
                <div class="col-md-4 p-0">
                    <strong>{{ __('Qty') }} : </strong>
                </div>
                <div class="col-md-8 p-0">
                    {{ $order->quantity }}
                </div>
            </div>
        </div>
        <div class="col-md-12 p-0 order-notes-panel">
            <div class="d-flex p-0">
                <div class="col-md-2 pr-0">
                    <p><strong>{{ __('Notes') }} : </strong></p>
                </div>
                <div class="col-md-10 p-0" style="text-align: left;">
                    {{ $order->notes }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 gem-info-panel">
        <h5 class="text-center">{{ __('Gem Info') }}</h5>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Gem') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->gem }}
            </div>
        </div>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Shape') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->shape }}
            </div>
        </div>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Carat') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->carat }}
            </div>
        </div>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Colour') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->colour }}
            </div>
        </div>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Cleaerty') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->cleaerty }}
            </div>
        </div>
        <div class="d-flex p-0">
            <div class="col-md-6">
                <strong>{{ __('Pcs') }} : </strong>
            </div>
            <div class="col-md-6 text-left">
                {{ $order->pcs }}
            </div>
        </div>
    </div>
    </div>
<hr>

</div>
