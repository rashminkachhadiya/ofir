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
                      <li class="nav-item ml-2" role="presentation">
                       <a href="{{ URL :: to('/admin/catalogue/create') }}" class="btn btn-success"><i
                                class="glyphicon glyphicon-plus"></i>
                            Add New Item
                        </a>
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
                                        <label for=""> Code </label>
                                        <input type="text" class="form-control" id="sku" name="sku" value="{{ $item->sku }}" placeholder="" required>
                                        <span id="error_sku" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <img id="preview-1" src="{{ asset($item->photo) }}" alt="" style="width: 105px; height: 100px;">
                                    </div>
                                    <div class="mt-1 form-group col-md-12 col-sm-12" style="width: 200px;">
                                        <input id="photo-1" type="file" accept="image/*" class="form-control" name="photo_1" onchange="showImage(1)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title </label>
                                        <input type="text" class="form-control" id="item_title" name="item_title" value="{{ $item->item_title }}" placeholder="" required>
                                        <span id="error_item_title" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title gram</label>
                                        <input type="text" class="form-control" id="item_title_gram" name="item_title_gram" value="{{ $item->item_title_gram }}" placeholder="">
                                        <span id="error_item_title_gram" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Description </label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}" placeholder="">
                                        <span id="error_description" class="has-error"></span>
                                    </div>
                                    <div class="d-flex">
                                    <div class="form-group col-md-6">
                                        <label for=""> All Collection </label><br/>
                                        <input type="radio" name="is_allcollection" class="flat-green" value="1" {{ ( $item->is_allcollection == 1 ) ? 'checked' : '' }}/> Yes
                                        <input type="radio" name="is_allcollection" class="flat-green" value="0" {{ ( $item->is_allcollection == 0 ) ? 'checked' : '' }}/> No
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for=""> Is Active? </label><br/>
                                        <input type="radio" name="is_active" class="flat-green"value="1" {{ ( $item->is_active == 1 ) ? 'checked' : '' }}/> Yes
                                        <input type="radio" name="is_active" class="flat-green"value="0" {{ ( $item->is_active == 0 ) ? 'checked' : '' }}/> No
                                    </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Available </label><br/>
                                        <input type="radio" name="is_available" class="flat-green"value="1" {{ ( $item->is_available == 1 ) ? 'checked' : '' }}/> Yes
                                        <input type="radio" name="is_available" class="flat-green"value="0" {{ ( $item->is_available == 0 ) ? 'checked' : '' }}/> No
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        <label for=""> Size </label>
                                        <input type="text" class="form-control" id="size" name="size" value="{{ $item->size }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Metal Colour </label>
                                          {!! Form::select('metal_colour', config('params.metal_colour') ?? [],  $item->metal_colour ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Metal Type </label>
                                        {!! Form::select('metal_type', config('params.metal_type') ?? [],  $item->metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Cost Fee </label>
                                        <input type="text" class="form-control" id="cost_fee" name="cost_fee" value="{{ $item->cost_fee }}">
                                    </div>
                                    <div class="d-flex">
                                    <div class="form-group col-md-4">
                                        <label for="">$ </label>
                                        <input type="text" class="form-control" id="price_usd" name="price_usd" value="{{ $item->price_usd }}">
                                    </div><div class="form-group col-md-4">
                                        <label for=""> &pound; </label>
                                        <input type="text" class="form-control" id="price_pound" name="price_pound" value="{{ $item->price_pound }}">
                                    </div><div class="form-group col-md-4">
                                        <label for=""> &euro; </label>
                                        <input type="text" class="form-control" id="price_eur" name="price_eur" value="{{ $item->price_eur }}">
                                    </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for=""> Price Notes </label>
                                        <input type="text" class="form-control" id="price_notes" name="price_notes" value="{{ $item->price_notes }}">
                                    </div>
                                </div>
                                <div id="catelogue_size">
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-md-2 pl-2 p-1">
                                            <p><strong>Code</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Qty</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Gram</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Size</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Colour</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Ct</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Pcs.</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Status</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Customer</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Date</strong></p>
                                        </div>
                                    </div>
                                    @if(count($itemStock) > 0  && !empty($itemStock))
                                        <?php
                                            $sizeCount = 0;
                                        ?>
                                        @foreach($itemStock as $size)
                                        <div class="form-group row mt-1 item_size-{{$size->id}}">
                                            <div class="col-md-2 pl-2 p-1">
                                              <input type="text" name="code[{{$size->id}}]" class="form-control" id="code-0" value="{{ $size->item_code }}" placeholder="Code">
                                            </div>
                                            <div class="col-md-1 pl-2 p-1">
                                              <input type="text" name="stock[{{ $size->id }}]" class="form-control" id="size_{{ $size->id }}" value="{{ $size->qty }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="gram[{{ $size->id }}]" class="form-control" id="gram_{{ $size->id }}" value="{{ $size->gram }}"  placeholder="Gram">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="q_size[{{ $size->id }}]" class="form-control" id="q_size{{ $size->id }}" value="{{ $size->size }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select class="form-control" name="colour[{{ $size->id }}]">
                                                <option value="" {{ is_null($size->item_status) ? 'selected' : '' }}>Select</option>
                                                <option value="0" {{ $size->colour == "0" ? 'selected' : '' }}>White</option>
                                                <option value="1" {{ $size->colour == "1" ? 'selected' : '' }}>Yellow</option>
                                                <option value="2" {{ $size->colour == "2" ? 'selected' : '' }}>Red</option>
                                                <option value="3" {{ $size->colour == "3" ? 'selected' : '' }}>Mix</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="ct[{{ $size->id }}]" class="form-control" id="ct_{{ $size->id }}" value="{{ $size->ct }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="pieces[{{ $size->id }}]" class="form-control" id="pieces_{{ $size->id }}" value="{{ $size->pieces }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select class="form-control" name="item_status[{{ $size->id }}]">
                                                <option value="" {{ is_null($size->item_status) ? 'selected' : '' }}>Select</option>
                                                <option value="0" {{ $size->item_status == "0" ? 'selected' : '' }}>Apro</option>
                                                <option value="1" {{ $size->item_status == "1" ? 'selected' : '' }}>Sale</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="notes[{{ $size->id }}]" class="form-control" id="notes_{{ $size->id }}" value="{{ $size->notes }}" placeholder="Name">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="date" name="date[{{ $size->id }}]" class="form-control" id="date_{{ $size->id }}" value="{{ !is_null($size->date) ? \Carbon\Carbon::parse($size->date)->format('Y-m-d') : NULL }}" placeholder="Date">
                                            </div>
                                            @if($sizeCount == 0)
                                            <div class="col-md-1">
                                                <a class="btn btn-primary add" style="color: white;">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <?php
                                                $sizeCount++;
                                            ?>
                                            @else
                                            <div class="col-md-1">
                                                <a class="btn btn-danger remove" data-id="{{ $size->id }}" style="color: white;">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @else
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
                                          <input type="text" name="new_q_size[0]" class="form-control" id="new_q_size-0" value="" placeholder="Size">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <select class="form-control" name="new_colour[0]">
                                            <option value="">Select</option>
                                            <option value="0">White</option>
                                            <option value="1">Yellow</option>
                                            <option value="2">Red</option>
                                            <option value="3">Mix</option>
                                          </select>
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <input type="text" name="new_ct[0]" class="form-control" id="new_ct-0" value=""  placeholder="Ct">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <input type="text" name="new_pieces[0]" class="form-control" id="new_pieces-0" value="" placeholder="Pcs">
                                        </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select class="form-control" name="new_item_status[0]">
                                                <option value="" >Select</option>
                                                <option value="0" >Apro</option>
                                                <option value="1" >Sale</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                            <input type="text" name="new_notes[0]" class="form-control" id="new_notes_0" value="" placeholder="Name">
                                        </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="date" name="new_date[0]" class="form-control" id="new_date_0" value="" placeholder="Date">
                                            </div>
                                        <div class="col-md-1 p-1">
                                            <a class="btn btn-primary add" style="color: white;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-1 mb-1">
                                    <a class="btn btn-primary add" style="color: white;">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
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
                      <input type="text" name="new_q_size['+ add_number +']" class="form-control" id="q_size_'+ add_number +'" value="" placeholder="Size">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <select class="form-control" id="colour_'+ add_number +'" name="new_colour['+ add_number +']">\
                        <option value="">Select</option>\
                        <option value="0">White</option>\
                        <option value="1">Yellow</option>\
                        <option value="2">Red</option>\
                        <option value="3">Mix</option>\
                      </select>\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_ct['+ add_number +']" class="form-control" id="ct_'+ add_number +'" value="" placeholder="Ct">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_pieces['+ add_number +']" class="form-control" id="pieces_'+ add_number +'" value="" placeholder="Pieces">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <select class="form-control" id="item_status_'+ add_number +'" name="new_item_status['+ add_number +']">\
                        <option value="">Select</option>\
                        <option value="0">Apro</option>\
                        <option value="1">Sale</option>\
                      </select>\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_notes['+ add_number +']" class="form-control" id="note_'+ add_number +'" value="" placeholder="Name">\
                    </div>\
                    <div class="col-md-1 p-1">\
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