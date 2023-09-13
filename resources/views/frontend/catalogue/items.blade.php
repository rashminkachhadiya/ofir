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
  width: 600px;
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
            <div class="content row">
                @foreach($items as $item)
                  <div class="col-md-4">
                    <img class="mb-1"
                      src="{{asset($item->photo) }}"
                      alt="product" width="150px" height="150px">
                    <strong><p style="color: black; text-align: center;">{{ $item->item_title }}</p></strong>
                  </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection