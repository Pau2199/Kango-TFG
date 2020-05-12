@extends('layouts.master')
@section('titulo')
<title>Anuncios Publicados | Kangoo Home</title>    
@stop
@section('letra')
<link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloAnuncios.css')}}">
@stop
@section('content')
<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-xl-5 col-lg-12">
            <p class="text-center font-weight-bold titulo">Propiedas en Alquiler</p>
            <div class="row padre">
                @foreach($alquilados as $key => $valor)
                <?php $imagen = $valor->img[0]->nombre ?>
                <div class="col-md-6 col-sm-12">
                    <div class="card mb-4 alturaFija">
                        <img class="card-img-top img-fluid imgPerfil" src='{{asset("uploads/$imagen")}}' alt="imagen">
                        <div class="card-body">
                            <p class="font-weight-bold card-text">Dirección</p>
                            <p class="card-text">
                                @if($valor->tipo_de_via == 'C')
                                Calle 
                                @elseif($valor->tipo_de_via == 'A')
                                Avenida
                                @else
                                Plaza
                                @endif
                                {{$valor->nombre_de_la_direccion}},
                                {{$valor->nPatio}}
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Localidad: {{$valor->localidad}}</span>
                                <span>Provincia: {{$valor->provincia}} </span>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6 col-lg-12">
                                    <span class="font-weight-bold">Precio: {{$valor->precio}} €</span>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <span class="font-weight-bold"> Fianza: {{$valor->fianza}} €</span>
                                </div>
                            </div>
                            <div id="A{{$valor->id}}" class="row text-center my-3">
                                <div class="col-6">
                                    <a href="/inmuebles/vistaInmueble/A-{{$valor->id}}"><span class="detalles btn btn-info">Detalles</span></a>                                </div>
                                <div class="col-6">
                                    <span class="btn btn-info">Desactivar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                @endforeach
            </div>
        </div>
        <div class="col-xl-5 col-lg-12">
            <p class="text-center font-weight-bold titulo">Propiedas en Ventas</p>
            <div class="row padre">
                @foreach($venta as $llave => $value)
                <div class="col-md-6 col-sm-12">
                    <div class="card mb-4 alturaFija">
                        <?php $imagen = $value->img[0]->nombre ?>
                        <img class="card-img-top img-fluid  imgPerfil" src='{{asset("uploads/$imagen")}}' alt="imagen">
                        <div class="card-body">
                            <p class="font-weight-bold card-text">Dirección</p>
                            <p class="card-text">
                                @if($value->tipo_de_via == 'C')
                                Calle 
                                @elseif($value->tipo_de_via == 'A')
                                Avenida
                                @else
                                Plaza
                                @endif
                                {{$value->nombre_de_la_direccion}},
                                {{$value->nPatio}}
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Localidad: {{$value->localidad}} </span>
                                <span class="f">Provincia: {{$value->provincia}} </span>
                            </div>
                            <hr>
                            <div class="text-center">
                                <span class="font-weight-bold">Precio: {{$value->precio}} €</span>
                            </div>
                            <div id="V{{$value->id}}" class="row text-center my-3">
                                <div class="col-6">
                                    <a href="/inmuebles/vistaInmueble/V-{{$value->id}}"><span class="detalles btn btn-info">Detalles</span></a>
                                </div>
                                <div class="col-6">
                                    <span class="btn btn-info">Desactivar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop
@foreach($alquilados as $key => $valor)
<span>{{$valor}}</span>
@endforeach
@foreach($venta as $key => $valor)
<span>{{$valor}}</span>
@endforeach

