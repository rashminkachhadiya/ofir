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
  width: 400px;
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
  vertical-align: middle;
}
</style>
    <div class="back row">
        <div class="div-center">
            <div class="content">
                <div>
                    @guest
                    <div class="minicart-button">
                        <a class="btn" href="{{ route('login') }}">Login</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="{{ route('register') }}">Register</a>
                    </div>
                    <div>
                    @else
                    <div class="minicart-button">
                        <a class="btn" href="{{ URL::to('/order') }}">New Order</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="{{ URL::to('/my-account') }}">My Account</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                     @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection