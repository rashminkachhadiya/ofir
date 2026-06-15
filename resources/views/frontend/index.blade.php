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
  display: grid;
}

div.content {
  display: table-cell;
  vertical-align: middle;
}
</style>
    <div class="back row">
        <div class="div-center">
                @guest
                <h4 class="d-block" style="color: black;">{{ __('This web Catalog only for trader') }}</h4>
                @else
                <h4 class="d-block" style="color: black;">{{ __('Hi, :name', ['name' => Auth()->user()->f_name]) }}</h4>
                @endguest
            <div class="content">
                <div>
                    @guest
                    <div class="minicart-button">
                        <a class="btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                    <div>
                    @else
                    <div class="minicart-button">
                        <a class="btn" href="{{ URL::to('/order') }}">{{ __('New Order') }}</a>
                    </div>
                    <div class="minicart-button">
                        <a class="btn" href="{{ URL::to('/my-account') }}">{{ __('My Account') }}</a>
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

                    @if(Auth()->user()->is_visible == 1)
                    <div class="minicart-button mt-4">
                        <a class="btn" href="{{ URL::to('/catalogue') }}">{{ __('Catalogue') }}</a>
                    </div>
                    @endif
                     @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
