@extends('back.app')

@section('title',"Dashboard - Ajout Réseaux Sociaux")


@section('dashboard-header')
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title mt-5">@if(isset($social)) Modifier @else Ajouter @endif un réseau social</h3>
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
            <form action="{{isset($social)? route('social.update',$social): route('social.store')}}" method="POST">
                @csrf
                @isset($social)
                    @method('PUT')
                @endisset
                <div class="row formtype">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nom du reseau</label>
                            <input
                                class="form-control"
                                type="text"
                                name="name"
                                value="{{isset($social)? old('name',$social->name): old('name')  }}"
                            />
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lien</label>
                            <input
                                class="form-control"
                                type="text"
                                name="link"
                                value="{{isset($social)? old('link',$social->link): old('link')  }}"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Icon</label>
                            <input
                                class="form-control"
                                type="text"
                                name="icon"
                                placeholder="écrire le nom du reseau social en minuscule"
                                value="{{isset($social)? old('icon',$social->icon): old('icon')  }}"
                            />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary buttonedit1">
                        Enregistrer
                    </button>
                </div>
        </form>
    </div>


@endsection
