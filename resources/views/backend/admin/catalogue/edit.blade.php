@extends('backend.layouts.master')
@section('title', ' Product Details')
@section('content')
    @php
        $stockMetalTypes = ['' => 'Select'] + config('params.metal_type');
        $metalTypes = ['' => 'Select'] + config('params.metal_type');
        $metalColours = ['' => 'Select'] + config('params.metal_colour');
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

        $diamondRows = \App\Services\ItemJewelInfoService::diamondRowsForForm($item);
        $gemRows = \App\Services\ItemJewelInfoService::gemRowsForForm($item);
    @endphp

    <x-admin.page-header title="Edit Product" icon="box2">
        <x-slot name="actions">
            <a href="{{ url('admin/catalogue') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Catalogue
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <x-admin.form-card>
                    <!-- Tabs navs -->
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <ul class="nav nav-tabs catalogue-tabs mb-3" id="ex1" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="link-tab-product-details" data-mdb-toggle="tab" href-div="tab-product-details" role="tab" aria-controls="ex1-tabs-1" aria-selected="true" >Product Details</a>
                      </li>
                    </ul>
                    <!-- Tabs navs -->

                    <!-- Tabs content -->
                    <div class="tab-content" id="ex1-content">
                      <div class="tab-pane fade show active" id="tab-product-details" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <form id='edit' action="" enctype="multipart/form-data" method="" accept-charset="utf-8" class="needs-validation admin-catalogue-form"
                          novalidate>
                          {{method_field('PUT')}}
                            <div class="form-row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div id="status"></div>
                                <br/>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
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
                                        <label class="form-section-title">Product Images</label>
                                        <div class="product-media-layout">
                                            <div class="product-media-layout__meta">
                                                <div class="form-group">
                                                    <label for="item_metal_type">Metal</label>
                                                    {!! Form::select('item_metal_type', $metalTypes, old('item_metal_type', $item->metal_type ?? ''), ['class' => 'form-control','data-control'=>"select2", 'id'=>'item_metal_type']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_weight">Weight</label>
                                                    <input type="text" class="form-control" id="item_weight" name="item_weight" value="{{ $item->weight }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_metal_colour">Metal Colour</label>
                                                    {!! Form::select('item_metal_colour', $metalColours, old('item_metal_colour', $item->metal_colour ?? ''), ['class' => 'form-control','data-control'=>"select2", 'id'=>'item_metal_colour']) !!}
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="item_size">Size</label>
                                                    <input type="text" class="form-control" id="item_size" name="item_size" value="{{ $item->size }}">
                                                </div>
                                            </div>
                                            <div class="product-media-layout__gallery">
                                                <x-admin.product-image-upload
                                                    :slot-id="1"
                                                    input-name="photo_1"
                                                    label="Primary Photo"
                                                    :src="$item->photo ?? ''"
                                                    :primary="true"
                                                />
                                                <div class="product-media-layout__thumbs">
                                                    <x-admin.product-image-upload
                                                        :slot-id="2"
                                                        input-name="photo_2"
                                                        label="Photo 2"
                                                        :src="$item->photo_2 ?? ''"
                                                    />
                                                    <x-admin.product-image-upload
                                                        :slot-id="3"
                                                        input-name="photo_3"
                                                        label="Photo 3"
                                                        :src="$item->photo_3 ?? ''"
                                                    />
                                                    <x-admin.product-image-upload
                                                        :slot-id="4"
                                                        input-name="photo_4"
                                                        label="Photo 4"
                                                        :src="$item->photo_4 ?? ''"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="form-group col-md-12 col-sm-12">
                                        <label for=""> Item Title gram</label>
                                        <input type="text" class="form-control" id="item_title_gram" name="item_title_gram" value="{{ $item->item_title_gram }}" placeholder="">
                                        <span id="error_item_title_gram" class="has-error"></span>
                                    </div> -->
                                    <div class="">
                                        <div class="col-md-12">
                                            @include('backend.admin.catalogue.partials.diamond-info-section', [
                                                'rows' => $diamondRows,
                                                'shapeOptions' => $shapeOptions,
                                            ])
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            @include('backend.admin.catalogue.partials.gem-info-section', [
                                                'rows' => $gemRows,
                                                'shapeOptions' => $shapeOptions,
                                                'gemOptions' => $gemOptions,
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @include('backend.admin.catalogue.partials.ask-price-panel', ['item' => $item])
                                    </div>
                                </div>
                                <div class="col catalogue-stock-scroll" id="catelogue_size">
                                    <hr>
                                    <div class="row text-center catalogue-stock-header">
                                        <div class="col-md-0-5 pl-1 p-1">
                                            <p><strong>Check</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-1 p-1">
                                            <p><strong>Date</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-1 p-1">
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
                                        <div class="col-md-0-5 pl-2 p-1">
                                            <p><strong> Ct</strong></p>
                                        </div>
                                        <div class="col-md-0-5 pl-2 p-1">
                                            <p><strong> Pcs.</strong></p>
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                            <p><strong> Country</strong></p>
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
                                    @if(count($itemStock) > 0  && !empty($itemStock))
                                        <?php
                                            $sizeCount = 0;
                                        ?>
                                        @foreach($itemStock as $size)
                                        <?php
                                            $colors = "black";
                                            if($size->item_status == 1)
                                            {
                                                $colors = "red";
                                            }
                                        ?>
                                        <div  class="form-group row mt-1 item_size-{{$size->id}}">
                                            <div style="text-align: center; " class="col-md-0-5 pl-2 p-1">
                                                <?php
                                                    $checked = ($size->check == 1) ? 'checked' : ''; 
                                                ?>
                                              <input style="width:30px; height:23px;" class="" type="checkbox" value="{{ $size->id }}" onchange="checkStock(this)" name="id" {{ $checked }}/>
                                            </div>
                                            <div style="text-align: center;" class="col-md-1 pl-2 p-1">
                                                <input style="color: {{ $colors }}" type="date" name="created_date[{{ $size->id }}]" class="form-control" id="created-date_{{ $size->id }}" value="{{ !is_null($size->created_at) ? \Carbon\Carbon::parse($size->created_at)->format('Y-m-d') : NULL }}" placeholder="Date">
                                            </div>
                                            <div class="col-md-1 pl-2 p-1" style="max-width: 8% !important;">
                                              <input style="color: {{ $colors }}" type="text" name="code[{{$size->id}}]" class="form-control" id="code-0" value="{{ $size->item_code }}" placeholder="Code">
                                            </div>
                                            <div class="col-md-0-5 pl-2 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="stock[{{ $size->id }}]" class="form-control" id="size_{{ $size->id }}" value="{{number_format((float)$size->qty, 0, '.', '') }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="gram[{{ $size->id }}]" class="form-control" id="gram_{{ $size->id }}" value="{{ $size->gram }}"  placeholder="Gram">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              {!! Form::select('metal_type['.$size->id.']', $stockMetalTypes, $size->metal_type ?? '', ['class' => 'form-control', 'id' => 'metal_type_'.$size->id]) !!}
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="q_size[{{ $size->id }}]" class="form-control" id="q_size{{ $size->id }}" value="{{ $size->size }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select style="color: {{ $colors }}" class="form-control" name="colour[{{ $size->id }}]">
                                                <option value="" {{ is_null($size->item_status) ? 'selected' : '' }}>Select</option>
                                                <option value="0" {{ $size->colour == "0" ? 'selected' : '' }}>White</option>
                                                <option value="1" {{ $size->colour == "1" ? 'selected' : '' }}>Yellow</option>
                                                <option value="2" {{ $size->colour == "2" ? 'selected' : '' }}>Red</option>
                                                <option value="3" {{ $size->colour == "3" ? 'selected' : '' }}>Mix</option>
                                              </select>
                                            </div>
                                            <div class="col-md-0-5 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="ct[{{ $size->id }}]" class="form-control" id="ct_{{ $size->id }}" value="{{ $size->ct }}">
                                            </div>
                                            <div class="col-md-0-5 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="pieces[{{ $size->id }}]" class="form-control" id="pieces_{{ $size->id }}" value="{{ $size->pieces }}">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select style="color: {{ $colors }}" class="form-control" name="location[{{ $size->id }}]">
                                                <option value="" {{ is_null($size->location) ? 'selected' : '' }}>Select</option>
                                                <option value="0" {{ $size->location == "0" ? 'selected' : '' }}>UK</option>
                                                <option value="1" {{ $size->location == "1" ? 'selected' : '' }}>Israel</option>
                                                <option value="2" {{ $size->location == "2" ? 'selected' : '' }}>Mayo</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <select style="color: {{ $colors }}" class="form-control" name="item_status[{{ $size->id }}]">
                                                <option value="" {{ is_null($size->item_status) ? 'selected' : '' }}>Select</option>
                                                <option value="0" {{ $size->item_status == "0" ? 'selected' : '' }}>Apro</option>
                                                <option value="1" {{ $size->item_status == "1" ? 'selected' : '' }}>Sold</option>
                                                <option value="2" {{ $size->item_status == "2" ? 'selected' : '' }}>Transaction</option>
                                                <option value="3" {{ $size->item_status == "3" ? 'selected' : '' }}>Repair</option>
                                              </select>
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                                <select name="notes[{{ $size->id }}]" class="form-control select-customer" id="notes_{{ $size->id }}">
                                                    <option value="{{$size->notes}}">{{$size->notes}}</option>
                                                </select>
                                              <!-- <input style="color: {{ $colors }}" type="text" name="notes[{{ $size->id }}]" class="form-control" id="notes_{{ $size->id }}" value="{{ $size->notes }}" placeholder="Name"> -->
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="date" name="date[{{ $size->id }}]" class="form-control" id="date_{{ $size->id }}" value="{{ !is_null($size->date) ? \Carbon\Carbon::parse($size->date)->format('Y-m-d') : NULL }}" placeholder="Date">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input style="color: {{ $colors }}" type="text" name="stocknotes[{{ $size->id }}]" class="form-control" id="stocknotes_{{ $size->id }}" value="{{ $size->stocknotes }}">
                                            </div>
                                            <!-- <div class="col-md-1 p-0 p-1">
                                                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('1', 'C39')}}" alt="barcode" />
                                            </div> -->
                                            @if($sizeCount == 0)
                                            
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
                                        <div class="col-md-1 pl-2 p-1">
                                          
                                        </div>
                                        <div class="col-md-1 pl-2 p-1">
                                          <input type="text" name="new_code[0]" class="form-control" id="new_code-0" value="" placeholder="Code">
                                        </div>
                                        <div class="col-md-0-5 pl-2 p-1">
                                          <input type="number" name="new_stock[0]" class="form-control" id="new_sotck-0" value="1" placeholder="Qty">
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
                                            <!-- <input type="text" name="new_notes[0]" class="form-control" id="new_notes_0" value="" placeholder="Name"> -->
                                        </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="date" name="new_date[0]" class="form-control" id="new_date_0" value="" placeholder="Date">
                                            </div>
                                            <div class="col-md-1 p-0 p-1">
                                              <input type="text" name="new_stocknotes[0]" class="form-control" id="new_stocknotes_0" value="" placeholder="Note">
                                            </div>

                                        
                                    </div>
                                    @endif
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
                      <div class="tab-pane fade" id="tab-size-stock" role="tabpanel" aria-labelledby="ex1-tab-2">
                        
                      </div>
                    </div>
                    <!-- Tabs content -->
                </x-admin.form-card>
        </div>
    </div>
@endsection
@push('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function checkStock(val)
        {
            var stockId = $(val).attr('value');
            $.ajax({
                type: "GET",
                url: '{{ url("admin/stock-check") }}?stock_id='+stockId,
                datatype: 'html',
                success: function (data) {
                    
                },
                error: function (result) {
                    $("#modal_data").html("Sorry Cannot Load Data");
                }
            });
        }

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
     let number_of_image = 1;
</script>
<script type="text/javascript">
    function selectRefresh() {
        $(".select-customer").select2({
            placeholder: 'Select',
            allowClear: true,
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
                var arr = [];
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
            var preview = $('#preview-' + id);
            var frame = preview.closest('.product-image-slot__frame');
            preview.attr('src', '').hide().removeClass('has-image');
            if (frame.length) {
                frame.addClass('is-empty');
                frame.find('.product-image-slot__empty').addClass('is-visible');
            }
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
                    <div class="col-md-1 pl-2 p-1">\
                      \
                    </div>\
                    <div class="col-md-1 pl-2 p-1">\
                      <input type="text" name="new_code['+ add_number +']" class="form-control" id="new_code-'+ add_number +'" value="" placeholder="Code">\
                    </div>\
                    <div class="col-md-0-5 pl-2 p-1">\
                      <input type="number" name="new_stock['+ add_number +']" class="form-control" id="new_stock-'+ add_number +'" value="0" placeholder="Qty">\
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
                    <div class="col-md-0-5 p-1">\
                      <input type="text" name="new_ct['+ add_number +']" class="form-control" id="ct_'+ add_number +'" value="" placeholder="Ct">\
                    </div>\
                    <div class="col-md-0-5 p-1">\
                      <input type="text" name="new_pieces['+ add_number +']" class="form-control" id="pieces_'+ add_number +'" value="" placeholder="Pieces">\
                    </div>\
                    <div class="col-md-1 p-1">\
                      <select class="form-control" id="item_status_'+ add_number +'" name="new_location['+ add_number +']">\
                        <option value="">Select</option>\
                        <option value="0">UK</option>\
                        <option value="1">Israel</option>\
                      </select>\
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
            selectRefresh();
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

        $(document).on('click keypress', '.uploadImage', function(e) {
            if (e.type === 'keypress' && e.which !== 13 && e.which !== 32) {
                return;
            }
            e.preventDefault();
            var id = $(this).data('id');
            $('#photo-' + id).trigger('click');
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

    });
</script>
@include('backend.admin.catalogue.partials.jewel-info-scripts')
@endpush
