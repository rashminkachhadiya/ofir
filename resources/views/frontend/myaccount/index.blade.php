@extends('frontend.layouts.master')
@section('title', 'About Us')
@section('content')
<div class="shop-main-wrapper section-padding" style="background: #e2e2e2">
  <div class="container">
    <div class="section-bg-color">
      <div style="border:1px solid black; border-radius: 2rem !important;background-color: white; " class="row">
        <div style="border-right: 1px solid black; padding: 0px;" class="col-2">
          <div  class="nav flex-column nav-pills mt-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a> -->
            <a class="m-2 mt-0" style="font-size: 30px;cursor: pointer;" href="{{ URL::to('/') }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg></a>
            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">All Orders</a>
            <a class="nav-link" id="v-pills-invoice-tab" data-toggle="pill" href="#v-pills-invoice" role="tab" aria-controls="v-pills-invoice" aria-selected="false">Pending Orders</a>
            <a class="nav-link" id="v-pills-ready-tab" data-toggle="pill" href="#v-pills-ready" role="tab" aria-controls="v-pills-ready" aria-selected="false">Ready for Collection</a>
            <a class="nav-link" id="v-pills-my-cart-tab" data-toggle="pill" href="#v-pills-my-cart" role="tab" aria-controls="v-pills-my-cart" aria-selected="false">My Cart</a>
          </div>
        </div>
        <div class="col-10 mt-4">
          <div class="tab-content" id="v-pills-tabContent">
            <!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
              novalidate>
                <div class="row">
                  <input type="hidden" name="user_id" value="{{ $user->id }}">
                  <div class="col-6">
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab;"> First Name </label>
                      <input type="text" class="form-control" id="f_name" name="f_name" value="{{ $user->f_name }}" placeholder="" required>
                      <span id="error_f_name" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab;" > Last Name </label>
                      <input type="text" class="form-control" id="l_name" name="l_name" value="{{ $user->l_name }}" placeholder="" required>
                      <span id="error_l_name" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab;"> Email </label>
                      <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="" disabled>
                      <span id="error_email" class="has-error"></span>
                    </div>
                    @if($user->user_type == 0)
                    <div class="form-group col-md-12" id="company_div">
                      <label for="" style="color: #f195ab;"> Company </label>
                      <input type="text" class="form-control" id="company" name="company" value="{{ $user->company }}" placeholder="" required>
                      <span id="error_company" class="has-error"></span>
                    </div>
                    @endif
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab"> Address field 1 </label>
                      <input type="text" class="form-control" id="address_field_1" name="address_field_1" value="{{ $user->address_field_1 }}" placeholder="" required>
                      <span id="error_address_field_1" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab"> Address field 2 </label>
                      <input type="text" class="form-control" id="address_field_2" name="address_field_2" value="{{ $user->address_field_2 }}" placeholder="" required>
                      <span id="error_address_field_2" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab"> City </label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" placeholder="" required>
                      <span id="error_city" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab;"> Country </label>
                      <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}" placeholder="" required>
                      <span id="error_country" class="has-error"></span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab"> State/Province/County </label>
                      <input type="text" class="form-control" id="state_province_county" name="state_province_county" value="{{ $user->state_province_county }}" placeholder="" required>
                      <span id="error_state_province_county" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="" style="color: #f195ab"> Postcode </label>
                      <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}" placeholder="" required>
                      <span id="error_postcode" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="" style="color: #f195ab"> Telephone </label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}" placeholder="">
                        <span id="error_telephone" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="" style="color: #f195ab"> Mobile </label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder="" required>
                        <span id="error_mobile" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label style="color: #f195ab">Password:</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control',)) !!}
                        <span id="error_password" class="has-error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label style="color: #f195ab">Confirm Password:</label>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        <span id="error_confirm-password" class="has-error"></span>
                    </div>
                    @if($user->user_type == 0)
                    <div class="form-group col-md-12" id="vat_number_div">
                        <label for="" style="color: #f195ab"> VAT Number </label>
                        <input type="text" class="form-control" id="vat_number" name="vat_number" value="{{ $user->vat_number }}" placeholder="" required>
                        <span id="error_vat_number" class="has-error"></span>
                    </div>
                    @endif
                    @if($user->user_type == 0)
                    <div class="form-group col-md-12" id="refrences_div">
                        <label for="" style="color: #f195ab"> Refrences </label>
                        <input type="text" class="form-control" id="refrences" name="refrences" value="{{ $user->refrences }}" placeholder="" required>
                        <span id="error_refrences" class="has-error"></span>
                    </div>
                    @endif
                  </div>
                </div>
                <div class="text-center mb-2">
                  <button type="submit" style="background: #f195ab !important; color: black !important;" class="btn btn-cart">Submit</button>
                </div>
              </form>
            </div> -->
            <div class="d-flex" style="justify-content: space-between;">
              <div style="text-align: center;">
                <h4 class="d-block" style="color: black; text-align: center;">Hi {{Auth()->user()->f_name}}</h4>
              </div>
              <div class="d-flex">
                  
                  <div class="mr-1">
                      <a class="btn btn-xs btn-info user-view" id="viewbtn" href="javascript:void(0)">View</a>
                  </div>
                  <div class="mr-1">
                      <a class="btn btn-xs btn-success user-view-all" id="viewallbtn" href="javascript:void(0)">View All</a>
                  </div>
              </div>
            </div>
            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <div class="row">
                <div class="col-lg-12 col-12 p-0">
                  <div class="cart-table table-responsive mb-40" style="position: relative;height: 700px;overflow: auto;">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="1%" class="pro-thumbnail">Date</th>
                          <th class="pro-thumbnail">Image</th>
                          <th class="pro-title">Number</th>
                          <th class="pro-title">Category</th>
                          <th class="pro-price">Status</th>
                          <th class="pro-price">Size</th>
                          <th class="pro-price">Qty</th>
                          <th class="pro-price">Colour</th>
                          <th class="pro-price">Carat</th>
                          <th class="pro-price">Ref.</th>
                          <th class="pro-price">Est.</th>
                          <th class="pro-remove">Action</th>
                          <th><div class="btn-group">
                            <div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" master-checkbox me-9" style="margin-left: 8px;" type="checkbox" name="ids[]"/>
                               </div>
                             </div>
                           </th>
                        </tr>
                      </thead>
                      <tbody id="v-pills-profile_table">
                        @forelse($orders as $order)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/y') }}</td>
                            <td style="width: 80px !important; height: 80px !important;padding: 0px;">
                                @foreach($order->orderPicture as $image)
                                <div class="col-md-2 p-0">
                                  <img width="80px;" height="80px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                </div>
                                @php
                                  break;
                                @endphp
                                @endforeach
                            </td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ config('params.categories')[$order->category_id] }}</td>
                            <td>{{ config('params.order_status')[$order->order_status] }}</td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>@if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                    @endif</td>
                            <td>{{ $order->carat }}</td>
                            <td>{{ $order->ref }}</td>
                            <td>
                              @if(!is_null($order->est_price_currency))
                                {{config('params.currency')[$order->est_price_currency]}}{{ $order->tot_est_price }}
                              @endif
                            </td>
                            <td style="width: 150px;">
                              <div class="btn-group mb-1">
                                <a href="javascript:void(0)"  id="{{ $order->id }}" class="btn btn-xs btn-success margin-r-5 view" style="padding: 0.1rem 0.32rem !important;" title="View"><i class="fa fa-eye fa-fw"></i> </a>
                              </div>
                              @if($order->order_status == 0)
                              <div class="btn-group mb-1">
                                <a href="javascript:void(0)"  id="{{ $order->id }}" class="btn btn-xs btn-info margin-r-5 order_confim" style="padding: 0.1rem 0.35rem !important;" title="Cofirm Order"><i class="fa fa-check"></i> </a>
                              </div>
                              @endif
                              @if($order->order_status == 3)
                              <div class="btn-group mb-1">
                                <a href="javascript:void(0)"  id="{{ $order->id }}" class="btn btn-xs btn-danger margin-r-5 order_cancel" style="padding: 0.1rem 0.5rem !important;" title="Cancle Order"><i class="fa fa-times"></i> </a>
                              </div>
                              @endif
                            </td>
                            <td>
                              <div class="btn-group"><div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" child-checkbox me-9" type="checkbox" value="{{ $order->id }}" name="ids[]"/>
                               </div></div>
                            </td>
                          </tr>
                        @empty
                        <tr>
                          <td colspan="12">No Any Order</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
            </div>
            <div class="tab-pane fade"  id="v-pills-invoice"  role="tabpanel" aria-labelledby="v-pills-invoice-tab">
              <div class="row">
                <div class="col-lg-12 col-12 p-0">
                  <div class="cart-table table-responsive mb-40" style="position: relative;height: 700px;overflow: auto;">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="pro-thumbnail">Date</th>
                          <th class="pro-thumbnail">Image</th>
                          <th class="pro-title">Number</th>
                          <th class="pro-title">Category</th>
                          <th class="pro-price">Status</th>
                          <th class="pro-price">Size</th>
                          <th class="pro-price">Qty</th>
                          <th class="pro-price">Colour</th>
                          <th class="pro-price">Carat</th>
                          <th class="pro-price">Est. Price</th>
                          <th class="pro-remove">Action</th>
                          <th><div class="btn-group">
                            <div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" master-checkbox me-9" style="margin-left: 8px;" type="checkbox" name="ids[]"/>
                               </div>
                             </div>
                           </th>
                        </tr>
                      </thead>
                      <tbody id="v-pills-invoice_table">
                        @forelse($pendingOrders as $order)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 80px !important; height: 80px !important;padding: 0px;">
                                @foreach($order->orderPicture as $image)
                                <div class="col-md-2 p-0">
                                  <img width="80px;" height="80px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                </div>
                                @php
                                  break;
                                @endphp
                                @endforeach
                            </td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ config('params.categories')[$order->category_id] }}</td>
                            <td>{{ config('params.order_status')[$order->order_status] }}</td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>@if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                    @endif</td>
                            <td>{{ $order->carat }}</td>
                            <td>
                              @if(!is_null($order->est_price_currency))
                                {{config('params.currency')[$order->est_price_currency]}}{{ $order->tot_est_price }}
                              @endif
                            </td>
                            <td style="width: 90px;">
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.5rem !important;"  id="{{ $order->id }}" class="btn btn-xs btn-success margin-r-5 view" title="View"><i class="fa fa-eye fa-fw"></i> </a>
                              </div>
                              @if($order->order_status == 0)
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.5rem !important;" id="{{ $order->id }}" class="btn btn-xs btn-info margin-r-5 order_confim" title="Cofirm Order"><i class="fa fa-check"></i> </a>
                              </div>
                              @endif
                              @if($order->order_status == 3)
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.7rem !important;"  id="{{ $order->id }}" class="btn btn-xs btn-danger margin-r-5 order_cancel" title="Cancle Order"><i class="fa fa-times"></i> </a>
                              </div>
                              @endif
                            </td>
                            <td>
                              <div class="btn-group"><div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" child-checkbox me-9" type="checkbox" value="{{ $order->id }}" name="ids[]"/>
                               </div></div>
                            </td>
                          </tr>
                        @empty
                        <tr>
                          <td colspan="12">No Any Order</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
            </div>
            <div class="tab-pane fade"  id="v-pills-ready"  role="tabpanel" aria-labelledby="v-pills-ready-tab">
              <div class="row">
                <div class="col-lg-12 col-12 p-0">
                  <div class="cart-table table-responsive mb-40" style="position: relative;height: 700px;overflow: auto;">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="pro-thumbnail">Date</th>
                          <th class="pro-thumbnail">Image</th>
                          <th class="pro-title">Number</th>
                          <th class="pro-title">Category</th>
                          <th class="pro-price">Status</th>
                          <th class="pro-price">Size</th>
                          <th class="pro-price">Qty</th>
                          <th class="pro-price">Colour</th>
                          <th class="pro-price">Carat</th>
                          <th class="pro-price">Est. Price</th>
                          <th class="pro-remove">Action</th>
                          <th><div class="btn-group">
                            <div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" master-checkbox me-9" style="margin-left: 8px;" type="checkbox" name="ids[]"/>
                               </div>
                             </div>
                           </th>
                        </tr>
                      </thead>
                      <tbody id="v-pills-ready_table">
                        @forelse($readyOrders as $order)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 80px !important; height: 80px !important;padding: 0px;">
                                @foreach($order->orderPicture as $image)
                                <div class="col-md-2 p-0">
                                  <img width="80px;" height="80px" src="{{asset('assets/images/users/order/').'/'.$image->images}}">
                                </div>
                                @php
                                  break;
                                @endphp
                                @endforeach
                            </td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ config('params.categories')[$order->category_id] }}</td>
                            <td>{{ config('params.order_status')[$order->order_status] }}</td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>@if(!is_null($order->metal_colour))
                                    {{ config('params.metal_colour')[$order->metal_colour] }}
                                    @endif</td>
                            <td>{{ $order->carat }}</td>
                            <td>
                              @if(!is_null($order->est_price_currency))
                                {{config('params.currency')[$order->est_price_currency]}}{{ $order->tot_est_price }}
                              @endif
                            </td>
                            <td style="width: 90px;">
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.5rem !important;"  id="{{ $order->id }}" class="btn btn-xs btn-success margin-r-5 view" title="View"><i class="fa fa-eye fa-fw"></i> </a>
                              </div>
                              @if($order->order_status == 0)
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.5rem !important;"  id="{{ $order->id }}" class="btn btn-xs btn-info margin-r-5 order_confim" title="Cofirm Order"><i class="fa fa-check"></i> </a>
                              </div>
                              @endif
                              @if($order->order_status == 3)
                              <div class="btn-group">
                                <a href="javascript:void(0)" style="padding: 0.1rem 0.5rem !important;"  id="{{ $order->id }}" class="btn btn-xs btn-danger margin-r-5 order_cancel" title="Cancle Order"><i class="fa fa-times"></i> </a>
                              </div>
                              @endif
                            </td>
                            <td>
                              <div class="btn-group"><div class="form-check form-check-custom form-check-sm">
                                  <input style="width:30px; height:23px;" class=" child-checkbox me-9" type="checkbox" value="{{ $order->id }}" name="ids[]"/>
                               </div></div>
                            </td>
                          </tr>
                        @empty
                        <tr>
                          <td colspan="12">No Any Order</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
            </div>
            <div class="table-pane fade" id="v-pills-my-cart" role="tabpanel" aria-labelledby="v-pills-my-cart-tab">
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
                          {{ $item['metal_colour'] }}
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
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 65%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal_data"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="quick_view_item_details">

