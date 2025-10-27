@extends('front.app')

@section('breacking_news')
    <div class="container-fluid mt-5 mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div
                            class="section-title border-right-0 mb-0"
                            style="width: 180px"
                        >
                            <h4 class="m-0 text-uppercase font-weight-bold">Tranding</h4>
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                            style="width: calc(100% - 180px); padding-right: 100px"
                        >
                            @foreach($global_recent_articles as $article)
                                <div class="text-truncate">
                                    <a
                                        class="text-secondary text-uppercase font-weight-semi-bold"
                                        href="{{route('article.detail',$article->slug)}}"
                                    >{{$article->title}}</a>

                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('main_section')
    <div class="position-relative mb-3">
        <img
            class="img-fluid w-100"
            src="{{$article_detail->getImageUrl()}}"
            style="object-fit: cover"
        />
        <div class="bg-white border border-top-0 p-4">
            <div class="mb-3">
                <a
                    class="badge badge-info text-uppercase font-weight-semi-bold p-2 mr-2"
                    href=""
                >{{$article_detail->category->name}}</a
                >
                <a class="text-white" href="">
                    @php $time= $article_detail->created_at @endphp
                    <small>{{$time->isoFormat('LL')}}</small>
                </a>
            </div>
            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">
                {{$article_detail->title}}
            </h1>
             <p>
                 {{$article_detail->description}}
             </p>
        </div>
        <div
            class="d-flex justify-content-between bg-white border border-top-0 p-4"
        >
            <div class="d-flex align-items-center">
                <img
                    class="rounded-circle mr-2"
                    src="{{ $article_detail->author->image
                                           ? Storage::disk('s3')->url($article_detail->author->image)
                                           : asset('back_auth/assets/img/logo.png')
                                       }}"
                    width="25"
                    height="25"
                    alt=""
                />
                <span>{{$article_detail->author->name}}</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="ml-3"><i class="far fa-eye mr-2"></i>{{$article_detail->views}}</span>
                <span class="ml-3"
                ><i class="far fa-comment mr-2"></i>{{$article_detail->comments->count()}} </span
                >
            </div>
        </div>
    </div>
    <!-- News Detail End -->

    <!-- Comment List Start -->
    @php $maxVisible = 4; @endphp

    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">{{ $article_detail->comments->count() }} Commentaires</h4>
        </div>

        <div class="bg-white border border-top-0 p-4">

            @if($article_detail->comments->count())
                {{--Affiche seulement les 4 premiers --}}
                @foreach($article_detail->comments->take($maxVisible) as $comment)
                    <div class="media mb-4">
                        <img src="{{asset('back_auth/assets/img/logo.png')}}" alt="user" class="img-fluid mr-3 mt-1" style="width: 45px"/>
                        <div class="media-body">
                            <h6>
                                <a class="text-secondary font-weight-bold" href="">{{ $comment->name }}</a>
                                <small>
                                    <i>
                                        {{ $comment->created_at->isoFormat('LLL') }}

                                    </i>
                                </small>
                            </h6>
                            <p>{{ $comment->message }}</p>
                        </div>
                    </div>
                @endforeach

                {{--  Boutons --}}
                @if($article_detail->comments->count() > $maxVisible)
                    <div class="text-center mt-3">
                        <button id="btn-more" class="btn btn-outline-primary btn-sm"
                                onclick="document.getElementById('more-comments').style.display='block';
                                     this.style.display='none';
                                     document.getElementById('btn-less').style.display='inline-block';">
                            Voir les {{ $article_detail->comments->count() - $maxVisible }} autres commentaires
                        </button>

                    </div>
                @endif

                {{--  Bloc des commentaires restants (caché par défaut) --}}
                <div id="more-comments" style="display: none;">
                    @foreach($article_detail->comments->skip($maxVisible) as $comment)
                        <div class="media mb-4">
                            <img src="{{asset('back_auth/assets/img/logo.png')}}" class="img-fluid mr-3 mt-1" style="width: 45px" />
                            <div class="media-body">
                                <h6>
                                    <a class="text-secondary font-weight-bold" href="">{{ $comment->name }}</a>
                                    <small><i>{{ $comment->created_at->isoFormat('LL') }}</i></small>
                                </h6>
                                <p>{{ $comment->message }}</p>
                            </div>
                        </div>
                    @endforeach
                        <button id="btn-less" class="btn btn-outline-secondary btn-sm" style="display: none;"
                                onclick="document.getElementById('more-comments').style.display='none';
                                     this.style.display='none';
                                     document.getElementById('btn-more').style.display='inline-block';">
                            Réduire les commentaires
                        </button>
                </div>
            @endif
        </div>
    </div>


    <!-- Comment List End -->

    <!-- Comment Form Start -->
    @if($article_detail->isComment)
        <div class="mb-3">
            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">
                    Laissez un commentaire
                </h4>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="bg-white border border-top-0 p-4">
                <form action="{{route('comment',$article_detail->id)}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nom *</label>
                                <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name"/>
                                @error('name')
                                <p class="text-danger mt-2">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email" />
                                @error('email')
                                <p class="text-danger mt-2">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website">Site web</label>
                        <input type="url" class="form-control" name="web_site" id="website" />
                    </div>

                    <div class="form-group">
                        <label for="message">Commentaire *</label>
                        <textarea
                            id="message"
                            cols="30"
                            rows="5"
                            name="message"
                            class="form-control"
                        ></textarea>
                        @error('message')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <input
                            type="submit"
                            value="Laissez un commentaires"
                            class="btn btn-info font-weight-semi-bold py-2 px-3"
                        />
                    </div>
                </form>
            </div>
        </div>
    @else
        <p> Les commentaires sont bloqués sur ce post</p>
    @endif

@endsection
