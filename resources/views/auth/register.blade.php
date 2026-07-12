@extends('auth.layouts.app')
@section('title', __('Register'))
@section('content')
    <x-auth-card title="{{ __('Registration') }}" subtitle="{{ __('Create your trader account') }}" wide>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="f_name">{{ __('First Name') }} <span class="text-danger">*</span></label>
                <input type="text" name="f_name" class="form-control" id="f_name"
                       value="{{ old('f_name') }}" required>
            </div>

            <div class="form-group">
                <label for="l_name">{{ __('Last Name') }}</label>
                <input type="text" name="l_name" class="form-control" id="l_name"
                       value="{{ old('l_name') }}">
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email address') }} <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" id="email"
                       value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="is-invalid">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="mobile">{{ __('Mobile') }}</label>
                <input type="text" name="mobile" class="form-control" id="mobile"
                       value="{{ old('mobile') }}">
            </div>

            <div class="form-group">
                <label for="hear_about">{{ __('How did you hear about us?') }}</label>
                <input type="text" name="hear_about" class="form-control" id="hear_about"
                       value="{{ old('hear_about') }}">
            </div>

            <button type="submit" class="btn btn-dark btn-block mt-3">
                {{ __('Register') }}
            </button>
        </form>
    </x-auth-card>
@endsection
