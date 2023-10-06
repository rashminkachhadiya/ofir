@extends('backend.layouts.master')
@section('title', ' Order Item')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card" style="background: #f6f5f3;">
                <div class="card-body" style="color: black;">
                    <div class="d-flex mb-3" style="justify-content: space-between;">
                        <div>
                            <h5><strong> Order Details </strong></h5>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-4 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Date : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Number : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Code : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->sku }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order By : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->f_name }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Email : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->orderUser->email }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Order Status : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ config('params.order_status')[$order->order_status] }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Ref. : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->ref }}
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Customer Notes : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="d-flex">
                                <div class="col-md-6">
                                    <p><strong> Category : </strong></p>
                                </div>
                                <div class="col-md-6">
                                    {{ config('params.categories')[$order->category_id] }}
                                </div>
                            </div>
                            <form id='edit-tab' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
                            novalidate>
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Supplier Name : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('supplier_name', $supplier ?? [],  $order->supplier_name ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'supplier_name']) !!}
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Metal Type : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('metal_type', $metalType ?? [],  $order->metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Size : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="size" name="size" value="{{ $order->size }}" placeholder="Size" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Weight : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="weight" name="weight" value="{{ $order->weight }}" placeholder="Weight" required>
                                    </div>
                                </div>
                                
                                
                                <div class="d-flex mt-1">
                                    <div class="col-md-3 pr-0">
                                        <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" placeholder="Quantity">
                                    </div>
                                    <div class="col-md-3 pr-0">
                                        {!! Form::select('est_currency', $currency ?? [],  $order->est_price_currency ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'est_currency']) !!}
                                    </div>
                                    <div class="col-md-3 pr-0">
                                        <input type="text" class="form-control" id="est_price" name="est_price" value="{{ $order->est_price }}" placeholder="Est Price">
                                    </div>
                                    <div class="col-md-6 ">
                                        <input type="text" class="form-control" id="tot_est_price" name="tot_est_price" value="{{ $order->tot_est_price }}" placeholder="Totol" readonly>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong>Admin Notes : </strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control" id="notes" name="admin_notes" placeholder="Admin Notes" rows="3" required="false">{{ $order->admin_notes }}</textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-4 p-1 pb-4 text-center">
                                        <h5 class="text-center">Gem Info</h5>
                                        <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Gem. : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="gem" name="gem" value="{{ $order->gem }}" placeholder="Gem" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Shape : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="shape" name="shape" value="{{ $order->shape }}" placeholder="Shape" required>
                                    </div>
                                </div><div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Carat : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="carat" name="carat" value="{{ $order->carat }}" placeholder="Carat" required>
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Colour : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="colour" name="gem_colour" value="{{ $order->metal_colour }}" placeholder="Colour">
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="col-md-6">
                                        <p><strong> Cleaerty : </strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="cleaerty" name="cleaerty" value="{{ $order->cleaerty }}" placeholder="Cleaerty" required>
                                    </div>
                                </div>
                                <div class="float-right mt-2">
                                    <button type="button" class="btn btn-success update-submit"
                                                data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
                                        </button>
                                </div>
                                    </div>
                        </form> 

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

        $(document).on("focusout", "#quantity, #est_price", function(e) {
            e.preventDefault();
            var totalPrice = parseFloat($("#quantity").val()) * parseFloat($("#est_price").val());
            $("#tot_est_price").val(totalPrice.toFixed(2));
        });

        $(document).ready(function () {
            // View Form

            $('body').on('click', '.update-submit', function(event) {
                var list_id = [];
                    var myData = new FormData($("#edit-tab")[0]);
                    var CSRF_TOKEN = $('input[name="csrf_token"]').val();
                    myData.append('_token', CSRF_TOKEN);
                    myData.append('roles', list_id);

                $.ajax({
                        url: '{{ url("admin/update-order") }}',
                        type: 'POST',
                        data: myData,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {

                            if (data.type === 'success') {
                                swal("Done!", "It was succesfully done!", "success");
                                $("#link-tab-images").trigger("click");
                                reload_table();
                                notify_view(data.type, data.message);
                                $('#loader').hide();
                                $("#submit").prop('disabled', false); // disable button
                                $("html, body").animate({scrollTop: 0}, "slow");
                                $('#myModal').modal('hide'); // hide bootstrap modal

                            } else if (data.type === 'error') {
                                if (data.errors) {
                                    $.each(data.errors, function (key, val) {
                                        $('#error_' + key).html(val);
                                    });
                                }
                                $("#status").html(data.message);
                                $('#loader').hide();
                                $("#submit").prop('disabled', false); // disable button
                                swal("Error sending!", "Please try again", "error");

                            }

                        }
                    });     
                });

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