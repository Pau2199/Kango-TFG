@extends('layouts.master')
@section('titulo')
<title>Editar Perfil | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/modificarDatosPerfilJS.js')}}"></script>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloGes.css')}}">
@stop
@section('content')

<h4 class="text-center my-3">Modificar Datos Personales</h4>
<form action="/perfil/modificarDatos" id="formModificar" method="POST" class="container">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Nombre</label>
            <input id="name" value="{{$user->nombre}}" type="text" name="name" class="form-control" placeholder="Nombre">
            <strong class="js comprobaciones" id="mensajename"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="primerApellido">Primer Apellido</label>
            <input id="primerApellido" value="{{$user->primer_apellido}}" type="text" name="primerApellido" class="form-control" placeholder="Primer Apellido">
            <strong class="js comprobaciones" id="mensajeprimerApellido"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="segundoApellido">Segundo Apellido</label>
            <input id="segundoApellido" value="{{$user->segundo_apellido}}" type="text" name="segundoApellido" class="form-control" placeholder="Segundo Apellido">
            <strong class="js comprobaciones" id="mensajesegundoApellido"></strong>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input id="email" value="{{$user->email}}" type="email" name="email" class="form-control" placeholder="Email">
            <strong class="js comprobaciones" id="mensajeemail"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="telefono">Teléfono</label>
            <input id="telefono" value="{{$user->telefono}}" type="text" name="telefono" class="form-control" placeholder="Teléfono">
            <strong class="js comprobaciones" id="mensajetelefono"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="nif_nie">DNI o NIE</label>
            <input id="nif_nie" value="{{$user->nif_nie}}" type="text" name="nif_nie" class="form-control" placeholder="DNI o Nie">
            <strong class="js comprobaciones" id="mensajenif_nie"></strong>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label for="fechaNacimiento">Fecha de Cumpleaños</label>
            <input id="fechaNacimiento" value="{{$user->fecha_nacimiento}}" type="date" name="fechaNacimiento" class="form-control">
            <strong class="js comprobaciones" id="mensajefechaNacimiento"></strong>
        </div>
        @if(Auth::check() and Auth::user()->rol = 'Admin' and Auth::user()->id != $user->id)
        <div class="form-group col-md-4">
            <label class="ml-3" for="rol">Rol</label><br>
            <select name="rol" id="rol" class="form-control">
                @if($user->rol == 'Admin')
                <option value="Admin" selected>Admin</option>
                @else
                <option value="Admin">Admin</option>
                @endif
                @if($user->rol == 'User')
                <option value="User" selected>User</option>
                @else
                <option value="User">User</option>
                @endif
            </select>
            <strong class="js comprobaciones" id="mensajesexo"></strong>
        </div>
        @endif
        <div class="form-group col-md-4">
            <label class="ml-3" for="sexo">Sexo</label><br>
            @if($user->sexo == 'H')
            <input class="ml-3 mr-3 @error('sexo') is-invalid @enderror" name="sexo" checked id="hombre" value="H" type="radio">Hombre
            <input class="mr-3 ml-3 @error('sexo') is-invalid @enderror" name="sexo" id="mujer" value="M" type="radio">Mujer
            @else
            <input class="ml-3 mr-3 @error('sexo') is-invalid @enderror" name="sexo" id="hombre" value="H" type="radio">Hombre
            <input class="mr-3 ml-3 @error('sexo') is-invalid @enderror" name="sexo" checked id="mujer" value="M" type="radio">Mujer
            @endif
            <br><strong class="js comprobaciones" id="mensajesexo"></strong>
        </div>
        <input type="hidden" name="idUsuario" value="{{$user->id}}">
    </div>
    <div class="text-center my-3">
        <button id="modificar" type="submit" class="btn btn-warning">Modificar datos!</button>
    </div>
</form>
@stop
