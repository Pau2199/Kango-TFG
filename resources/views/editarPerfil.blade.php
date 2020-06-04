@extends('layouts.master')
@section('titulo')
<title>Editar Perfil | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/modificarDatosPerfilJS.js')}}"></script>
@stop
@section('content')

<h4 class="text-center my-3">Modificar Datos Personales</h4>
<form action="/perfil/modificarDatos" id="formModificar" method="POST" class="container">
   @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Nombre</label>
            <input id="name" value="{{Auth::user()->nombre}}" type="text" name="name" class="form-control" placeholder="Nombre">
            <strong class="js" id="mensajename"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="primerApellido">Primer Apellido</label>
            <input id="primerApellido" value="{{Auth::user()->primer_apellido}}" type="text" name="primerApellido" class="form-control" placeholder="Primer Apellido">
            <strong class="js" id="mensajeprimerApellido"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="segundoApellido">Segundo Apellido</label>
            <input id="segundoApellido" value="{{Auth::user()->segundo_apellido}}" type="text" name="segundoApellido" class="form-control" placeholder="Segundo Apellido">
            <strong class="js" id="mensajesegundoApellido"></strong>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input id="email" value="{{Auth::user()->email}}" type="email" name="email" class="form-control" placeholder="Email">
            <strong class="js" id="mensajeemail"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="telefono">Teléfono</label>
            <input id="telefono" value="{{Auth::user()->telefono}}" type="text" name="telefono" class="form-control" placeholder="Teléfono">
            <strong class="js" id="mensajetelefono"></strong>
        </div>
        <div class="form-group col-md-4">
            <label for="nif_nie">DNI o NIE</label>
            <input id="nif_nie" value="{{Auth::user()->nif_nie}}" type="text" name="nif_nie" class="form-control" placeholder="DNI o Nie">
            <strong class="js" id="mensajenif_nie"></strong>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="form-group col-md-4">
            <label for="fechaNacimiento">Fecha de Cumpleaños</label>
            <input id="fechaNacimiento" value="{{Auth::user()->fecha_nacimiento}}" type="date" name="fechaNacimiento" class="form-control">
            <strong class="js" id="mensajefechaNacimiento"></strong>
        </div>
        <div class="form-group col-md-4">
            <label class="ml-3" for="sexo">Sexo</label><br>
            @if(Auth::user()->sexo == 'H')
            <input class="ml-3 mr-3 @error('sexo') is-invalid @enderror" name="sexo" checked id="hombre" value="H" type="radio">Hombre
            <input class="mr-3 ml-3 @error('sexo') is-invalid @enderror" name="sexo" id="mujer" value="M" type="radio">Mujer
            @else
            <input class="ml-3 mr-3 @error('sexo') is-invalid @enderror" name="sexo" id="hombre" value="H" type="radio">Hombre
            <input class="mr-3 ml-3 @error('sexo') is-invalid @enderror" name="sexo" checked id="mujer" value="M" type="radio">Mujer
            @endif
            <br><strong class="js" id="mensajesexo"></strong>
        </div>
        <input type="hidden" name="idUsuario" value="{{Auth::user()->id}}">
    </div>
    <div class="text-center my-3">
        <button id="modificar" type="submit" class="btn btn-warning">Modificar datos!</button>
    </div>
</form>
@stop
