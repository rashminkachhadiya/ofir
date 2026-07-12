@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
    <x-auth-card>
        @guest
            <h1 class="auth-card__title">{{ __('This web Catalog only for trader') }}</h1>
        @else
            <h1 class="auth-card__title">{{ __('Hi, :name', ['name' => Auth()->user()->f_name]) }}</h1>
        @endguest

        <div class="btn-action-group mt-4">
            @guest
                <a class="btn-action" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn-action btn-action--outline" href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
                <a class="btn-action" href="{{ URL::to('/order') }}">{{ __('New Order') }}</a>
                <a class="btn-action" href="{{ URL::to('/my-account') }}">{{ __('My Account') }}</a>
                <a class="btn-action btn-action--outline" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                @if(Auth()->user()->is_visible == 1)
                    <a class="btn-action mt-2" href="{{ URL::to('/catalogue') }}">{{ __('Catalogue') }}</a>
                @endif
            @endguest
        </div>
    </x-auth-card>
@endsection
