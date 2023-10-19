<form id='editSupplier' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
      <input type="hidden" name="id" value="{{$order->id}}">
<div class="product-details-inner">
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
                    {{ config('params.categories')[$order->category_id] }}
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
            <div class="d-flex p-0 mt-3">
                <div class="col-md-4 p-0">
                    <strong> Receive : </strong>
                </div>
                <div class="col-md-8">
                    <input style="width:30px; height:23px;" class="" type="checkbox" value="1" name="receive_supplier" {{ ($order->receive_supplier == 1) ? 'checked' : ''}}/>
                </div>
            </div>
        </div>
        <div class="col-md-4 pl-2">
            <div class="d-flex p-0">
                <div class="col-md-3 p-0">
                    <strong> Type : </strong>
                </div>
                <div class="col-md-9 p-0">
                   {!! Form::select('su_metal_type', config('params.metal_type') ?? [],  $order->su_metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                </div>
            </div>
            <div class="d-flex p-0 mt-1">
                <div class="col-md-3 p-0">
                    <strong>Colour : </strong>
                </div>
                <div class="col-md-9 p-0">
                    {!! Form::select('su_metal_colour', config('params.metal_colour') ?? [],  $order->su_metal_colour ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                </div>
            </div>
            <div class="d-flex p-0 mt-1">
                <div class="col-md-3 p-0">
                    <strong> Size : </strong>
                </div>
                <div class="col-md-9 p-0">
                    <input type="text" class="form-control" id="size" name="su_size" value="{{ $order->su_size }}" placeholder="Size">
                </div>
            </div>
            <div class="d-flex p-0 mt-1">
                <div class="col-md-3 p-0">
                    <strong> Weight : </strong>
                </div>
                <div class="col-md-3 p-0">
                    <input type="text" class="form-control" id="su_weight" name="su_weight" value="{{ $order->su_weight }}" placeholder="Weight">
                </div>
                <div class="col-md-3 p-0">
                    <input type="text" class="form-control" id="su_est_price" name="su_est_price" value="{{ $order->su_est_price }}" placeholder="Est Price">
                </div>
                <div class="col-md-3 p-0">
                    <input type="text" class="form-control" id="su_tot_est_price" name="su_tot_est_price" value="{{ $order->su_tot_est_price }}" placeholder="Totol" readonly>
                </div>
            </div>
            <div class="d-flex p-0 mt-1">
                <div class="col-md-3 p-0">
                    <strong> Qty : </strong>
                </div>
                <div class="col-md-9 p-0">
                    <input type="text" class="form-control" id="su_quantity" name="su_quantity" value="{{ $order->su_quantity }}" placeholder="Quantity">
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0" style="border:1px solid black;height: 90px !important;">
            <div class="d-flex p-0">
                <div class="col-md-1 pr-0">
                    <p><strong> Notes </strong></p>
                </div>
                <div class="col-md-11 p-0" style="text-align: left;">
                     <textarea type="text" class="form-control" id="notes" name="su_admin_notes" placeholder="Admin Notes" rows="3">{{ $order->su_admin_notes }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="border:1px solid black;">
        <h5 class="text-center">Gem Info</h5>
        <div class="d-flex p-0">
            <div class="col-md-3">
                <strong> Gem. </strong>
            </div>
            <div class="col-md-6 p-0 text-left">
                <input type="text" class="form-control" id="gem" name="su_gem" value="{{ $order->su_gem }}" placeholder="Gem">
            </div>
        </div>
        <div class="d-flex p-0 mt-1">
            <div class="col-md-3">
                <strong> Shape </strong>
            </div>
            <div class="col-md-6 p-0 text-left">
                <input type="text" class="form-control" id="shape" name="su_shape" value="{{ $order->su_shape }}" placeholder="Shape">
            </div>
        </div>
        <div class="d-flex p-0 mt-1">
            <div class="col-md-3">
                <strong> Carat </strong>
            </div>
            <div class="col-md-3 p-0 text-left">
                <input type="text" class="form-control" id="su_carat" name="su_carat" value="{{ $order->su_carat }}" placeholder="Carat">
            </div>
            <div class="col-md-3 p-0 text-left">
                <input type="text" class="form-control" id="su_carat_price" name="su_carat_price" value="{{ $order->su_carat_price }}" placeholder="Price">
            </div>
            <div class="col-md-3 p-0 text-left">
                <input type="text" class="form-control" id="tot_su_carat_price" name="tot_su_carat_price" value="{{ $order->tot_su_carat_price }}" placeholder="Total" readonly>
            </div>
        </div>
        <div class="d-flex p-0 mt-1">
            <div class="col-md-3">
                <strong> Colour </strong>
            </div>
            <div class="col-md-6 p-0 text-left">
                <input type="text" class="form-control" id="colour" name="su_gem_colour" value="{{ $order->su_gem_colour }}" placeholder="Colour">
            </div>
        </div>
        <div class="d-flex p-0 mt-1">
            <div class="col-md-3">
                <strong> Cleaerty </strong>
            </div>
            <div class="col-md-6 p-0 text-left">
                <input type="text" class="form-control" id="cleaerty" name="su_cleaerty" value="{{ $order->su_cleaerty }}" placeholder="Cleaerty">
            </div>
        </div>
        <div class="d-flex p-0 mt-1">
            <div class="col-md-3">
                <strong> Pcs </strong>
            </div>
            <div class="col-md-6 p-0 text-left">
                <input type="text" class="form-control" id="pcs" name="su_pcs" value="{{ $order->su_pcs }}" placeholder="Pcs">
            </div>
        </div>
    </div>
    </div>
<hr>
<div class="clearfix"></div>
    <div class="col-md-12 mb-3 mt-3">
        <button type="submit" class="btn btn-success button-submit"
                data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
        </button>
    </div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("focusout", "#su_weight, #su_est_price", function(e) {
            e.preventDefault();
            var totalPrice = parseFloat($("#su_weight").val()) * parseFloat($("#su_est_price").val());
            $("#su_tot_est_price").val(totalPrice.toFixed(2));
        });

        $(document).on("focusout", "#su_carat, #su_carat_price", function(e) {
            e.preventDefault();
            var totalPrice = parseFloat($("#su_carat").val()) * parseFloat($("#su_carat_price").val());
            $("#tot_su_carat_price").val(totalPrice.toFixed(2));
        });

        $('#editSupplier').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                
            },
            // Messages for form validation
            messages: {
                
            },
            submitHandler: function (form) {

                

                var myData = new FormData($("#editSupplier")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);


                $.ajax({
                    url: '{{ url("admin/receive-supplier-save") }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        if (data.type === 'success') {
                            swal("Done!", "It was succesfully done!", "success");
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

            }
            // <- end 'submitHandler' callback
        });
    });
</script>