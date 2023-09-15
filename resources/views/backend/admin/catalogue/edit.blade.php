@extends('backend.layouts.master')
@section('title', ' Product Details')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card card mb-3">
                <div class="card-body">
                    <!-- Tabs navs -->
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="link-tab-product-details" data-mdb-toggle="tab" href-div="tab-product-details" role="tab" aria-controls="ex1-tabs-1" aria-selected="true" >Product Details</a>
                      </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                      <div class="tab-pane fade show active" id="tab-product-details" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <form id='edit' action="" enctype="multipart/form-data" method="" accept-charset="utf-8" class="needs-validation"
                          novalidate>
                          {{method_field('PUT')}}
                            <div class="form-row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div id="status"></div>
                                <br/>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Catalogue </label>
                                        {!! Form::select('catalogue_id', $catalogues ?? [],  $item->catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'catalogue_id']) !!}
                                        <span id="error_email" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="">Sub Catalogue </label>
                                        {!! Form::select('sub_catalogue_id', $subCatalogue ?? [],  $item->sub_catalogue_id ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'sub_catalogue_id']) !!}
                                        <span id="error_email" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title </label>
                                        <input type="text" class="form-control" id="item_title" name="item_title" value="{{ $item->item_title }}" placeholder="" required>
                                        <span id="error_item_title" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Description </label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}" placeholder="">
                                        <span id="error_description" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <img id="preview-1" src="{{ asset($item->photo) }}" alt="" style="width: 105px; height: 100px;">
                                    </div>
                                    <div class="mt-1 form-group col-md-12 col-sm-12" style="width: 200px;">
                                        <input id="photo-1" type="file" accept="image/*" class="form-control" name="photo_1" onchange="showImage(1)">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> All Collection </label><br/>
                                        <input type="radio" name="is_allcollection" class="flat-green" value="1" {{ ( $item->is_allcollection == 1 ) ? 'checked' : '' }}/> Yes
                                        <input type="radio" name="is_allcollection" class="flat-green" value="0" {{ ( $item->is_allcollection == 0 ) ? 'checked' : '' }}/> No
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Available </label><br/>
                                        <input type="radio" name="is_available" class="flat-green"value="1" {{ ( $item->is_available == 1 ) ? 'checked' : '' }}/> Yes
                                        <input type="radio" name="is_available" class="flat-green"value="0" {{ ( $item->is_available == 0 ) ? 'checked' : '' }}/> No
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-success button-submit"
                                            data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="tab-size-stock" role="tabpanel" aria-labelledby="ex1-tab-2">
                        
                      </div>
                    </div>
                    <!-- Tabs content -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    function showImage(imgNumber) {
        const imageUploader = document.querySelector("#photo-"+imgNumber);
        const imagePreview = document.querySelector("#preview-"+imgNumber);
      let reader = new FileReader();
     reader.readAsDataURL(imageUploader.files[0]);
      reader.onload = function(e) {
        imagePreview.classList.add("show");
        imagePreview.src = e.target.result;
      };
    }
     let number_of_image = 1;
