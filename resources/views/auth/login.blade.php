@extends('auth.layouts.app')
@section('title', __('Login'))
@section('content')
    <x-auth-card title="{{ __('Log In') }}" subtitle="{{ __('Enter your username and password to access your account') }}">
        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf

            <div class="form-group">
                <label for="username">{{ __('Username') }}</label>
                <input type="text" name="username" class="form-control" id="username"
                       value="{{ old('email') }}" required autocomplete="username"
                       placeholder="{{ __('Enter username') }}">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" class="form-control" name="password" id="password"
                       required autocomplete="current-password"
                       placeholder="{{ __('Enter password') }}">
                @if ($errors->has('password'))
                    <span class="is-invalid">{{ __('The password field is required.') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-dark btn-block mt-3">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-muted" style="font-size: 0.875rem;">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </x-auth-card>
@endsection
