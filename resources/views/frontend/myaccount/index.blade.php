@extends('frontend.layouts.master_catalogue')
@section('title', __('My Account'))

@section('nav_link')
    <a class="navbar-brand mb-0" href="{{ URL::to('/') }}">LEBAR</a>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('/assets/css/account-page.css') }}">
@endpush

@section('content')
<div class="account-layout">
    <div class="container account-container">
        <div class="account-panel">
            <div class="row no-gutters account-panel__row">
                <div class="col-lg-3 account-sidebar">
                    <div class="account-sidebar__head">
                        <a href="{{ URL::to('/') }}" class="account-back-link" aria-label="{{ __('Back to home') }}">
                            <i class="fa fa-arrow-left"></i>
                            <span>{{ __('Back') }}</span>
                        </a>
                        <p class="account-sidebar__label">{{ __('My Account') }}</p>
                    </div>
                    <div class="account-nav nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                            <i class="fa fa-list-alt"></i>
                            <span>{{ __('All Orders') }}</span>
                        </a>
                        <a class="nav-link" id="v-pills-invoice-tab" data-toggle="pill" href="#v-pills-invoice" role="tab" aria-controls="v-pills-invoice" aria-selected="false">
                            <i class="fa fa-clock-o"></i>
                            <span>{{ __('Pending Orders') }}</span>
                        </a>
                        <a class="nav-link" id="v-pills-ready-tab" data-toggle="pill" href="#v-pills-ready" role="tab" aria-controls="v-pills-ready" aria-selected="false">
                            <i class="fa fa-check-circle"></i>
                            <span>{{ __('Ready for Collection') }}</span>
                        </a>
                        <a class="nav-link" id="v-pills-my-cart-tab" data-toggle="pill" href="#v-pills-my-cart" role="tab" aria-controls="v-pills-my-cart" aria-selected="false">
                            <i class="fa fa-shopping-bag"></i>
                            <span>{{ __('My Cart') }}</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-9 account-content">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="account-header">
                            <div>
                                <p class="account-header__eyebrow">{{ __('Welcome back') }}</p>
                                <h1 class="account-header__title">{{ __('Hi, :name', ['name' => Auth()->user()->f_name]) }}</h1>
                            </div>
                            <div class="account-header__actions">
                                <a class="btn btn-outline-primary btn-sm user-view" id="viewbtn" href="javascript:void(0)">
                                    <i class="fa fa-filter mr-1"></i>{{ __('View Selected') }}
                                </a>
                                <a class="btn btn-primary btn-sm user-view-all" id="viewallbtn" href="javascript:void(0)">
                                    {{ __('View All') }}
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            @include('frontend.myaccount.partials.orders-table', [
                                'orders' => $orders,
                                'tableId' => 'v-pills-profile_table',
                                'showRef' => true,
                            ])
                        </div>

                        <div class="tab-pane fade" id="v-pills-invoice" role="tabpanel" aria-labelledby="v-pills-invoice-tab">
                            @include('frontend.myaccount.partials.orders-table', [
                                'orders' => $pendingOrders,
                                'tableId' => 'v-pills-invoice_table',
                                'showRef' => false,
                            ])
                        </div>

                        <div class="tab-pane fade" id="v-pills-ready" role="tabpanel" aria-labelledby="v-pills-ready-tab">
                            @include('frontend.myaccount.partials.orders-table', [
                                'orders' => $readyOrders,
                                'tableId' => 'v-pills-ready_table',
                                'showRef' => false,
                            ])
                        </div>

                        <div class="tab-pane fade" id="v-pills-my-cart" role="tabpanel" aria-labelledby="v-pills-my-cart-tab">
                            @include('frontend.myaccount.partials.cart-table', ['cartItem' => $cartItem])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal account-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Modal title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal_data"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal account-modal" id="quick_view_item_details"></div>
@endsection

@push('script')
<script type="text/javascript">

    $(document).on("click", ".view", function () {
        $("#modal_data").empty();
        $('.modal-title').text("{{ __('Order Information') }}");
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/order' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show');
            },
            error: function (result) {
                $("#modal_data").html("{{ __('Sorry Cannot Load Data') }}");
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
                $("#quick_view_item_details").html("{{ __('Sorry Cannot Load Data') }}");
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
                $("#quick_view_item_details").html("{{ __('Sorry Cannot Load Data') }}");
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
                $('#quick_view_item_details').modal('show');
            },
            error: function(result) {
                $("#quick_view_item_details").html("{{ __('Sorry Cannot Load Data') }}");
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
                $("#modal_data").html("{{ __('Sorry Cannot Load Data') }}");
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
                $("#modal_data").html("{{ __('Sorry Cannot Load Data') }}");
            }
        });
    });

    $(document).on("click", ".view_invoice", function () {
        $("#modal_data").empty();
        $('.modal-title').text("{{ __('View Invoice') }}");
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/invoice' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show');
            },
            error: function (result) {
                $("#modal_data").html("{{ __('Sorry Cannot Load Data') }}");
            }
        });
    });

    $(document).on("click", ".cancel", function () {
        $("#modal_data").empty();
        $('.modal-title').text("{{ __('Cancel Order') }}");
        var id = $(this).attr('id');
        $.ajax({
            url: 'my-account/cancel-order' + '/' + id,
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show');
            },
            error: function (result) {
                $("#modal_data").html("{{ __('Sorry Cannot Load Data') }}");
            }
        });
    });

  $('#edit').validate({
            rules: {
                name: {
                    required: true
                }
            },
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
                                $("#submit").prop('disabled', false);
                                $("html, body").animate({scrollTop: 0}, "slow");
                                $('#myModal').modal('hide');

                            } else if (data.type === 'error') {
                                if (data.errors) {
                                    $.each(data.errors, function (key, val) {
                                        $('#error_' + key).html(val);
                                    });
                                }
                                $("#status").html(data.message);
                                $('#loader').hide();
                                $("#submit").prop('disabled', false);
                                swal("Error sending!", "Please try again", "error");

                            }

                        }
                    });
            }
        });
  $('body').on("change",".master-checkbox",function(e){
            $(this).closest('table').find(".child-checkbox:not(:disabled)").prop('checked', $(this).prop('checked'));
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