</script>
<script type="text/javascript">
    
    $(document).ready(function () {
         $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
        });
        $('input[type="radio"].flat-green').iCheck({
            radioClass: 'iradio_flat-green'
        });
        $('body').on('click', '.nav-link', function(event) {
            id = $('#id').val();
            var htmlDivId = $(this).attr('href-div');
            var route = 'catelogues';
            var refreashUrl = 'edit?tab='+htmlDivId;
            $.ajax({
                type: "GET",
                url: refreashUrl,
                datatype: 'html',
                success: function (data) {
                    if($('#'+htmlDivId).length > 0)
                    {
                        $('.tab-pane').removeClass("show active");
                        $('.nav-link').removeClass("active");
                        $('#link-'+ htmlDivId).addClass("active");
                        $('#'+htmlDivId).addClass("show active");
                        $('#'+htmlDivId).html(data.html);
                    }
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

        $('body').on('click','#id-remove-image',function(event) {
            id = $(this).attr('data-id');
            // alert(id);
            $('#preview-'+id).attr('src', '');
            // $('#photo-'+id).attr('value','');
            $.ajax({
                type: "GET",
                url: '{{ url("admin/remove-photo") }}?item_id='+'{{ $item->id }}'+'&photo_id='+id,
                datatype: 'html',
                success: function (data) {
                    
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        });

        let add_number = 1;
        $("body").on("click", ".add", function (e) {
            $("#catelogue_size").append(
                '<div class="row mt-1 item_size-'+ add_number +'">\
                    <div class="col-md-4">\
                      <input type="text" name="new_size['+ add_number +']" class="form-control" id="size_'+ add_number +'" value="" placeholder="Size">\
                    </div>\
                    <div class="col-md-4">\
                      <input type="number" name="new_stock['+ add_number +']" class="form-control" id="new_stock-'+ add_number +'" value="" placeholder="Quantity">\
                    </div>\
                    <div class="col-md-1">\
                        <a class="btn btn-danger remove" data-id="'+ add_number +'" style="color: white;">\
                            <i class="fa fa-minus" aria-hidden="true"></i>\
                        </a>\
                    </div>\
                </div>'
            );
            add_number++;
        });

        $("body").on("click", ".remove", function (e) {
            let id = $(this).attr('data-id');
            $(".item_size-" + id).remove();
            add_number--;
        });

        $("body").on("click", "#add_more", function (e) {
            $("#append_image").append(
                '<div class="col-md-12 input-group"><div class="col-md-2"><input type="radio" name="is_main_image" class="form-control-sm" value="'+ number_of_image +'"></div><div class="col-md-6"><input id="photo-'+ number_of_image +'" type="file" accept="image/*" class="form-control" name="new_photo['+ number_of_image +']" onchange="showImage('+ number_of_image +')"></div><div class="col-md-4"><img id="preview-'+ number_of_image +'" src="" alt="" style="width: 100px; height: 100px;"></div></div>'
            );
            number_of_image++;
        });

        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
        });

        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                category_id: {
                    required: true
                },
                item_title : {
                    required: true
                },
                item_code: {
                    required: true
                },
                item_description: {
                    required: true
                },
                supplier_name: {
                    required: true
                },
                supplier_code: {
                    required: true
                },
                gold_price: {
                    required: true
                },
                stone_price: {
                    required: true
                },
                labour_cost: {
                    required: true
                },
                duty_and_extra: {
                    required: true
                },
                total_cost: {
                    required: true
                },
                profit_trade: {
                    required: true
                },
                profit_retail: {
                    required: true
                },
                total_trade: {
                    required: true
                },
                total_retail: {
                    required: true
                },
            },
            // Messages for form validation
            
            submitHandler: function (form) {

                var list_id = [];
                
                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('input[name="csrf_token"]').val();
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', list_id);

                $.ajax({
                        url: '{{ url("admin/catalogue") }}'+'/'+'{{ $item->id }}',
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

        $('body').on('click', '.size_stock', function(event) {
            var list_id = [];
                    
                    var myData = new FormData($("#createSizeStock")[0]);
                    var CSRF_TOKEN = $('input[name="csrf_token"]').val();
                    myData.append('_token', CSRF_TOKEN);
                    myData.append('roles', list_id);

        $.ajax({
                url: '{{ url("admin/catelogue-size") }}',
                type: 'POST',
                data: myData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {

                    if (data.type === 'success') {
                        swal("Done!", "It was succesfully done!", "success");
                        $("#link-tab-size-stock").trigger("click");
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
        });                    // <- end '.validate()'            // <- end '.validate()'

        $(document).on("focusout", "#gold_price, #stone_price, #labour_cost, #duty_and_extra, #profit_trade, #profit_retail", function(e) {
            e.preventDefault();
            var goldPrice = parseFloat($("#gold_price").val()) * parseFloat($("#total_gold_weight").val());
            var stonePrice = parseFloat($("#stone_price").val()) * parseFloat($("#total_ct_weight").val());
            var labourCost = parseFloat($("#labour_cost").val());
            var dutyAndExtra = parseFloat($("#duty_and_extra").val());

            
            var totalCost = (goldPrice != '' ? goldPrice : parseFloat(0))  + (stonePrice != '' ? stonePrice : parseFloat(0)) + (labourCost != '' ? labourCost : parseFloat(0))  + (dutyAndExtra != '' ? dutyAndExtra : parseFloat(0));

            // var totalCost = (parseFloat(goldPrice) != '' ? parseFloat(goldPrice) : parseFloat(0))  + (parseFloat(stonePrice) != '' ? parseFloat(stonePrice) : parseFloat(0)) + (parseFloat(labourPrice) != '' ? parseFloat(labourPrice) : parseFloat(0)) + (parseFloat(dutyAndExtra) != '' ? parseFloat(dutyAndExtra) : parseFloat(0));
            // alert(totalCost);

            console.log()
            $("#total_cost").val(totalCost.toFixed(4));
            var profitTrade = $("#profit_trade").val();
            var profitRetail = $("#profit_retail").val();

            var totalTrade = (totalCost * profitTrade ) / 100;
            var totalRetail = (totalCost * profitRetail ) / 100; 
            
            $("#total_trade").val((totalCost + totalTrade).toFixed(4));
            $("#total_retail").val((totalCost + totalRetail).toFixed(4));
             // alert(totalTrade);
        });

    });
</script>
@endpush