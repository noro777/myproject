@extends('layouts.app')
@section('index')



<header class="tm-header" id="tm-header">
    @auth
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <div>
        <button class="btn btn-primary" type="submit">{{ __('logout') }}</button>
    </div>

</form>
@else
        <div>
            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('login') }}</a>
            <a class="btn btn-primary" href="{{ route('register') }}">{{ __('register') }}</a>
        </div>

@endauth
    <a href="{{route('lang',['lang'=>'hy'])}}" class="btn btn-primary">{{__('hay')}}</a>
    <a href="{{route('lang',['lang'=>'ru'])}}" class="btn btn-primary">{{__('ru')}}</a>
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
                <li class="tm-nav-item active"><a href="{{ route('main') }}" class="tm-nav-link">
                    <i class="fas fa-home"></i>
                    {{ __('home') }}
                </a></li>
                <li class="tm-nav-item"><a href="{{ route('authors') }}" class="tm-nav-link">
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


    <div class="container-fluid">
        <main class="tm-main text-right">
            <div class="row ">
                @foreach ($books as $book)
                <div class="col-sm">
                    <article class="col-12 col-md-6 tm-post">
                        <hr class="tm-hr-primary">
                        <a href="{{ route('book',['id'=>$book->id]) }}" class="effect-lily tm-post-link tm-pt-60">
                            <div class="tm-post-link-inner">
                                <img src="{{ asset('images/books/'.$book->image) }}" alt="Image" class="img-fluid">
                            </div>
                            {{--  <span class="position-absolute tm-new-badge">New</span>  --}}
                            <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $book->name }}</h2>
                        </a>
                        <p class="tm-pt-30">
                            {{ $book->text }}

                        </p>
                    </article>

                </div>
                @endforeach

            </div>
                <div class="d-block ">
                    <a href="{{ route('books') }}" class="btn btn-primary">{{ __('all_books') }} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                  </svg></a>
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
                                    <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $author->name }}</h2>
                                </a>
                                <p class="tm-pt-30">
                                    {{ $author->text }}
                                </p>

                            </article>

                        </div>
                        @endforeach
                </div>

                    <div class="d-inline">
                    <a href="{{ route('authors') }}" class="btn btn-primary">{{ __('all_authors') }}  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                  </svg></a>
                </div>


        </main>
    </div>
@endsection

