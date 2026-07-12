@extends('frontend.layouts.master_catalogue')
@section('title', __('Catalogue'))
@section('nav_link')
    <a href="{{ URL::to('/') }}" class="back-link" aria-label="{{ __('Back to home') }}">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true"><path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
        <span>{{ __('Home') }}</span>
    </a>
@endsection
@section('content')
@php
    $Catalogue = config('params.catalogue');
@endphp
    <x-auth-card :catalogue="true" title="{{ __('Select Catalogue') }}">
        <div class="catalogue-grid">
            @foreach($Catalogue as $key => $value)
                @if(json_decode(Auth::user()->catalogue_store)[$key] == 1)
                    <div class="minicart-catelogue-button">
                        <a href="{{ URL::to('/catalogue') }}/{{ $key }}">{{ $value }}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </x-auth-card>
@endsection
