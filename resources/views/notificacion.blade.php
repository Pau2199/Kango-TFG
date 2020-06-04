@extends('layouts.master')
@section('titulo')
<title>Notificaciones | Kangoo Home</title>    
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloRegistrarInmueble.css')}}">
@stop
@section('js')
<script src="{{asset('js/notificacionesJS.js')}}"></script>
@stop
@section('content')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="text-center w-100 font-weight-bold bg-success" id="mensajeInfo">
    <p id="texto"></p>
</div>
<div class="container-fluid">
    <div class="row">
        <div id="notificaciones"class="col-md-3 col-12 m-2 border-right border-warning">
            @foreach($notificacion as $noti)
            <div id="N-{{$noti->id}}/S-{{$noti->idRequest}}"class="d-flex justify-content-between border @if($noti->leido == true) border-info @else border-success @endif rounded mt-1 p-2">
                <span class="font-weight-bold">{{$noti->titulo}}</span>
                <span class="fecha">{{$noti->fecha}}</span>
            </div>
            @endforeach

        </div>
        <div id="mensaje" class="col-md-7 col-12 m-2">

            <span id="mensajeTexto">Haz click sobre una notificación</span>

            <div id="mensajeNotis" style="height: 100px">
                <h1>No hay Notificaciones</h1>
            </div>
        </div>
    </div>
</div>
@stop