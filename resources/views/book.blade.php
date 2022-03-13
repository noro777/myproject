@extends('layouts.app')
    @section('post')
    <a href="{{ route('books') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
      </svg>{{ __('back') }}</a>

    @php
        $comments = $booka->comments;
        $user = auth()->user();
    @endphp
        <main class="tm-main">
            <div class="row tm-row">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    <div class="tm-post-link-inner">
                        <img src="{{ asset('images/books/'.$booka->image) }}" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">
                        <div class="mb-4">
                            <h2 class="pt-2 tm-color-primary tm-post-title">{{ $booka->name }}</h2>
                            <p>
                                {{ $booka->text }}
                            </p>
                            <div>
                                <a href="{{ route('download',['filename'=> $booka->file]) }}" class="btn btn-primary">Ներբեռնել</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    @if(count($books)!=1)
                    <p>
                        <a class="btn btn-primary" href="{{ route('books') }}" >Մյուս գրքերը</a>
                    </p>
                    @endif

                </div>

                @foreach ($books as $book)

                @if($book->id != $booka->id)
                <div class="col-12">
                    <hr class="tm-hr-primary  tm-mb-55">
                </div>
                <div class="col-lg-6 tm-mb-60 tm-person-col">
                    <div>
                        <a href="{{ route('book',['id'=>$book->id]) }}">{{ $book->name }}</a>
                    </div>
                    <div class="media tm-person">
                        <img src="{{ asset('images/books/'.$book->image) }}" alt="Image" class="img-fluid mr-4">
                        <div class="media-body">
                            <p class="mb-0 tm-line-height-short">
                                {{ $book->text }}
                            </p>

                            <p class="mb-0 tm-line-height-short">
                                Գրքի հեղինակը՝ <a href="{{ route('author',['id'=>$book->author_id]) }}">{{ $book->author['name'] }}</a>
                            </p>
                        </div>
                    </div>


                </div>
                @endif
                @endforeach



                @auth
                <div>
                    Մեկնաբանություններ
                </div>
                <div>
                    Թողնել մեկնաբանություն։
                </div>
                @foreach ($comments as $comment)
                <div class="col-12">
                    <hr class="tm-hr-primary  tm-mb-55">
                </div>
                <div class="col-lg-6 tm-mb-60 tm-person-col">
                    <div>
                        {{ $comment->name }}
                    </div>
                    <div class="media tm-person">
                        <div class="media-body">
                            <p class="mb-0 tm-line-height-short">
                                {{ $comment->message }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                    <form method="POST" action="{{ route('comment.save',['name'=>$user->name,'book_id'=>$booka->id]) }}" class="mb-5 ml-auto mr-0 tm-contact-form">
                        @csrf

                        <div class="form-group row mb-5">
                            <label for="message" class="col-sm-3 col-form-label text-right tm-color-primary">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control mr-0 ml-auto" name="message" id="message" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
                                <button type="submit" class="tm-btn tm-btn-primary tm-btn-small">Submit</button>
                            </div>
                        </div>
                    </form>
                    @else
                    {{__('girq')}} <a href="{{ route('register') }}">{{__('register')}}</a>, {{__('kam')}} <a href="{{ route('login') }}">{{__('login')}}</a>։
                @endauth

        </main>
    @endsection

