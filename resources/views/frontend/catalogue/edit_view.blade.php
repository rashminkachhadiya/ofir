<div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 65%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hi, {{Auth()->user()->f_name}}</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="">
            <!-- product details inner end -->
            <div class="product-details-inner">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="product-large-slider">
                            <!-- @if(!empty($item->photo))
                            <div class="pro-large-img img-zoom">
                                <img  src="{{asset($item->photo)}}" alt="product-details" width="180px" height="180px" />
                            </div>
                            @endif -->
                            <div style="border: 1px solid black;" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @if(!is_null($item->itemDetails->photo_2))
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                @endif
                                @if(!is_null($item->itemDetails->photo_3))
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                @endif
                                @if(!is_null($item->itemDetails->photo_4))
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                @endif
                              </ol>
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="{{asset($item->itemDetails->photo)}}" alt="First slide">
                                </div>
                                @if(!is_null($item->itemDetails->photo_2))
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset($item->itemDetails->photo_2)}}" alt="Second slide">
                                </div>
                                @endif
                                @if(!is_null($item->itemDetails->photo_3))
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset($item->itemDetails->photo_3)}}" alt="Third slide">
                                </div>
                                @endif
                                @if(!is_null($item->itemDetails->photo_4))
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset($item->itemDetails->photo_4)}}" alt="Third slide">
                                </div>
                                @endif
                              </div>
                            </div>
                            <div>
                                <strong>{{ $item->itemDetails->sku }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-details-des">
                           
                            <h3 class="product-name" style="word-wrap: break-word;">{{ $item->itemDetails->item_title }}</h3>
                            <p style="margin-bottom: 0px;" class="pro-desc">{{ $item->itemDetails->description }}</p>
                            <div class="row">
                                <div class="col-md-5 mt-2">
                                    <div class="d-flex">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Metal</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            {!! Form::select('metal_type', $metalType ?? [],  $item->metal_type ?? '', ['class' => 'form-control','data-control'=>"select2", 'id'=>'metal_type']) !!}
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Weight</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" id="weight" name="weight" value="{{ $item->weight }}" placeholder="Weight" required>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Size</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" id="size" name="size" value="{{ $item->size }}" placeholder="Size" required>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Qty</label>
                                        </div>
                                        <div class="col-md-6 p-0 d-flex">
                                            <div class="quantity">
                                                <input class="form-control" name="qty" type="text" id="item-qty" value="{{ $item->size }}">
                                            </div>
                                            <div class="text-center" style="padding: 9px;">
                                                <i class="fa fa-plus-circle"></i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Ref...</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" name="reference" value="{{ $item->ref }}" id="ref" placeholder="Reference">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-5 mt-2">
                                    <div class="d-flex">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Gem.</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" id="gem" name="gem" value="{{ $item->gem }}" placeholder="Gem">
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Shape</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" id="shape" name="shape" value="{{ $item->shape }}" placeholder="Shape" required>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Carat</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" id="carat" name="carat" value="{{ $item->carat }}" placeholder="Carat">
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Colour</label>
                                        </div>
                                        <div class="col-md-6 p-0 d-flex">
                                            <input type="text" class="form-control" name="metal_colour" id="metal_colour" value="{{ $item->metal_colour }}" placeholder="Colour">
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <div class="col-md-4 p-0">
                                            <label class="col-form-label">Cleaerty</label>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <input type="text" class="form-control" name="cleaerty" id="cleaerty" value="{{ $item->cleaerty }}" placeholder="Cleaerty">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="quantity-cart-box mt-2 mb-2 align-items-center">
                                <textarea type="text" class="form-control" id="notes" name="notes" value="" placeholder="Notes" id="notes" rows="3" required="false">{{ $item->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex" style="justify-content: end;">
                    <div class="action_link ml-3">
                        <a style="border-radius: 15px; background: #000 !important; color: #fff !important;" class="btn btn-cart update-cart" item-id="{{ $item->id }}" href="javascript:void(0)"><strong>Update Order</strong></a>
                    </div>
                    <div class="ml-2" style="width: 50px;margin-top: 10px;">
                        
                    </div>
                </div>
            </div> <!-- product details inner end -->
        </div>
    </div>
</div>
<script type="text/javascript">

    $(".update-cart").click(function(event){
        var itemId = $(this).attr('item-id');
        var metalType = $('#metal_type').val();
        var weight = $('#weight').val();

        var gem = $('#gem').val();
        var shape = $('#shape').val();
        var metalColour = $('#metal_colour').val();
        var carat = $('#carat').val();
        var cleaerty = $('#cleaerty').val();


        var itemQty = $('#item-qty').val();
        var size = $('#size').val();
        var ref = $('#ref').val();
        var notes = $('#notes').val();
        $.ajax({
            url: "{{ URL::to('update-cart')}}",
            data:{'item_id' : itemId, 'item_qty' : itemQty,'size' : size,'ref' : ref,'notes':notes,'_token':"{{csrf_token()}}",'metal_type' : metalType,'weight' : weight,'gem' : gem,'shape' : shape,'metal_colour' : metalColour,'cleaerty': cleaerty,'carat': carat},
            dataType: 'json',
            type: 'POST',
            success: function(data) {
                location.reload(true); // show bootstrap modal
            },
            error: function(result) {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
          
        });
  });
    
    $(".fa-minus-circle").click(function(event) {
       var qty = $('#item-qty').val();
       if(qty > 1)
       {
        $('#item-qty').val(parseInt(qty) - 1);        
       }
    });

    $(".fa-plus-circle").click(function(event) {
       var qty = $('#item-qty').val();
       $('#item-qty').val(parseInt(qty) + 1);
    });

    $('.favorite').on('click',function(){
        var itemId = $(this).attr('data-id');
        // alert(itemId);
         // $(this).find('i').removeClass('pe-7s-like');
         //        $(this).find('i').addClass('fa fa-heart');
         //        $(this).removeClass('favorite');
         //        $(this).addClass('unfavorite')
        $.ajax({
            url: 'favorite',
            data:{'item_id' : itemId,'_token':"{{csrf_token()}}"},
            dataType: 'json',
            type: 'POST',
            success: function(data) {
               
                location.reload(true); // show bootstrap modal
            },
            error: function(result) {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
          
        });
    });

    $('.unfavorite').on('click',function(){
        var itemId = $(this).attr('data-id');
        // alert(itemId);
        // $(this).find('i').removeClass('fa fa-heart');
        // $(this).find('i').addClass('pe-7s-like');
        // $(this).addClass('favorite');
        // $(this).removeClass('unfavorite');
        $.ajax({
            url: 'unfavorite',
            data:{'item_id' : itemId,'_token':"{{csrf_token()}}"},
            dataType: 'json',
            type: 'POST',
            success: function(data) {
                
                location.reload(true); // show bootstrap modal
            },
            error: function(result) {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
          
        });
    });

</script>