@extends('layouts.master')
@section('titulo')
<title>Inmueble | Kangoo Home</title>    
@stop
@section('css')
<link rel="stylesheet" href="">
@stop
@section('js')
<script src="{{asset('js/solicitudesJS.js')}}"></script>
@stop
@section('content')
<table class="table table-striped text-center">
    <thead class="table-warning">
        <tr>
            <th>Fecha Solicitada</th>
            <th>Hora</th>
            <th>Usuario Solicitante</th>
            <th>Direccion Inmueble</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($soli as $key => $datos) 
        <tr id="S-{{$datos->id}}">
            <td class="fecha">{{$datos->fecha_solicitada}}</td>
            <td>{{$datos->hora}}</td>
            <td class="U-{{$datos->datosSolicitante[0]->id}}">{{$datos->datosSolicitante[0]->nombre}} {{$datos->datosSolicitante[0]->primer_apellido}} {{$datos->datosSolicitante[0]->segundo_apellido}}</td>
            <td class="direccion" id="D-{{$datos->direccion[0]->id}}">{{$datos->direccion[0]->tipo_de_via}} {{$datos->direccion[0]->nombre_de_la_direccion}} {{$datos->direccion[0]->idProvincia[0]->nombre}}, {{$datos->direccion[0]->idLocalidad[0]->nombre}}</td>
            <td>{{$datos->estado}}</td>
            <td class="botonesForm">
               @if($datos->estado == 'Enviada')
                <span class="btn btn-success">Aceptar</span>
                <span class="btn btn-danger">Denegar</span>
                @endif
            </td>
        </tr>
        @endforeach     
    </tbody>
</table>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@stop