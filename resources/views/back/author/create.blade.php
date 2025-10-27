@extends('back.app')

@section('title',"Dashboard - Ajout d'auteur")

@section('dashboard-header')
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title mt-5">
                @if(isset($author))
                    Modifier
                @else
                    Ajouter auteur
                @endif
            </h3>
        </div>
    </div>
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{isset($author) ? route('author.update',$author): route('author.store')}}" method="POST">
                @csrf
                @if(isset($author))
                    @method('PUT')
                @endif
                <div class="row formtype">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nom</label>
                            <input
                                class="form-control"
                                type="text"
                                name="name"
                                value="{{isset($author)? old('name',$author->name): old('name')}}"
                            />
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input
                                class="form-control"
                                type="email"
                                name="email"
                                value="{{isset($author) ? old('email',$author->email): old('email')}}"
                            />
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit ml-2">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>
@endsection
