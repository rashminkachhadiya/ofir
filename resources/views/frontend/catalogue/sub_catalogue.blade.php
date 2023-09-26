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
  height: 400px;
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
  display: table-cell;
  /*vertical-align: middle;*/
}
</style>
    <div class="back row">
        <div class="div-center">
            <div class="mb-4 d-flex">
              <div class="col-md-3">
                <a class="m-2 mt-0" style="font-size: 25px;cursor: pointer;" href="{{ URL::to('/catalogue') }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg></a>

                <a class="m-2 mt-0" style="font-size: 16px;cursor: pointer; color: black" href="{{ URL::to('/') }}">Home</a>
              </div>
              <div class="text-center col-md-6">
                <h2 style="color:black;font-style: italic">{{ $catalogueTitle }}</h2>
              </div>
            </div>
            <div class="content d-flex">
                <div class="col-md-6">
                    @foreach($subCatalogue as $key => $value)
                      <div class="minicart-catelogue-button">
                          <a class="btn btn-dark" href="{{ URL::to('/catalogue') }}/{{$catalogueId}}/{{$key}}">{{ $value }}</a>
                      </div>
                    @endforeach
                    <!-- <div class="minicart-button">
                        <a class="btn" href="">Cartier</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection