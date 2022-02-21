@extends('layouts.app')
    @section('contact')

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
                    <li class="tm-nav-item "><a href="{{ route('authors') }}" class="tm-nav-link">
                        <i class="fas fa-users"></i>
                        {{ __('authors') }}
                    </a></li>
                    <li class="tm-nav-item "><a href="{{ route('books') }}" class="tm-nav-link">
                        <i class="fas fa-book"></i>
                        {{ __('books') }}
                    </a></li>
                    <li class="tm-nav-item active"><a href="{{ route('contact') }}" class="tm-nav-link">
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
        <main class="tm-main">
            @if(session()->has('status'))
                    {{ session()->get('status') }}
                @endif
            <div class="row tm-row tm-mb-120">
                <div class="col-12">
                    <h2 class="tm-color-primary tm-post-title tm-mb-60">{{ __('contact') }}</h2>
                </div>

                <div class="col-lg-7 tm-contact-left">
                    <form method="POST" action="{{ route('contact.save') }}" class="mb-5 ml-auto mr-0 tm-contact-form">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="name" class="col-sm-3 col-form-label text-right tm-color-primary">{{ __('name') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="name" id="name" type="text" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label text-right tm-color-primary">{{ __('email') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="email" id="email" type="email" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="subject" class="col-sm-3 col-form-label text-right tm-color-primary">{{ __('Subject') }}</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="subject" id="subject" type="text" required>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="message" class=" col-form-label text-right tm-color-primary">{{ __('Message') }}</label>
                            <div class="col-sm-12">
                                <textarea class="form-control mr-0 ml-auto" name="message" id="message" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
                                <button type="submit" class="tm-btn tm-btn-primary tm-btn-small">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
        </main>
    </div>
    @endsection

