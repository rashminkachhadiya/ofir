@extends('backend.layouts.master')
@section('title', __('Order Details'))
@section('content')
    <x-admin.page-header title="{{ __('View Order Details') }}" icon="cart">
        <x-slot name="actions">
            <a href="{{ URL::to('admin/order/' . $order->id . '/edit') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card order-detail-card">
                <div class="order-nav px-3 pt-3">
                    <a href="{{ URL::to('admin/order/') }}/{{ $preOrder }}" aria-label="{{ __('Previous order') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
                    </a>
                    <a href="{{ URL::to('admin/order/') }}/{{ $nextOrder }}" aria-label="{{ __('Next order') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM281 385c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l71-71L136 280c-13.3 0-24-10.7-24-24s10.7-24 24-24l182.1 0-71-71c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L393 239c9.4 9.4 9.4 24.6 0 33.9L281 385z"/></svg>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="product-large-slider">
                                    <div id="carouselExampleIndicators" class="carousel slide order-carousel" data-ride="carousel">
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
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex">
                                <div class="col-md-4 p-0">
                                    <strong>{{ __('Date') }}:</strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Order No: </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Order By : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->orderUser->f_name }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Email : </strong>
                                </div>
                                <div class="col-md-8 p-0" style="word-wrap: break-word;">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Ref. : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->ref }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Category : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    @if($order->sub_category_id !== null && isset(config('params.'.$order->category_id)[$order->sub_category_id]))
                                    {{ config('params.'.$order->category_id)[$order->sub_category_id] }}
                                    @else
                                        {{ config('params.categories')[$order->category_id] ?? '' }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Status : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ config('params.order_status')[$order->order_status] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Supplier : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                   @if(!is_null($order->supplier_name))
                                    {{ $supplier[$order->supplier_name] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Type : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    @if(!is_null($order->metal_type))
                                    {{ config('params.metal_type')[$order->metal_type] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong>Colour : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    @if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Size : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->size }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Weight : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->weight }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Qty : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ $order->quantity }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Est Price : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ number_format((float) $order->est_price, 2, '.', '') }}
                                </div>
                            </div><div class="d-flex p-0">
                                <div class="col-md-4 p-0">
                                    <strong> Total Est Price : </strong>
                                </div>
                                <div class="col-md-8 p-0">
                                    {{ config('params.currency')[$order->est_price_currency] }}{{ $order->tot_est_price }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="notes-box">
                                <strong>{{ __('Customer Notes') }}</strong>
                                <p class="mb-0 mt-2">{{ $order->notes }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="notes-box">
                                <strong>{{ __('Admin Notes') }}</strong>
                                <p class="mb-0 mt-2">{{ $order->admin_notes }}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <div class="gem-info-panel">
                            <h5 class="text-center">{{ __('Gem Info') }}</h5>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Gem. : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->gem }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Shape : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->shape }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Carat : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->carat }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Colour : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->colour }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Cleaerty : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->cleaerty }}
                                </div>
                            </div>
                            <div class="d-flex p-0">
                                <div class="col-md-6">
                                    <strong> Pcs : </strong>
                                </div>
                                <div class="col-md-6 text-left">
                                    {{ $order->pcs }}
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop