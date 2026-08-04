@extends('frontend.layouts.master_catalogue')
@section('title', 'Home')
@section('nav_link')
    <a href="{{ URL::to('/catalogue/'.$mainCatalogue) }}" class="back-link" aria-label="{{ __('Back') }}">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
    </a>
    <a href="{{ URL::to('/') }}" class="back-link"><span>{{ __('Home') }}</span></a>
@endsection
@section('content')
    <div class="auth-shell">
        <div class="auth-card auth-card--cart">
            <div class="mb-4 pb-3 border-bottom">
                <h2 class="h4 text-center font-italic mb-0">
                    {{ $catalogueTitle ?? '' }}
                    <span class="d-block d-md-inline" style="font-size: 0.875rem;">{{ $subCatalogueName ?? '' }}</span>
                </h2>
            </div>
            <div class="catalogue-toolbar row">
              <div class="col-md-4 col-lg-2">
                <label class="small text-muted mb-1">{{ __('Metal') }}</label>
                {!! Form::select('metal_colour', $metal ?? [], $selectMetal ?? '', ['class' => 'form-control form-control-sm', 'data-control' => 'select2', 'id' => 'metal']) !!}
              </div>
              <div class="col-md-4 col-lg-2">
                <label class="small text-muted mb-1">{{ __('Gems') }}</label>
                {!! Form::select('metal_colour', $gems ?? [], $selectGem ?? '', ['class' => 'form-control form-control-sm', 'data-control' => 'select2', 'id' => 'gems']) !!}
              </div>
            </div>
            <div class="row item-div account-table-scroll">
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
                      <p style="color: black;" class="text-center">{{ __('No items found') }}</p>                      
                    </div>
                  </div>
                @endforelse
            </div>
            <div class="paginatoin-area text-center mt-0 mb-0 d-flex" style="border-top:1px solid black;">
                @if($page != 'all_product')
                {{ $items->appends(request()->input())->links('vendor.pagination.default') }}
                @else
                <div class="minicart-catelogue-button">
                  <a class="btn btn-dark set-page mb-1" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">{{ __('Set Page') }}</a>
                </div>
                <div class="minicart-catelogue-button">
                  <a class="scroll-top ml-2 btn btn-dark mb-1" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">{{ __('Back to Top') }}</a>
                </div>
                @endif

                @if($page != 'all_product')
                <div class="minicart-catelogue-button">
                  <a class="ml-3 btn btn-dark all-product" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">{{ __('All Product') }}</a>
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
  $('.scroll-top').on('click', function (event) {
    $('.item-div').animate({
      scrollTop: 0
    }, 1000);
  });

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
