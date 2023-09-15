@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
<style type="text/css">
    .back {
  background: #e2e2e2;
  width: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
}

.div-center {
  border-radius: 40px;
  width: 650px;
  height: 500px;
  background-color: #fff;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
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

</style>
    <div class="back">
        <div class="div-center">
            <div class="text-center mb-4">
              <h2 style="color:black;font-style: italic">{{ config('params.catalogue')[$items[0]->catalogue_id] }}</h2>
            </div>
            <div class="row">
                @foreach($items as $item)
                  <div class="col-md-4">
                    <img style="border: 1px solid black;" class="mb-1"
                      src="{{asset($item->photo) }}"
                      alt="product" width="180px" height="180px">
                    <strong><p class="m-0" style="color: black; text-align: center;word-wrap: break-word;width: 180px;height: 25px;">{{ $item->item_title }}</p></strong>
                    <p style="color:black; word-wrap: break-word;" class="text-center">{{ $item->description }}</p>
                  </div>
                @endforeach
            </div>
            <div class="paginatoin-area text-center mt-0 mb-0">
                @if($page != 'all_product')
                {{ $items->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                @else
                <div>
                  <button class="btn btn-primary set-page mb-1">Set Page</button>
                </div>
                @endif
                <div>
                  <button class="btn btn-primary all-product">All Product</button>
                </div>
            </div>
        </div>
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
</script>
@endpush