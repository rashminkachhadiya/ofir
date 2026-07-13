@extends('backend.layouts.master')
@section('title', ' Product Details')
@section('content')
    @php
        $stockMetalTypes = ['' => 'Select'] + config('params.metal_type');
        $shapeOptions = [
            '' => 'Select',
            'Round' => 'Round',
            'Oval' => 'Oval',
            'Pear' => 'Pear',
            'Emerald' => 'Emerald',
            'Princess' => 'Princess',
            'Cushion' => 'Cushion',
            'Radiant' => 'Radiant',
            'Asscher' => 'Asscher',
            'Heart' => 'Heart',
            'Marquise' => 'Marquise',
            'Baguette' => 'Baguette',
            'Tapered Baguette' => 'Tapered Baguette',
            'Trillion' => 'Trillion',
            'Trapezoid' => 'Trapezoid',
            'Half Moon' => 'Half Moon',
            'Shield' => 'Shield',
            'Bullet' => 'Bullet',
            'Kite' => 'Kite',
            'Square' => 'Square',
            'Rectangle' => 'Rectangle',
            'Octagon' => 'Octagon',
            'Hexagon' => 'Hexagon',
            'Cabochon' => 'Cabochon',
            'Fancy' => 'Fancy',
            'Other' => 'Other',
        ];
        $gemOptions = [
            '' => 'Select',
            'Emerald' => 'Emerald',
            'Sapphire' => 'Sapphire',
            'Ruby' => 'Ruby',
            'Onyx' => 'Onyx',
            'Pearl' => 'Pearl',
            'Tsavorite' => 'Tsavorite',
            'Tanzanite' => 'Tanzanite',
            'Aquamarine' => 'Aquamarine',
            'Amethyst' => 'Amethyst',
            'Citrine' => 'Citrine',
            'Topaz' => 'Topaz',
            'Garnet' => 'Garnet',
            'Tourmaline' => 'Tourmaline',
            'Opal' => 'Opal',
            'Jade' => 'Jade',
            'Turquoise' => 'Turquoise',
            'Coral' => 'Coral',
            'Quartz' => 'Quartz',
            'Morganite' => 'Morganite',
            'Peridot' => 'Peridot',
            'Spinel' => 'Spinel',
            'Moonstone' => 'Moonstone',
            'Lapis Lazuli' => 'Lapis Lazuli',
            'Malachite' => 'Malachite',
            'Mother of Pearl' => 'Mother of Pearl',
            'Other' => 'Other',
        ];
    @endphp

    <x-admin.page-header title="Create Product" icon="box2" />

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <x-admin.form-card>
                    <ul class="nav nav-tabs catalogue-tabs mb-3" id="ex1" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="link-tab-product-details" data-mdb-toggle="tab" href-div="tab-product-details" role="tab" aria-controls="ex1-tabs-1" aria-selected="true" >Product Details</a>
                      </li>
                    </ul>
                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                      <div class="tab-pane fade show active" id="tab-product-details" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation admin-catalogue-form"
                        novalidate>
                            <div class="form-row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div id="status"></div>
                                <br/>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
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
                                        <label for=""> Item Title </label>
                                        <input type="text" class="form-control" id="item_title" name="item_title" value="" placeholder="" required>
                                        <span id="error_item_title" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Description </label>
                                        <input type="text" class="form-control" id="description" name="description" value="" placeholder="">
                                        <span id="error_description" class="has-error"></span>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="form-section-title">Product Images</label>
                                        <div class="product-media-layout">
                                            <div class="product-media-layout__meta">
                                                <div class="form-group">
                                                    <label for="metal_type">Metal</label>
                                                    {!! Form::select('metal_type', config('params.metal_type') ?? [],  $item->metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="weight">Weight</label>
                                                    <input type="text" class="form-control" id="weight" name="weight" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="metal_colour">Metal Colour</label>
                                                    {!! Form::select('metal_colour', config('params.metal_colour') ?? [],  $item->metal_colour ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_colour']) !!}
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="size">Size</label>
                                                    <input type="text" class="form-control" id="size" name="size" value="">
                                                </div>
                                            </div>
                                            <div class="product-media-layout__gallery">
                                                <x-admin.product-image-upload
                                                    :slot-id="1"
                                                    input-name="photo_1"
                                                    label="Primary Photo"
                                                    :primary="true"
                                                />
                                                <div class="product-media-layout__thumbs">
                                                    <x-admin.product-image-upload :slot-id="2" input-name="photo_2" label="Photo 2" />
                                                    <x-admin.product-image-upload :slot-id="3" input-name="photo_3" label="Photo 3" />
                                                    <x-admin.product-image-upload :slot-id="4" input-name="photo_4" label="Photo 4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="">
                                        <div class="col-md-12">
                                            @include('backend.admin.catalogue.partials.diamond-info-section', [
                                                'rows' => old('diamond_info', [[]]),
                                                'shapeOptions' => $shapeOptions,
                                            ])
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            @include('backend.admin.catalogue.partials.gem-info-section', [
                                                'rows' => old('gem_info', [[]]),
                                                'shapeOptions' => $shapeOptions,
                                                'gemOptions' => $gemOptions,
                                            ])
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        @include('backend.admin.catalogue.partials.ask-price-panel')
                                    </div>
                                </div>

                                <div class="catalogue-stock-scroll" id="catelogue_size">
                                    <hr>
                                    <div class="row text-center catalogue-stock-header">
                                        <div class="col-md-1 pl-1 p-1">
                                            <p><strong>Date</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong>Code</strong></p>
                                        </div>
                                        <div class="col-md-0-5 pl-2 p-1">
                                            <p><strong> Qty</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Gram</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Metal Type</strong></p>
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
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Note</strong></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-1 pl-2 p-1">
                                          
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                          <input type="text" name="new_code[0]" class="form-control" id="new_code-0" value="" placeholder="Code">
                                        </div>
                                        <div class="col-md-0-5 pl-2 p-1">
                                          <input type="number" name="new_stock[0]" class="form-control" id="new_sotck-0" value="" placeholder="Qty">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          <input type="text" name="new_gram[0]" class="form-control" id="new_gram-0" value=""  placeholder="Gram">
                                        </div>
                                        <div class="col-md-1 p-0 p-1">
                                          {!! Form::select('new_metal_type[0]', $stockMetalTypes, null, ['class' => 'form-control', 'id' => 'new_metal_type-0']) !!}
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
                                                <option value="1" >Sold</option>
                                                <option value="2">Transaction</option>
                                                <option value="3">Repair</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                            <select name="new_notes[0]" class="form-control select-customer" id="new_notes_0">
                                                </select>
                                        </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="date" name="new_date[0]" class="form-control" id="new_date_0" value="" placeholder="Date">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="new_stocknotes[0]" class="form-control" id="new_stocknotes_0" value="" placeholder="Note">
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <div class="col-md-1 mb-1">
                                        <a class="btn btn-primary add" style="color: white;">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <button type="submit" class="btn btn-success button-submit"
                                            data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
                                    </button>
                                </div>
                            </div>
                        </form>             
                      </div>
                    </div>
                    <!-- Tabs content -->
                </x-admin.form-card>
        </div>
    </div>
@endsection
@push('script')
<script>
    function selectRefresh() {
        $(".select-customer").select2({
            ajax: {
            minimumInputLength: 2,
            url: '/admin/get-customer',
            dataType: 'json',
            type: "GET",
            data: function (term) {
            return {
                term: term
                };
            },
            processResults: function (data) {
                var arr = []
                    $.each(data.data, function (index, value) {
                        arr.push({
                            id: value.f_name,
                            text: value.f_name
                        })
                    })
                return {
                    results: arr
                };
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
          }
        });
    }
    let add_number = 1;
        $("body").on("click", ".add", function (e) {
             $("#catelogue_size").append(
                '<div class="form-group row item_size-'+ add_number +'">\
                    <div class="col-md-1 pl-2 p-1">\
                      \
                    </div>\
                    <div class="col-md-1 pl-2 p-1">\
                      <input type="text" name="new_code['+ add_number +']" class="form-control" id="new_code-'+ add_number +'" value="" placeholder="Code">\
                    </div>\
                    <div class="col-md-0-5 pl-2 p-1">\
                      <input type="number" name="new_stock['+ add_number +']" class="form-control" id="new_stock-'+ add_number +'" value="" placeholder="Qty">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="text" name="new_gram['+ add_number +']" class="form-control" id="size_'+ add_number +'" value="" placeholder="Gram">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <select class="form-control" id="new_metal_type_'+ add_number +'" name="new_metal_type['+ add_number +']">\
                        <option value="">Select</option>\
                        @foreach(config('params.metal_type') as $key => $value)\
                        <option value="{{ $key }}">{{ $value }}</option>\
                        @endforeach\
                      </select>\
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
                        <option value="1">Sold</option>\
                        <option value="2">Transaction</option>\
                        <option value="3">Repair</option>\
                      </select>\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <select name="new_notes['+ add_number +']" class="form-control select-customer" id="note_'+ add_number +'">\
                        </select>\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <input type="date" name="new_date['+ add_number +']" class="form-control" id="date_'+ add_number +'" value="" placeholder="Date">\
                    </div>\
                    <div class="col-md-1 p-0 p-1">\
                        <input type="text" name="new_stocknotes['+ add_number +']" class="form-control" id="stocknotes_'+ add_number +'" value="" placeholder="Note">\
                    </div>\
                    <div class="col-md-1">\
                        <a class="btn btn-danger remove" data-id="'+ add_number +'" style="color: white;">\
                            <i class="fa fa-minus" aria-hidden="true"></i>\
                        </a>\
                    </div>\
                </div>'
            );
            add_number++;
            selectRefresh();
        });

        $("body").on("click", ".remove", function (e) {
            let id = $(this).attr('data-id');
            $(".item_size-" + id).remove();
            add_number--;
        });

    function showImage(imgNumber) {
        const imageUploader = document.querySelector("#photo-" + imgNumber);
        const imagePreview = document.querySelector("#preview-" + imgNumber);
        if (!imageUploader || !imageUploader.files || !imageUploader.files[0] || !imagePreview) {
            return;
        }
        const frame = imagePreview.closest('.product-image-slot__frame');
        const empty = frame ? frame.querySelector('.product-image-slot__empty') : null;
        const reader = new FileReader();
        reader.readAsDataURL(imageUploader.files[0]);
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            imagePreview.classList.add('has-image');
            if (frame) {
                frame.classList.remove('is-empty');
            }
            if (empty) {
                empty.classList.remove('is-visible');
            }
        };
    }

    $(document).on('click keypress', '.uploadImage', function(e) {
        if (e.type === 'keypress' && e.which !== 13 && e.which !== 32) {
            return;
        }
        e.preventDefault();
        var id = $(this).data('id');
        $('#photo-' + id).trigger('click');
    });
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
        $('.select-customer').select2({
          ajax: {
            minimumInputLength: 2,
            url: '/admin/get-customer',
            dataType: 'json',
            type: "GET",
            data: function (term) {
            return {
                term: term
                };
            },
            processResults: function (data) {
                var arr = []
                    $.each(data.data, function (index, value) {
                        arr.push({
                            id: value.f_name,
                            text: value.f_name
                        })
                    })
                return {
                    results: arr
                };
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
          }
        });

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
                                    if (typeof applyJewelValidationErrors === 'function') {
                                        applyJewelValidationErrors(data.errors);
                                    }
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
@include('backend.admin.catalogue.partials.jewel-info-scripts')
@endpush
