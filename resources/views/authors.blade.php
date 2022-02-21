@extends('layouts.app')
@section('index')

<header class="tm-header" id="tm-header">
    <div class="tm-header-wrapper">
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="tm-site-header">
            <div class="mb-3 mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>
            <h1 class="text-center">{{ __('books_blog') }}</h1>
        </div>
        <nav class="tm-nav" id="tm-nav">
            <ul>
                <li class="tm-nav-item "><a href="{{ route('main') }}" class="tm-nav-link">
                    <i class="fas fa-home"></i>
                    {{ __('home') }}
                </a></li>
                <li class="tm-nav-item active"><a href="{{ route('authors') }}" class="tm-nav-link">
                    <i class="fas fa-users"></i>
                    {{ __('authors') }}
                </a></li>
                <li class="tm-nav-item"><a href="{{ route('books') }}" class="tm-nav-link">
                    <i class="fas fa-book"></i>
                    {{ __('books') }}
                </a></li>
                <li class="tm-nav-item"><a href="{{ route('contact') }}" class="tm-nav-link">
                    <i class="far fa-comments"></i>
                   {{ __('contact') }}
                </a></li>
            </ul>
        </nav>
        <div class="tm-mb-65">
            <a rel="nofollow" href="https://fb.com/" class="tm-social-link">
                <i class="fab fa-facebook tm-social-icon"></i>
            </a>
            <a href="https://twitter.com" class="tm-social-link">
                <i class="fab fa-twitter tm-social-icon"></i>
            </a>
            <a href="https://instagram.com" class="tm-social-link">
                <i class="fab fa-instagram tm-social-icon"></i>
            </a>
            <a href="https://linkedin.com" class="tm-social-link">
                <i class="fab fa-linkedin tm-social-icon"></i>
            </a>
        </div>
    </div>
</header>

@php
    $authors = session()->get('authors');
@endphp

    <div class="container-fluid">
        <main class="tm-main text-right">
            <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" action="{{ route('authors_scearch') }}" class="form-inline tm-mb-80 tm-search-form">
                        <input class="form-control tm-search-input" name="query" type="text" placeholder="{{ __('search') }}..." aria-label="Search">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>


            <div class="row ">
                @foreach ($authors as $author)
                    <div class="col-sm">
                        <article class="col-12 col-md-6 tm-post">
                            <hr class="tm-hr-primary">
                            <a href="{{ route('author',['id'=>$author->id]) }}" class="effect-lily tm-post-link tm-pt-60">
                                <div class="tm-post-link-inner">
                                    <img src="{{ asset('images/authors/'.$author->image) }}" alt="Image" class="img-fluid">
                                </div>
                                {{--  <span class="position-absolute tm-new-badge">New</span>  --}}
                                <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $author->name }}</h2>
                            </a>
                            <p class="tm-pt-30">
                                {{ $author->text }}
                            </p>

                        </article>

                    </div>
                @endforeach

            </div>
        </main>
    </div>
@endsection

