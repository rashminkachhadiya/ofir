@extends('backend.layouts.master')
@section('title', ' Order Item')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card" style="background: #f6f5f3;">
                <div style="display: flex;justify-content: space-between;">
                    <div>
                        <a class="m-2 mt-0" style="font-size: 25px;cursor: pointer;" href="{{ URL::to('admin/order/') }}/{{$preOrder}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg></a>
                    </div>
                    <div>
                        <a class="m-2 mt-0" style="font-size: 25px;cursor: pointer;" href="{{ URL::to('admin/order/') }}/{{$nextOrder}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM281 385c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l71-71L136 280c-13.3 0-24-10.7-24-24s10.7-24 24-24l182.1 0-71-71c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L393 239c9.4 9.4 9.4 24.6 0 33.9L281 385z"/></svg></a>
                    </div>
                </div>
                <div class="card-body" style="color: black;">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <div>
                            <h5><strong> View Details </strong></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 row">
                            <div class="col-md-4">
                                <div class="product-large-slider">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                      <div style="border: 1px solid black;" class="carousel-inner">
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
                                    <strong>Date: </strong>
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
                        <div class="col-md-4 pl-2">
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
                        <div class="col-md-6 p-0" style="border:1px solid black;height: 90px !important;">
                            <div class="d-flex p-0">
                                <div class="col-md-2 pr-0">
                                    <p><strong> Customer Notes : </strong></p>
                                </div>
                                <div class="col-md-10 p-0" style="text-align: left;">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-0" style="border:1px solid black;height: 90px !important;">
                            <div class="d-flex p-0">
                                <div class="col-md-2 pr-0">
                                    <p><strong> Admin Notes : </strong></p>
                                </div>
                                <div class="col-md-10 p-0" style="text-align: left;">
                                    {{ $order->admin_notes }}
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3" style="border:1px solid black;">
                            <h5 class="text-center">Gem Info</h5>
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
    <style>
        @media screen and (min-width: 768px) {
            #myModal .modal-dialog {
                width: 85%;
                border-radius: 5px;
            }
        }
    </style>
    <script>

            
    </script>
    <script type="text/javascript">
        function create() {
            ajax_submit_create('categories');
        }

        $(document).ready(function () {
            // View Form
            $("#manage_all").on("click", ".view", function () {
                var id = $(this).attr('id');
                ajax_submit_view('categories', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function () {
                var id = $(this).attr('id');
                ajax_submit_edit('categories', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function () {
                var id = $(this).attr('id');
                ajax_submit_delete('categories', id)
            });

        });

    </script>
@stop