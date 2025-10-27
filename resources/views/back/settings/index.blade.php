@extends('back.app')

@section('title','Dashboard - Paramètre')



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
            <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="page-title">Paramètres de base</h3>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label
                            >Nom du site <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" name="web_site_name"
                                   value="{{isset($global_settings) ? old('web_site_name',$global_settings->web_site_name) : old('web_site_name')}}" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Uploader une image</label>
                            <div class="custom-file mb-3">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="customFile"
                                    name="logo"
                                />
                                <label class="custom-file-label" for="customFile"
                                >Choisir une image</label
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input
                                class="form-control"
                                value="{{isset($global_settings)? old('address',$global_settings->address) : old('address')}}"
                                type="text"
                                name="address"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Numero de telephone</label>
                            <input
                                class="form-control"
                                value="{{isset($global_settings)? old('phone',$global_settings->phone) : old('phone')}}"
                                type="text"
                                name="phone"
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input
                                class="form-control"
                                value="{{isset($global_settings)? old('email',$global_settings->email) : old('email')}}"
                                type="text"
                                name="email"
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea
                                class="form-control"
                                rows="5"
                                id="comment"
                                name="about"

                            >
                                {{isset($global_settings)? old('about',$global_settings->about) : old('about')}}
                            </textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit mr-5 mt-5">
                    Enrégistrer les modifications
                </button>
            </form>
        </div>
    </div>
@endsection

