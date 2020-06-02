@extends('layouts.master')
@section('js')
<script src="{{asset('js/registroJS.js')}}"></script>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloRegistro.css')}}">
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="text-center my-5">Crear una nueva cuenta</h4>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <strong id="mensajename"></strong>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="primerApellido" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Primer Apellido') }}</label>
                    <div class="col-md-6">
                        <input id="primerApellido" type="text" class="form-control @error('primerApellido') is-invalid @enderror" name="primerApellido" value="{{ old('primerApellido') }}" required autocomplete="primerApellido">
                        <strong id="mensajeprimerApellido"></strong>
                        @error('primerApellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="segundoApellido" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Segundo Apellido') }}</label>
                    <div class="col-md-6">
                        <input id="segundoApellido" type="text" class="form-control @error('primerApellido') is-invalid @enderror" name="segundoApellido" value="{{ old('segundoApellido') }}" required autocomplete="segundoApellido">
                        <strong id="mensajesegundoApellido"></strong>
                        @error('segundoApellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nif_nie" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('DNI o NIE') }}</label>
                    <div class="col-md-6">
                        <input id="nif_nie" type="text" class="form-control @error('nif_nie') is-invalid @enderror" name="nif_nie" value="{{ old('nif_nie') }}" required autocomplete="nif_nie">
                        <strong id="mensajenif_nie"></strong>
                        @error('nif_nie')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sexo" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>
                    <div class="col-md-6 checkbox">
                        <input class="ml-5 mr-3 @error('sexo') is-invalid @enderror" name="sexo" value="hombre" type="radio">Hombre
                        <input class="mr-3 ml-5 @error('sexo') is-invalid @enderror" name="sexo" value="mujer" type="radio">Mujer
                        @error('sexo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fechaNacimiento" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Fecha de Nacimiento') }}</label>
                    <div class="col-md-6">
                        <input id="fechaNacimiento" type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required autocomplete="fechaNacimiento">
                        <strong id="mensajefechaNacimiento"></strong>
                        @error('fechaNacimiento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Correo Electronico') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <strong id="mensajeemail"></strong>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                    <div class="col-md-6">
                        <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono">
                        <strong id="mensajetelefono"></strong>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="font-weight-bold col-md-4 col-form-label text-md-right">{{ __('Repite la Contraseña') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="terminosYCondiciones" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-6">
                        <input id="terminosYCondiciones" type="checkbox" name="terminosYCondiciones" required autocomplete="terminosYCondiciones"> Acepto los terminos y condiciones de la web.
                        @error('terminosYCondiciones')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input id="rol" type="hidden" class="form-control" name="rol" value="user" required autocomplete="rol">
                    </div>
                </div>
                <div class="form-group row mb-0 text-center mb-5 mt-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn btn-warning mr-5">
                            {{ __('Registrarse') }}
                        </button>
                        <a class="text-right btn btn-link" href="/">
                            {{ __('¿Ya tienes una cuenta? Pues Logeate!') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop