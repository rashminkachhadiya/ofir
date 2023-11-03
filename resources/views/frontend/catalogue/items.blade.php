@extends('frontend.layouts.master_catalogue')
@section('title', 'Home')
@section('nav_link')
<a class="m-2 mt-0" style="font-size: 25px;cursor: pointer;" href="{{ URL::to('/catalogue/'.$mainCatalogue) }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg></a>
<a class="m-2 mt-0" style="font-size: 16px;cursor: pointer; color: black" href="{{ URL::to('/') }}">Home</a>
@endsection
@section('middle')
@endsection
@section('content')
<style type="text/css">
    .back {
  /*background: #e2e2e2;*/
  width: 100%;
  /*position: absolute;*/
  top: 0;
  bottom: 0;
}

.div-center {
  border-radius: 40px;
  width: 100%;
  height: 500px;
  background-color: #fff;
  /*position: absolute;*/
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
            <div class="mb-4 d-flex" style="border-bottom: 1px solid black;">
              <div class="col-md-4">
                <h2 style="color:black;font-style: italic; text-align: center;">{{ config('params.catalogue')[$mainCatalogue] }} <span style="font-size: 15px;">{{config('params.'.$mainCatalogue)[$subCatelogue]}}</span></h2> 
              </div>
              <div class="col-md-4">
                
              </div>
              <div class="col-md-2">
                <p style="color: black; margin: 0px;padding: 0px;">Metal</p>
                {!! Form::select('metal_colour', $metal ?? [],  $selectMetal ?? '', ['class' => 'form-control m-0 p-0','data-control'=>"select2", 'id'=>'metal']) !!}
              </div>
              <div class="col-md-2">
                <p style="color: black; margin: 0px;padding: 0px;">Gems</p>
                {!! Form::select('metal_colour', $gems ?? [],  $selectGem ?? '', ['class' => 'form-control m-0 p-0','data-control'=>"select2", 'id'=>'gems']) !!}
              </div>
            </div>
            <div class="row" style="height: 600px; overflow-y: auto;">
                @forelse($items as $item)
                  <div class="col-md-3 col-sm-6 text-center">
                    <div>
                      <!-- <img style="border: 1px solid black;" class="mb-1"
                      src="{{asset($item->photo) }}"
                      alt="product" width="180px" height="180px"> -->
                      <a data-bs-toggle="modal" data-id="{{ $item->id }}" class="quick_view_details" href="javascript:void(0);">
                        <img style="border: 1px solid black;" class="mb-1"
                        src="{{asset($item->photo) }}"
                        alt="product" width="180px" height="180px">
                      </a>
                    </div>
                    <div>
                    <div>
                      <strong><p class="m-0" style="color: black; text-align: center;word-wrap: break-word;">{{ $item->item_title }}</p></strong>
                    </div>
                    <div>
                      <p style="color:black; word-wrap: break-word;" class="text-center">{{ $item->sku }} - {{ $item->item_title_gram }}
                      @if(Auth::user()->stock_visible == 1)
                        @if($item->tot_qty > 0)
                          <span><i class="fa fa-circle" aria-hidden="true" style="color: green;font-size:7px !important; "></i></span>
                        @endif
                      @endif
                      </p>
                    </div>
                    </div>
                  </div>
                @empty
                  <div class="text-center">
                    <div>
                      <p style="color: black;" class="text-center">No items found</p>                      
                    </div>
                  </div>
                @endforelse
            </div>
            <div class="paginatoin-area text-center mt-0 mb-0 d-flex" style="border-top:1px solid black;">
                @if($page != 'all_product')
                {{ $items->appends(request()->input())->links('vendor.pagination.default') }}
                @else
                <div class="minicart-catelogue-button">
                  <a class="btn btn-dark set-page mb-1" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">Set Page</a>
                </div>
                @endif

                @if($page != 'all_product')
                <div class="minicart-catelogue-button">
                  <a class="ml-3 btn btn-dark all-product" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">All Product</a>
                </div>
                @endif
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
        var metalType = $('#metal_type').val();
        var weight = $('#weight').val();

        var gem = $('#gem').val();
        var shape = $('#shape').val();
        var metalColour = $('#metal_colour').val();
        var carat = $('#carat').val();
        var colour = $('#colour').val();

        var cleaerty = $('#cleaerty').val();
        var pcs = $('#pcs').val();

        var itemQty = $('#item-qty').val();
        var size = $('#size').val();
        var ref = $('#ref').val();
        var notes = $('#notes').val();
        $.ajax({
            url: "{{ URL::to('add-to-cart')}}",
            data:{'item_id' : itemId, 'item_qty' : itemQty,'size' : size,'ref' : ref,'notes':notes,'_token':"{{csrf_token()}}",'metal_type' : metalType,'weight' : weight,'gem' : gem,'shape' : shape,'metal_colour' : metalColour,'cleaerty': cleaerty,'carat': carat,'colour':colour,'pcs' : pcs},
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

  $(document).on("click", ".ask_for_price", function(e) {
        e.preventDefault();
        var itemId = $(this).attr('item-id');
        $.ajax({
            url: "{{ URL::to('ask-for-price')}}",
            data:{'item_id' : itemId},
            dataType: 'json',
            type: 'get',
            success: function(data) {
              console.log(data.data);
              setTimeout(function(){
                alert("$ " + data.data.price_usd + '\n' + "\xA3 " + data.data.price_pound + "\n" + "\u20AC " + data.data.price_eur + '\n' + "Notes : " + data.data.price_notes);
              }, 1500); 
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

    $("body").on("change","#metal",function(e){
        set_query_para('metal',$('#metal').val());
        location.reload();
    });

    $("body").on("change","#gems",function(e){
        set_query_para('gems',$('#gems').val());
        location.reload();
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