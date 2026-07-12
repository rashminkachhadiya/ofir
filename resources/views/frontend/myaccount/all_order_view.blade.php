@extends('frontend.layouts.master_catalogue')
@foreach($orders as $order)
<div class="modal-body">
<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card order-list-card">
                <div class="card-body">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <div>
                            <h5><strong>{{ __('Order Details') }}</strong></h5>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-4 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Order Date') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Order Number') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Code') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->sku }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Order By') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->f_name }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Email') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Order Status') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ config('params.order_status')[$order->order_status] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Ref') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->ref }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Customer Notes') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Category') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    @if($order->sub_category_id !== null && isset(config('params.'.$order->category_id)[$order->sub_category_id]))
                                    {{ config('params.'.$order->category_id)[$order->sub_category_id] }}
                                    @else
                                        {{ config('params.categories')[$order->category_id] ?? '' }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Metal Type') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    @if(!is_null($order->metal_type))
                                    {{ config('params.metal_type')[$order->metal_type] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Metal Colour') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    @if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Size') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->size }}
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Weight') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->weight }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Quantity') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->quantity }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Est Price') }} : </strong></p>
                                </div>
                                @if(!is_null($order->est_price_currency))
                                <div class="col-md-6">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ number_format((float) $order->est_price, 2, '.', '') }}
                                </div>
                                @endif
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Total Est Price') }}</strong></p>
                                </div>
                                @if(!is_null($order->est_price_currency))
                                <div class="col-md-6">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ $order->tot_est_price }}
                                </div>
                                @endif
                            </div>
                            @if(!is_null($order->admin_notes))
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong>{{ __('Admin Notes') }} : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->admin_notes }}
                                </div>
                            </div>
                            @endif   
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">{{ __('Gem Info') }}</h5>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Gem') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->gem }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Shape') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->shape }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Carat') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->carat }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Colour') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->colour }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Cleaerty') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->cleaerty }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6 text-center">
                                    <p><strong>{{ __('Pcs') }} : </strong></p>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->pcs }}
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
</div>
<div style="border:1px solid black;">
    
</div>
@endforeach
