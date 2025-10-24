@extends('back.app')

@section('title',"Dashboard - Page d'ajout d'article")


@section('dashboard-header')
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title mt-5">
                @if(isset($article))
                    Modifier un article
                @else
                    Ajouter un article
                @endif
            </h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
@section('dashboard-content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{isset($article)? route('article.update',$article): route('article.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif
                <div class="row formtype">
                    @if(isset($article))
                        <div class="col-12">
                            <img src="{{$article->getImageUrl()}}" alt="{{$article->title}}" style="width:100%" height="200"/>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Titre de l'article</label>
                            <input
                                class="form-control"
                                type="text"
                                value="{{isset($article)? old('title',$article->title):old('title')}}"
                                name="title"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Categorie</label>
                            <select class="form-control" id="sel1" name="category_id">
                                @foreach($categories as $category)
                                    <option @if(isset($article)) @selected($article->category_id==$category->id) @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Uploader une image</label>
                            <div class="custom-file mb-3">
                                <input
                                    type="file"
                                    class="form-control"
                                    id="customFile"
                                    name="image"
                                />
                                <label class="custom-file-label" for="customFile"
                                >Choisir une image</label
                                >
                            </div>
                        </div>
                    </div>

                    <textarea
                        class="form-control"
                        rows="5"
                        id="comment"
                        name="description">
                        {{isset($article)? old('description',$article->description): old('description')}}
                  </textarea>

                        @if(isset($article))
                            <div class="col-md-12 mt-3">
                                <h5>Tags [ecrire séparer par virgule "," ou taper la touche entrée]</h5>
                                @foreach($article->tags as $tag)
                                    <label class="label label-info btn btn-primary">{{$tag->name}}</label>
                                @endforeach
                            </div>
                        @endif

                        <div class="col-md-12 mt-3" >
                            <input class="form-control" type="text" data-role="tagsinput" name="tags">
                            @if($errors->has('tags'))
                                <span class="text-danger">{{$errors->first('tags')}}</span>
                            @endif
                        </div>

                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <label>Publication</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" @if(isset($article)) @checked($article->isActive == 1) @else checked @endif type="radio" id="article_active" name="isActive" value="1" >
                            <label class="form-check-label" for="article_active">Publier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" @if(isset($article)) @checked($article->isActive == 0) @else checked @endif type="radio" id="article_inactive" name="isActive" value="0">
                            <label class="form-check-label" for="article_inactive">Ne pas publier</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <label>Partages</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" @if(isset($article)) @checked($article->isSharable == 1) @else checked @endif type="radio" id="article_share_active" name="isSharable" value="1" >
                            <label class="form-check-label" for="article_share_active">Partageable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input  class="form-check-input" @if(isset($article)) @checked($article->isSharable == 0) @else checked @endif type="radio" id="article_share_inactive" name="isSharable" value="0">
                            <label class="form-check-label" for="article_share_inactive">Non Partageable</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <label>Commentaires</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" @if(isset($article)) @checked($article->isComment == 1) @else checked @endif type="radio" id="article_comment_active" name="isComment" value="1" >
                            <label class="form-check-label" for="article_comment_active">Autorise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" @if(isset($article)) @checked($article->isComment == 0)  @else checked @endif type="radio" id="article_comment_inactive" name="isComment" value="0">
                            <label class="form-check-label" for="article_comment_inactive">Non autorise</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary buttonedit1 mt-1 mb-3">Enregistrer l'article</button>
                </div>

            </form>
        </div>
    </div>
@endsection
