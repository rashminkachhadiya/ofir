@extends('frontend.layouts.master')
@section('title', __('Cart'))
@section('content')
    <div class="auth-shell">
        <div class="auth-card auth-card--cart">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
                <a class="back-link" href="{{ URL::to('/') }}">{{ __('Home') }}</a>
                <h2 class="h4 mb-0 text-center font-italic">{{ __('Cart') }}</h2>
                <span class="d-none d-md-block"></span>
            </div>
        <div class="row">
            <div class="col-lg-12 col-12">
              <div class="cart-table table-responsive mb-40">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="pro-thumbnail">{{ __('Image') }}</th>
                      <th class="pro-title">{{ __('Code') }}</th>
                      <th class="pro-title">{{ __('Product') }}</th>
                      <!-- <th class="pro-price">Price</th> -->
                      <th class="pro-quantity">{{ __('Metal Type') }}</th>
                      <th class="pro-quantity">{{ __('Metal Colour') }}</th>
                      <th class="pro-quantity">{{ __('Size') }}</th>
                      <th class="pro-quantity">{{ __('Quantity') }}</th>
                      <th class="pro-quantity">{{ __('Ref') }}</th>
                      <th class="pro-quantity">{{ __('Notes') }}</th>

                      <!-- <th class="pro-subtotal">Total</th> -->
                      <th class="pro-remove">{{ __('Action') }}</th>
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
                        $quantity = isset($item['quantity']) ? (float) str_replace(',', '', $item['quantity']) : 0;
                        $price = isset($item['price']) ? (float) str_replace(',', '', $item['price']) : 0;
                        
                        $Total = $quantity * $price;
                        $allTotal += $Total;
                        $VAT = $allTotal * 0.2;
                      ?>
                      <td width="10%" class="pro-remove text-center">
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="order-btn" style="color: blue;">{{ __('Order') }}</a>
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="edit-btn" style="color: blue;" title="{{ __('Edit') }}"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-id="{{ $item['cart_id'] }}" class="remove-item-cart" title="{{ __('Delete') }}"><i style="color: red;" class="pe-7s-trash"></i></a>
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