</div>
@endsection
@push('script')
<script type="text/javascript">

    $(document).on("click", ".view", function () {
        $("#modal_data").empty();
        $('.modal-title').text('Order Information'); // Set Title to Bootstrap modal title
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/order' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); // show bootstrap modal
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
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

    $(document).on("click", ".order_confim", function () {
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/order-confim' + '/' + id,
            type: 'get',
            success: function (data) {
              location.reload();
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });

    $(document).on("click", ".user-view", function () {
         var allVals = [];
          var li = document.getElementsByClassName('tab-pane fade show active')[0].id;

          $("#"+ li + "_table input[name='ids[]']:checked").each(function() {
              allVals.push($(this).attr('value'));
          });
          set_query_para("ids",allVals);
          location.reload();
    });

    $(document).on("click", ".user-view-all", function () {
        var URL = "{!! URL::to('my-account') !!}";
         window.open(URL,"_self");
    });

    $(document).on("click", ".order_cancel", function () {
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/order-cancel' + '/' + id,
            type: 'get',
            success: function (data) {
              location.reload();
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });
    
    $(document).on("click", ".view_invoice", function () {
        $("#modal_data").empty();
        $('.modal-title').text('View Invoice'); // Set Title to Bootstrap modal title
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/invoice' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); // show bootstrap modal
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });

    $(document).on("click", ".cancel", function () {
        $("#modal_data").empty();
        $('.modal-title').text('Cancle Order'); // Set Title to Bootstrap modal title
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/cancel-order' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); // show bootstrap modal
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });

  $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Enter Role Name'
                }
            },
            submitHandler: function (form) {

                var list_id = [];
                $(".data-check:checked").each(function () {
                    list_id.push(this.value);
                });

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);
                myData.append('roles', list_id);
                $.ajax({
                        url: '/save-user-details',
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

                // swal({
                //     title: "Confirm to assign " + list_id.length + " roles",
                //     text: "Assign Role",
                //     type: "warning",
                //     showCancelButton: true,
                //     closeOnConfirm: false,
                //     showLoaderOnConfirm: true,
                //     confirmButtonClass: "btn-danger",
                //     confirmButtonText: "Yes, Assign!"
                // }, function () {
                // });

            }
            // <- end 'submitHandler' callback
        });
  $('body').on("change",".master-checkbox",function(e){
            $(".child-checkbox:not(:disabled)").prop('checked', $(this).prop('checked'));
        });
      function set_query_para($key,$data)
    {
        var url_string = "";
        var search = ltrim(window.location.search,"?")
        var search_join = [];
        var $target_found = false;
        var search_split = search.split("&");
        if(search!="")
        {
            $.each(search_split,function($index,$value)
            {
                var $value_split = $value.split("=");
                if($value_split.length=2)
                {
                    if($value_split[0]==$key)
                    {
                        $value_split[1] = $data
                        $target_found = true;
                    }
                }

                var $value_join = $value_split.join("=");

                search_join.push($value_join);
          });
        }

        if(!$target_found)
        {
          search_join.push($key+"="+$data)
        }

        url_string  +=("?"+(search_join.join("&")));

        history.pushState(null,null,url_string);
    }
    function ltrim(str, characters)
{
    var nativeTrimLeft = String.prototype.trimLeft;
    str = makeString(str);
    if (!characters && nativeTrimLeft) return nativeTrimLeft.call(str);
    characters = defaultToWhiteSpace(characters);
    return str.replace(new RegExp('^' + characters + '+'), '');
}
function makeString(object)
{
    if (object == null) return '';
    return String(object);
}
function defaultToWhiteSpace(characters)
{
    if (characters == null){
        return '\\s';
    }
    else if (characters.source){
    return characters.source;
    }
    else{
        return '[' + escapeRegExp(characters) + ']';
    }
}
function escapeRegExp(str)
{
    return makeString(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
}
</script>
@endpush