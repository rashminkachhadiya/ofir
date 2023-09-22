@extends('backend.layouts.master')
@section('title', ' Product Details')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card card mb-3">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="link-tab-product-details" data-mdb-toggle="tab" href-div="tab-product-details" role="tab" aria-controls="ex1-tabs-1" aria-selected="true" >Product Details</a>
                      </li>
                    </ul>
                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                      <div class="tab-pane fade show active" id="tab-product-details" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
                        novalidate>
                            <div class="form-row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div id="status"></div>
                                <br/>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Catalogue </label>
                                        {!! Form::select('catalogue_id[]', $catalogues ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'catalogue_id', 'multiple' => 'true']) !!}
                                        <span id="error_email" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="">Sub Catalogue </label>
                                        {!! Form::select('sub_catalogue_id', $subCatalogue ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'sub_catalogue_id']) !!}
                                        <span id="error_email" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Code </label>
                                        <input type="text" class="form-control" id="sku" name="sku" value="" placeholder="" required>
                                        <span id="error_sku" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <img id="preview-1" src="" alt="" style="width: 105px; height: 100px;">
                                    </div>
                                    <div class="mt-1 form-group col-md-12 col-sm-12" style="width: 200px;">
                                        <input id="photo-1" type="file" accept="image/*" class="form-control" name="photo_1" onchange="showImage(1)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title </label>
                                        <input type="text" class="form-control" id="item_title" name="item_title" value="" placeholder="" required>
                                        <span id="error_item_title" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title gram</label>
                                        <input type="text" class="form-control" id="item_title_gram" name="item_title_gram" value="" placeholder="">
                                        <span id="error_item_title_gram" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Description </label>
                                        <input type="text" class="form-control" id="description" name="description" value="" placeholder="">
                                        <span id="error_description" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> All Collection </label><br/>
                                        <input type="radio" name="is_allcollection" class="flat-green" value="1"/> Yes
                                        <input type="radio" name="is_allcollection" class="flat-green" value="0" checked/> No
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Available </label><br/>
                                        <input type="radio" name="is_available" class="flat-green"value="1"/> Yes
                                        <input type="radio" name="is_available" class="flat-green"value="0" checked/> No
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        <label for=""> Size </label>
                                        <input type="text" class="form-control" id="size" name="size" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Metal Colour </label>
                                          {!! Form::select('metal_colour', config('params.metal_colour') ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Metal Type </label>
                                        {!! Form::select('metal_type', config('params.metal_type') ?? [],  $userRoleId ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                    </div>
                                </div>
                                <div id="catelogue_size">
                                    <div class="form-group row">
                                        <div class="col-md-2 pl-2 p-1">
                                          <input type="text" name="new_code[0]" class="form-control" id="new_code-0" value="" placeholder="Code">
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                          <input type="number" name="new_stock[0]" class="form-control" id="new_sotck-0" value="" placeholder="Qty">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <input type="text" name="new_gram[0]" class="form-control" id="new_gram-0" value=""  placeholder="Gram">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <input type="text" name="new_ct[0]" class="form-control" id="new_ct-0" value=""  placeholder="Ct">
                                        </div>
                                            <div class="col-md-2 p-0 p-1">
                                              <select class="form-control" name="new_item_status[0]">
                                                <option value="" >Select option</option>
                                                <option value="0" >Apro</option>
                                                <option value="1" >Sale</option>
                                              </select>
                                            </div>
                                            <div class="col-md-2 p-0 p-1">
                                            <input type="text" name="notes[0]" class="form-control" id="new_notes_0" value="" placeholder="Name">
                                        </div>
                                            <div class="col-md-2 p-0 p-1">
                                              <input type="date" name="new_date[0]" class="form-control" id="new_date_0" value="" placeholder="Date">
                                            </div>
                                        <div class="col-md-1 p-1">
                                            <a class="btn btn-primary add" style="color: white;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
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
                    </div>
                    <!-- Tabs content -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>

    let add_number = 1;
        $("body").on("click", ".add", function (e) {
            $("#catelogue_size").append(
                '<div class="form-group row item_size-'+ add_number +'">\
                    <div class="col-md-2 pl-2 p-1">\
                      <input type="text" name="new_code['+ add_number +']" class="form-control" id="new_code-'+ add_number +'" value="" placeholder="Code">\
                    </div>\
                    <div class="col-md-1 pl-2 p-1">\
                      <input type="number" name="new_stock['+ add_number +']" class="form-control" id="new_stock-'+ add_number +'" value="" placeholder="Qty">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_gram['+ add_number +']" class="form-control" id="size_'+ add_number +'" value="" placeholder="Gram">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_ct['+ add_number +']" class="form-control" id="ct_'+ add_number +'" value="" placeholder="Ct">\
                    </div>\
                    <div class="col-md-2 p-1">\
                      <select class="form-control" id="item_status_'+ add_number +'" name="new_item_status['+ add_number +']">\
                        <option value="">Select option</option>\
                        <option value="0">Apro</option>\
                        <option value="1">Sale</option>\
                      </select>\
                    </div>\
                    <div class="col-md-2 p-1">\
                      <input type="text" name="new_notes['+ add_number +']" class="form-control" id="note_'+ add_number +'" value="" placeholder="Name">\
                    </div>\
                    <div class="col-md-2 p-1">\
                      <input type="date" name="new_date['+ add_number +']" class="form-control" id="date_'+ add_number +'" value="" placeholder="Date">\
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

    // $("body").on("change","#catalogue_id",function(e){
    //     var catalogueId = $("#catalogue_id :selected").val();
    //     var actionURL = "{{ URL::to('admin/get-subcatalogue') }}?catalogue_id="+catalogueId;
    //     $.ajax({
    //             type: 'GET',
    //             url: actionURL,
    //             success: function (data) {
    //                 $('#sub_catalogue_id').empty();
    //                 $('#sub_catalogue_id').append($('<option>', {
    //                     value: '',
    //                     text : 'Select Sub Catalogue'
    //                 }));
    //                 $.each(data.data, function (i, item) {
    //                     $('#sub_catalogue_id').append('<option value='+ i +'>'+ item +'</option');
    //                 });
    //             },
    //             error: function (result) {
    //                 // $("#modal_data").html("Sorry Cannot Load Data");
    //             }
    //         });
    //     // var sub_catalogue = {!! json_encode(config('params.')) !!};
    // });

        let number_of_image = 1;
    $(document).ready(function () {

        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
        });
        $('input[type="radio"].flat-green').iCheck({
            radioClass: 'iradio_flat-green'
        });

        $('#create').validate({// <- attach '.validate()' to your form
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
                
                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('input[name="csrf_token"]').val();
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', list_id);

                $.ajax({
                        url: '{{ url("admin/catalogue") }}',
                        type: 'POST',
                        data: myData,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data.type === 'success') {
                                swal("Done!", "It was succesfully done!", "success");
                                setTimeout(function () {
                                    window.location.href = data.returnURL;
                                }, 2000);
                                 // disable button
                                $("html, body").animate({scrollTop: 0}, "slow");

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
        });                    // <- end '.validate()'
    });
</script>
@endpush