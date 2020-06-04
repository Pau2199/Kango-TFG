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
<table class="my-2 table table-striped text-center">
    <thead class="table-warning">
        <tr>
            <th>Fecha de Solicitud</th>
            <th>Fecha deseada Inicio</th>
            <th>Fecha de finalización</th>
            <th>Nombre Solicitante</th>
            <th>Direccion Inmueble Solicitado</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($soli as $key => $datos)
        <tr id="SA-{{$datos->id}}">
            <td class="fecha">{{$datos->fecha_solicitada}}</td>
            @if($datos->datosAlquiler != null)
            <td class="fecha">{{$datos->datosAlquiler[0]->fecha_inicio}}</td>
            <td>{{$datos->datosAlquiler[0]->fecha_final}}</td>
            @else
            <td></td>
            <td></td>
            @endif
            <td class="U-{{$datos->datosSolicitante[0]->id}}">{{$datos->datosSolicitante[0]->nombre}} {{$datos->datosSolicitante[0]->primer_apellido}} {{$datos->datosSolicitante[0]->segundo_apellido}}</td>
            <td class="direccion" id="D-{{$datos->direccion[0]->id}}">{{$datos->direccion[0]->tipo_de_via}} {{$datos->direccion[0]->nombre_de_la_direccion}} {{$datos->direccion->idProvincia[0]->nombre}}, {{$datos->direccion->idLocalidad[0]->nombre}}</td>
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
<div id="noticias" class="text-center my-3"></div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@stop