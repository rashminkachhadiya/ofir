@extends('frontend.layouts.master')
@section('title', $blog->title ?? __('News'))
@section('content')
<section class="news-page">
    @if($blog)
        <article class="news-article">
            @if($blog->file_path)
                <img src="{{ asset($blog->file_path) }}" class="news-article__image"
                     alt="{{ $blog->title }}">
            @endif
            <div class="news-article__content">
                <h1 class="news-article__title">{{ $blog->title }}</h1>
                <div class="news-article__meta">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    <time datetime="{{ $blog->created_at }}">
                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                    </time>
                </div>
                <div class="news-article__body">
                    {!! nl2br(e($blog->description)) !!}
                </div>
                <a href="{{ url('/') }}" class="btn-action btn-action--outline mt-4">{{ __('Back to Home') }}</a>
            </div>
        </article>
    @else
        <div class="auth-shell">
            <div class="auth-card text-center">
                <p class="news-empty mb-4">{{ __('Sorry, nothing found.') }}</p>
                <a href="{{ url('/') }}" class="btn-action">{{ __('Back to Home') }}</a>
            </div>
        </div>
    @endif
</section>
@endsection
