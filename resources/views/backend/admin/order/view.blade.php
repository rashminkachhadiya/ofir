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
                                    {{ $order->orderUser->f_name }}
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
                                    @if(!is_null($order->metal_type))
                                    {{ config('params.metal_type')[$order->metal_type] }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-3">
                                    <p><strong> Metal Colour : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    @if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
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
                                    <p><strong> Cleaerty : </strong></p>
                                </div>
                                <div class="col-md-9">
                                    {{ $order->cleaerty }}
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
                                <img width="170px;" height="170px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                            </div>
                        @endforeach
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