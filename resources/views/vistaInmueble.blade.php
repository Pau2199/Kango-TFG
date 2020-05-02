@extends('layouts.master')
@section('titulo')
<title>Inmueble | Kangoo Home</title>    
@stop
@section('letra')
<link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloAnuncios.css')}}">
@stop
@section('js')
<script src="{{asset('js/anunciosInmuebleJS.js')}}"></script>
@stop
@section('content')
<span>{{$datos[0]}}</span>



<div class="container-fluid my-4 mr-3 ml-3">
    <div class="row">
        <div class=" col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($datos[0]->img as $key => $valor)
                            @foreach($valor as $clave => $value)
                            @if ($key == 0)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src='{{asset("uploads/$value")}}' alt="First slide">
                            </div>
                            @else
                            <div class="carousel-item">
                                <img class="d-block w-100" src='{{asset("uploads/$value")}}' alt="First slide">
                            </div>
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--
<ol class="carousel-indicators">
<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
<img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
</li>
<li data-target="#carouselExampleIndicators" data-slide-to="1">
<img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
</li>
<li data-target="#carouselExampleIndicators" data-slide-to="2">
<img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
</li>
<li data-target="#carouselExampleIndicators" data-slide-to="2">
<img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
</li>
</ol>
-->
                    </div> 
                </div>
            </div>
            <div class="row mt-4 justify-content-center d-none d-lg-flex">
                @foreach($datos[0]->img as $key => $valor)
                @foreach($valor as $clave => $value)
                <div class="col-md-3">
                    <img src='{{asset("uploads/$value")}}' class="img-fluid" data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"/>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-lg-6">
            <h2>
                @if($datos[0]->alquiler == true)
                Alquiler
                @else
                Venta
                @endif
                de
                @if($datos[0]->tipo_de_vivienda == 'P')
                Piso
                @elseif($datos[0]->tipo_de_vivienda == 'D')
                Duplex
                @elseif($datos[0]->tipo_de_vivienda == 'A')
                Adosado
                @elseif($datos[0]->tipo_de_vivienda == 'C')
                Chalet
                @else
                Bajo
                @endif
                en {{$datos[0]->provincia}}@if($datos[0]-> provincia != $datos[0]->localidad), {{$datos[0]->localidad}}@endif
                @if($datos[0]->barrio != null)
                - Barrio de {{$datos[0]->barrio}}
                @endif
            </h2>
            <div class="mt-4">
                <div class="justify-content-between">
                    <div class="row">
                        <div class="col-6 justify-content-center"> 
                            <img src="{{asset('img/ubicacion.svg')}}" alt="ubicacion" class="iconos">
                            <div id="direccion">
                                @if($datos[0]->tipo_de_via == 'C')
                                Calle 
                                @elseif($datos[0]->tipo_de_via == 'A')
                                Avenida
                                @else
                                Plaza
                                @endif
                                {{$datos[0]->nombre_de_la_direccion}}
                                - {{$datos[0]->codigo_postal}}
                            </div>
                        </div>
                        <div class="col-3 justify-content-center d-md-block d-lg-none">
                            Precio: {{$datos[0]->precio}} €
                            Fianza: {{$datos[0]->fianza}} €
                        </div>
                        <div class="col-3 justify-content-center d-md-none">
                            Precio: {{$datos[0]->precio}} €
                        </div>
                        @if($datos[0]->alquiler == true)
                        <div class="col-3 justify-content-center">
                            Fianza: {{$datos[0]->fianza}} €
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-4">
                <p>Comunidad de Vececinos</p>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/piscina.svg')}}" alt="Piscina" class="iconos" title="Piscina">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->piscina == 1)
                                Sí
                                @else
                                No
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/garage.svg')}}" alt="Garaje" class="iconos" title="Garaje">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->garage == 1)
                                Sí
                                @else
                                No
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-2">   
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/ascensor.png')}}" alt="Ascensor" class="iconos" title="Ascensor">   
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->ascensor == 1)
                                Sí
                                @else
                                No
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-4">
                <p>Opciones del Alquiler</p>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/animales.svg')}}" alt="IconoAnimales" class="iconos" title="Animales">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->animales == 1)
                                Sí
                                @else
                                No
                                @endif     
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/aireAcondicionado.svg')}}" alt="aireAcondicionado" class="iconos" title="Aire Acondicionado">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->aireAcondicionado == 1)
                                Sí
                                @else
                                No
                                @endif     
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/internet.svg')}}" alt="internet" class="iconos" title="Internet">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->internet == 1)
                                Sí
                                @else
                                No
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/calefaccion.png')}}" alt="calefaccion" class="iconos" title="Calefacción">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->calefaccion == 1)
                                Sí
                                @else
                                No
                                @endif      

                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/reformas.png')}}" alt="reformas" class="iconos" title="Reformas">
                            </div>
                            <div class="ml-4 mt-2">
                                @if($datos[0]->reformas == 1)
                                Sí
                                @else
                                No
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <p>Opciones del Inmueble</p>
            <div class="row">
                <div class="col-4 text-center">
                    Nº De Habitaciones: {{$datos[0]->n_habitaciones}}
                </div>
                <div class="col-4 text-center">
                    Nº De Habitaciones: {{$datos[0]->n_habitaciones}}
                </div>
                <div class="col-4 text-center">
                    Metros Cuadrados: {{$datos[0]->metros_cuadrados}}
                </div>
            </div>
            <hr>
            <p>Descripción</p>
            <span>{{$datos[0]->descripcion}}</span>
            <hr>
            <div class="row justify-content-center">
                @if(Auth::user()->id == $datos[0]->idUsuario)
                <div class="col-4">
                    <span id="botonModificacion" class="btn btn-info">Activar Edición</span>
                </div>
                <div class="col-4">
                    <span class="btn btn-info">Desactivar publicación</span>
                </div>
                @else
                <span class="btn btn-info">Desactivar publicación</span>
                @endif
            </div>
        </div>
    </div>
</div>




@stop