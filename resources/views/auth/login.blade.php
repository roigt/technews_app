@extends('auth.auth-layout')

@section('title','Page de connexion')

@section('auth-form')
    <h1>Connexion</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <p class="account-subtitle">Acceder au dashboard</p>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-group">
            <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Email">
            @error('email')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Mot de passe">
            @error('password')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
        </div>
    </form>
    <div class="text-center forgotpass"><a href="{{route('password.request')}}">Mot de passe oublie?</a> </div>

    <div class="text-center dont-have">Vous n'avez pas de compt? <a href="{{route('register')}}">S'inscrire</a></div>
@endsection
