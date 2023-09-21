<div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 50%">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="">
            <!-- product details inner end -->
            <div class="product-details-inner">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="product-large-slider">
                            @if(!empty($item->photo))
                            <div class="pro-large-img img-zoom">
                                <img  src="{{asset($item->photo)}}" alt="product-details" width="180px" height="180px" />
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-details-des">
                           
                            <h3 class="product-name" style="word-wrap: break-word;">{{ $item->item_title }}</h3>
                            <p style="margin-bottom: 0px;" class="pro-desc">{{ $item->item_description }}</p>
                            <p style="font-size: 10px;"><strong> Code: </strong> {{ $item->sku }}</p>
                            <div class="quantity-cart-box d-flex align-items-center">
                                    
                            </div>
                            <div class="quantity-cart-box d-flex align-items-center">
                                <h6 class="option-title mr-2">Qty</h6>
                                <i class="fa fa-minus-circle mr-3"></i>
                                <div class="quantity">
                                    <div class="pro-qty"><input type="text" id="item-qty" value="1"></div>
                                </div>
                                <i class="fa fa-plus-circle"></i>
                            </div>
                            <div class="d-flex" style="justify-content: end;">
                                <!-- <div class="action_link ml-3">
                                    <a style="background: #f195ab !important; color: black !important;" class="btn btn-cart add-to-cart" item-id="{{ $item->id }}" href="javascript:void(0)"><strong>Add to cart</strong></a>
                                </div> -->
                                <div class="ml-2" style="width: 50px;margin-top: 10px;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- product details inner end -->
        </div>
    </div>
</div>
<script type="text/javascript">
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
