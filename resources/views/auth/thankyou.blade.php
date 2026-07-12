@extends('auth.layouts.app')
@section('title', __('Thank You'))
@section('content')
    <x-auth-card>
        <div class="text-center">
            <div class="mb-4">
                <i class="fa fa-check-circle" style="font-size: 3rem; color: var(--color-success);"></i>
            </div>
            <h1 class="auth-card__title">{{ __('Thank You!') }}</h1>
            <p class="auth-card__subtitle">
                {{ __('Thank you for your registration. Shortly you will receive an email with your username and password.') }}
            </p>
            <a href="{{ route('login') }}" class="btn-action mt-4">{{ __('Go to Login') }}</a>
        </div>
    </x-auth-card>
@endsection
