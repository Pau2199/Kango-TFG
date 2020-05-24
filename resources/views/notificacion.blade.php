@extends('layouts.master')
@section('titulo')
<title>Notificaciones | Kangoo Home</title>    
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloRegistrarInmueble.css')}}">
@stop
@section('content')
@foreach($notificacion as $noti)
<span>{{$noti}}</span>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12 m-2 border-right border-warning">
            <div class="d-flex justify-content-between border border-info rounded mt-1 p-2">
                <span class="font-weight-bold">{{$noti->titulo}}</span>
                <span>{{$noti->fecha}}</span>
            </div>
            <div class="d-flex justify-content-between border border-success rounded mt-1 p-2">
                <span class="font-weight-bold">Solicitud de Alquiler</span>
                <span>29/10/19</span>
            </div>
        </div>
        @endforeach
        <div class="col-md-7 col-12 m-2">
        </div>
    </div>
</div>
@stop