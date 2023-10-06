@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
<style type="text/css">
    .back {
  /*background: #e2e2e2;*/
  width: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
}

.div-center {
  border-radius: 40px;
  width: 1100px;
  height: 500px;
  background-color: #f6f5f3;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  /*bottom: 0;*/
  margin: auto;
  max-width: 100%;
  max-height: 100%;
  overflow: auto;
  padding: 1em 2em;
  border-bottom: 2px solid #ccc;
  display: table;
}

.pagination{
  justify-content: center !important;
}

div.content {
  /*display: table-cell;*/
  /*vertical-align: middle;*/
}

.paginatoin-area {
  margin-top: 30px;
  padding: 20px;
  /*border: 1px solid #efefef;*/
  justify-content: center !important;
}
.paginatoin-area .pagination-box {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
      -ms-flex-pack: center;
          justify-content: center;
}
.paginatoin-area .pagination-box li {
  margin-right: 5px;
  display: inline-block;
}
.paginatoin-area .pagination-box li:last-child {
  margin-right: 0;
}
.paginatoin-area .pagination-box li a {
  color: #222222;
  height: 25px;
  width: 25px;
  font-size: 11px;
  display: inline-block;
  text-align: center;
  line-height: 25px;
  background-color: #f5f5f5;
  border-radius: 50%;
}
.paginatoin-area .pagination-box li a i {
  font-size: 26px;
  line-height: 25px;
}
.paginatoin-area .pagination-box li a:hover {
  color: #fff;
  border-color: black;
  background-color: black;
}
.paginatoin-area .pagination-box li.active{
  color: #fff;
  background-color: black;
  height: 25px;
  width: 25px;
  font-size: 11px;
  display: inline-block;
  text-align: center;
  line-height: 25px;
  border-radius: 50%;
}

</style>
    <div class="back">
        <div class="div-center">
            <div class="mb-4 d-flex" style="align-items: center;">
              <div class="col-md-3">
                <a class="m-2 mt-0" style="font-size: 16px;cursor: pointer; color: black" href="{{ URL::to('/') }}">Home</a>
              </div>
              <div class="col-md-6">
                <h2 style="color:black;font-style: italic; text-align: center;">Cart</h2> 
              </div>
              <div class="col-md-3">
                <h6 style="color:black;font-style: italic; text-align: right;"><a style="color: black;" href="{{ URL::to('/cart') }}">cart</a></h6>
              </div>
            </div>
           
        <div class="row">
            <div class="col-lg-12 col-12">
              <div class="cart-table table-responsive mb-40">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="pro-thumbnail">Image</th>
                      <th class="pro-title">Code</th>
                      <th class="pro-title">Product</th>
                      <!-- <th class="pro-price">Price</th> -->
                      <th class="pro-quantity">Metal Type</th>
                      <th class="pro-quantity">Metal Colour</th>
                      <th class="pro-quantity">Size</th>
                      <th class="pro-quantity">Quantity</th>
                      <th class="pro-quantity">Ref</th>
                      <th class="pro-quantity">Notes</th>

                      <!-- <th class="pro-subtotal">Total</th> -->
                      <th class="pro-remove">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $allTotal = 0;
                    $VAT = 0;
                    ?>
                    @if($cartItem)
                    @foreach($cartItem as $id=>$item)
                    <tr id="cart_item-{{ $id }}">
                      <td class="pro-thumbnail"><img style="height: 75px;width: 75px;" src="{{asset($item['photo'])}}"></td>
                      <td width="10%" class="pro-quantity">
                        <div class="product-quantity quantity">
                          {{ $item['sku'] }}
                        </div>
                      </td>
                      <td width="10%" class="pro-quantity">
                        <div class="product-quantity quantity">
                          {{ $item['item_title'] }}
                        </div>
                      </td>
                      <td width="10%" class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          @if(!is_null($item['metal_type']))
                          {{ config('params.metal_type')[$item['metal_type']] }}
                          @endif
                        </div>
                      </td>
                      <td width="10%" class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          @if(!is_null($item['metal_colour']))
                          {{ config('params.metal_colour')[$item['metal_colour']] }}
                          @endif
                        </div>
                      </td>
                      <td width="10%" class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          {{ $item['cart_size'] }}
                        </div>
                      </td>
                      <td class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          {{ $item['quantity'] }}
                        </div>
                      </td>
                      <td class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          {{ $item['ref'] }}
                        </div>
                      </td><td class="pro-quantity text-center">
                        <div class="product-quantity quantity">
                          {{ $item['notes'] }}
                        </div>
                      </td>
                      <?php
                        $Total = $item['quantity'] * $item['price'];
                        $allTotal = $allTotal + $Total;
                        $VAT = $allTotal * 0.2;
                      ?>
                      <td width="10%" class="pro-remove text-center">
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="order-btn" style="color: blue;">Order</a>
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="edit-btn" style="color: blue;" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="remove-item-cart" title="Delete"><i style="color: red;" class="pe-7s-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>  
        </div>
      </div>
    </div>
<div class="modal" id="quick_view_item_details">

</div>
@endsection
@push('script')
<script type="text/javascript">
  $('.all-product').click(function(e){
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('all_product', 'yes');
    url.search = search_params.toString();
    window.location.href = url.toString();
  });
  $('.set-page').click(function(e){
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('all_product', 'no');
    url.search = search_params.toString();
    window.location.href = url.toString();
  });

  $(document).on("click", ".add-to-cart", function(e) {
        e.preventDefault();
        var itemId = $(this).attr('item-id');
        var itemQty = $('#item-qty').val();
        $.ajax({
            url: "{{ URL::to('add-to-cart')}}",
            data:{'item_id' : itemId, 'item_qty' : itemQty,'_token':"{{csrf_token()}}"},
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
  $(".remove-item-cart").click(function(event) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'item-remove-cart' + '/' + id,
            type: 'get',
            success: function(data) {
                location.reload();
            },
            error: function(result) {
                $("#quick_view_item_details").html("Sorry Cannot Load Data");
            }
          
        });
    });

  $(".order-btn").click(function(event){
    var id = $(this).attr('data-id');
      $.ajax({
          url: 'create-order' + '/' + id,
          type: 'get',
          success: function(data) {
              location.reload();
          },
          error: function(result) {
              $("#quick_view_item_details").html("Sorry Cannot Load Data");
          }
        
      });
  });


  $(".edit-btn").click(function(event){
    $("#quick_view_item_details").empty();
    var id = $(this).attr('data-id');
      $.ajax({
          url: 'edit-cart-item' + '/' + id,
          type: 'get',
          success: function(data) {
              $("#quick_view_item_details").html(data.html);
              $('#quick_view_item_details').modal('show'); // show bootstrap modal
          },
          error: function(result) {
              $("#quick_view_item_details").html("Sorry Cannot Load Data");
          }
        
      });
  });

  $(".quick_view_details").click(function(event) {
      $("#quick_view_item_details").empty();
    
      var id = $(this).attr('data-id');
      $.ajax({
          url: "{{ URL::to('item-details')}}" + '/' + id,
          type: 'get',
          success: function(data) {
              $("#quick_view_item_details").html(data.html);
              $('#quick_view_item_details').modal('show'); // show bootstrap modal
          },
          error: function(result) {
              $("#quick_view_item_details").html("Sorry Cannot Load Data");
          }
        
      });
    });
</script>
@endpush