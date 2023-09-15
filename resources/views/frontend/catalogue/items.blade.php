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
  width: 650px;
  height: 500px;
  background-color: #e2e2e2;
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
            <div class="text-center mb-4">
              <h2 style="color:black;font-style: italic">{{ config('params.catalogue')[$items[0]->catalogue_id] }}</h2>
            </div>
            <div class="row">
                @foreach($items as $item)
                  <div class="col-md-4 text-center">
                    <div>
                      <img style="border: 1px solid black;" class="mb-1"
                      src="{{asset($item->photo) }}"
                      alt="product" width="180px" height="180px">
                    </div>
                    <div>
                      <strong><p class="m-0" style="color: black; text-align: center;word-wrap: break-word;height: 25px;">{{ $item->item_title }}</p></strong>
                      <p style="color:black; word-wrap: break-word;" class="text-center">{{ $item->description }}</p>
                    </div>
                  </div>
                @endforeach
            </div>
            <div class="paginatoin-area text-center mt-0 mb-0 d-flex">
                @if($page != 'all_product')
                {{ $items->appends(request()->input())->links('vendor.pagination.default') }}
                @else
                <div class="minicart-catelogue-button">
                  <a class="btn btn-dark set-page mb-1" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">Set Page</a>
                </div>
                @endif
                <div class="minicart-catelogue-button">
                  <a class="ml-3 btn btn-dark all-product" style="font-size: 12px !important;padding: 5px 7px !important;border-radius: 8px !important;">All Product</a>
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