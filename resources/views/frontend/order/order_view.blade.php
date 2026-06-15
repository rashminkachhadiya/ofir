<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <div>
                            <h5><strong>{{ __('Order Details') }}</strong></h5>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Order Number') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Order By') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->orderUser->name }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Email') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Order Status') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.order_status')[$order->order_status] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Category') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.categories')[$order->category_id] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Metal Type') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.metal_type')[$order->metal_type] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Metal Colour') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Size') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->size }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong>{{ __('Quantity') }} : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->quantity }}
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        @foreach($order->orderPicture as $image)
                            <div class="col-md-2 mt-2">
                                <img width="170px;" height="170px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
