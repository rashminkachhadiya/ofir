<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card" style="background: #f6f5f3 !important;">
                <div class="card-body">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <div>
                            <h5><strong> Order Details </strong></h5>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Order Date : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Order Number : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Code : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->sku }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Order By : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->orderUser->name }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Email : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Order Status : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.order_status')[$order->order_status] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Ref. : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->ref }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Customer Notes : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Category : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ config('params.categories')[$order->category_id] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Metal Type : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    @if($order->metal_type)
                                    {{ config('params.metal_type')[$order->metal_type] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Size : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->size }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Weight : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->weight }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Gem. : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->gem }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Shape : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->shape }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Carat : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->carat }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Colour : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->metal_colour }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Cleaerty : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->cleaerty }}
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Quantity : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->quantity }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Est Price : </strong></p>
                                </div>
                                @if(!is_null($order->est_price_currency))
                                <div class="col-md-9">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ number_format((float) $order->est_price, 2, '.', '') }}
                                </div>
                                @endif
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Total Est Price </strong></p>
                                </div>
                                @if(!is_null($order->est_price_currency))
                                <div class="col-md-9">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ $order->tot_est_price }}
                                </div>
                                @endif
                            </div>
                            @if(!is_null($order->admin_notes))
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Admin Notes : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->admin_notes }}
                                </div>
                            </div>
                            @endif   
                        </div>
                    </div>
                    <div class="row">
                        @foreach($order->orderPicture as $image)
                            <div class="col-md-2 mt-2">
                                <img width="170px;" style="border: 1px solid black;" height="170px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>