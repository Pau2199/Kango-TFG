@extends('layouts.master')
@section('titulo')
<title>Gestión Usuarios | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/modificarDatosPerfilJS.js')}}"></script>
@stop
@section('content')
<table class="table my-3">
    <thead class="thead-light">
        <tr>
            <th scope="col"></th>
            <th scope="col">DNI o NIE</th>
            <th scope="col">Nombre</th>
            <th scope="col">Primer Apellido</th>
            <th scope="col">Segundo Apellido</th>
            <th scope="col">Sexo</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Rol</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $user)
        <tr>
            <th scope="row"><a href="/perfil/editarPerfil/{{$user->id}}"><span class="btn btn-warning">Editar</span></a></th>
            <td id='U-{{$user->id}}'>{{$user->nif_nie}}</td>
            <td>{{$user->nombre}}</td>
            <td>{{$user->primer_apellido}}</td>
            <td>{{$user->segundo_apellido}}</td>
            <td>{{$user->sexo}}</td>
            <td>{{$user->fecha_nacimiento}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->telefono}}</td>
            <td>{{$user->rol}}</td>
            @if(Auth::user()->id != $user->id)
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@stop