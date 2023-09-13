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
  /*display: table-cell;*/
  /*vertical-align: middle;*/
}
<?php
  $Catalogue = config('params.catalogue');
?>
</style>
    <div class="back">
        <div class="div-center">
            <div class="content row">
                @foreach($Catalogue as $key => $value)
                
                <div class="col-md-6">
                    <div class="minicart-catelogue-button">
                        <a class="btn btn-dark" href="{{ URL::to('/catalogue') }}/{{$key}}">{{ $value }}</a>
                    </div>
                </div>
                 @endforeach

                <div class="col-md-6">
                    <!-- <div class="minicart-button">
                        <a class="btn" href="">Cartier</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="">Cartier</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection