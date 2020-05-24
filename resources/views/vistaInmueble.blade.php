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
<div class="text-center w-100 font-weight-bold" id="mensajeInfo">
    <p id="texto"> Modificación realizada correctamente! - La página se recargara en 3 segundos.</p>
</div>
<div class="container-fluid">
    <div class="row">
        <div id="vistaInmueble" class="col-lg-6 col-12">
            <div class="row">
                <div id="" class="col-12">
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
            <div id="horizontal">
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
        </div>
        <div id="vertical" class=" col-lg-2 col-12">
            <div id="vertical">
                @foreach($datos[0]->img as $key => $valor)
                @foreach($valor as $clave => $value)
                <div>
                    <img src='{{asset("uploads/$value")}}' class="{{$value}} img-fluid mt-3 vertical" data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"/>
                    <!--                    <div class="text-center">
<span class="btn btn-info mt-2 botonesImagenes" id="{{$value}}">Borrar Imagen</span>
</div>-->
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-lg-6 col-12" id="datosInm">
            <h2 id="titulo">
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
                <div class="row justify-content-center">
                    <div class="col-1">
                        <img src="{{asset('img/ubicacion.svg')}}" alt="ubicacion" class="iconos">
                    </div>
                    <div class="col-5"> 
                        <span id="direccion">
                            @if($datos[0]->tipo_de_via == 'C')
                            Calle 
                            @elseif($datos[0]->tipo_de_via == 'A')
                            Avenida
                            @else
                            Plaza
                            @endif
                            {{$datos[0]->nombre_de_la_direccion}}
                            ,{{$datos[0]->nPatio}}
                            Pta {{$datos[0]->nPuerta}}
                            @if($datos[0]->nPiso != null)
                            Piso {{$datos[0]->nPiso}}
                            @endif
                            @if($datos[0]->bloque != null)
                            Bloque {{$datos[0]->bloque}}
                            @endif
                            @if($datos[0]->escalera != null)
                            Escalera {{$datos[0]->escalera}}
                            @endif
                            - {{$datos[0]->codigo_postal}}
                        </span>
                    </div>
                    <div class="col-6">
                        <div class="row ml-2">
                            <div id="precio" class="col-xl-6 col-lg-12 col-md-6 col-12">
                                Precio: {{$datos[0]->precio}} €
                            </div>
                            @if($datos[0]->alquiler == true)
                            <div id="fianza" class="col-xl-6 col-lg-12 col-md-6 col-12">
                                Fianza: {{$datos[0]->fianza}} €
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-4">
                <p class="font-weight-bold">Comunidad de Vececinos</p>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/piscina.svg')}}" alt="Piscina" class="iconos" title="Piscina">
                            </div>
                            <div id="piscina" class="ml-4 mt-2">
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
                            <div id="garaje" class="ml-4 mt-2">
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
                            <div id="ascensor" class="ml-4 mt-2">
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
            @if($datos[0]->alquiler == true)
            <hr>
            <div class="mt-4">
                <p class="font-weight-bold">Opciones del Alquiler</p>
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{asset('img/animales.svg')}}" alt="IconoAnimales" class="iconos" title="Animales">
                            </div>
                            <div id="animales" class="ml-4 mt-2">
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
                            <div id="aireAcondicionado" class="ml-4 mt-2">
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
                            <div id="internet" class="ml-4 mt-2">
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
                            <div id="calefaccion" class="ml-4 mt-2">
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
                            <div id="reformas" class="ml-4 mt-2">
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
            @endif
            <hr>
            <p class="font-weight-bold">Opciones del Inmueble</p>
            <div class="row">
                <div id="habitaciones" class="col-4 text-center">
                    Habitaciones: {{$datos[0]->n_habitaciones}}
                </div>
                <div id="banyos" class="col-4 text-center">
                    Baños: {{$datos[0]->n_cuartos_de_banyo}}
                </div>
                <div id="metros" class="col-4 text-center">
                    Área: {{$datos[0]->metros_cuadrados}} m²
                </div>
            </div>
            <hr>
            <p class="font-weight-bold">Descripción</p>
            <span id="desc">{{$datos[0]->descripcion}}</span>
            <hr>
            <div class="d-flex justify-content-center row my-4" id="agregarForm">
                @if(Auth::user() != null and Auth::user()->id == $datos[0]->idUsuario)
                <div class="col-6 text-center">
                    <span id="botonModificacion" class="btn btn-info">Activar Edición</span>
                </div>
                <div class="col-6 text-center">
                    <span class="btn btn-info">Desactivar publicación</span>
                </div>
                @else
                @if(Auth::user() != null)
                <div id="botones">
                    @if($datos[0]->alquiler == true)
                    <span class="btn btn-info">Alquilar Inmueble</span>
                    @endif
                    <span class="btn btn-info" id="ventanaNueva">Solicitar una Visita</span>
                    <span class="btn btn-info">Mandar un mensaje</span>
                    <span class="btn btn-info">Guardar en favoritos</span>
                    @else
                    <span class="btn btn-info">Guardar en favoritos</span>
                </div>
                @endif
                @endif
            </div>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidde" id="idInmuebleUser" value="{{$datos[0]->idUsuario}}">
        @if(Auth::user())
        <input type="hidde" id="idUser" value="{{Auth::user()->id}}">
        @endif
        <div class="col-lg-10 col-md-12" id="modificarInm">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-8">
                    <form action="" id="formEditar" enctype="multipart/form-data" method="POST">
                        @csrf
                        <p class="font-weight-bold">Direccion</p>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label  class="font-weight-bold" for="tipoVia">Tipo Vía</label>
                                <select id="tipoVia" name="tipoVia" class="form-control @error('tipoVia') is-invalid @enderror">
                                    <option value="-">-</option>
                                    <option id="A" value="A">Avenida</option>
                                    <option id="P" value="P">Plaza</option>
                                    <option id="C" value="C">Calle</option>
                                </select>
                                <strong id="mensajetipoVia" class="comprobaciones" ></strong>
                                @error('tipoVia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="nombreDir">Nombre</label>
                                <input value="{{$datos[0]->nombre_de_la_direccion}}" id="nombreDir" type="text" class="form-control @error('nombreDir') is-invalid @enderror" name="nombreDir" id="nombreDir" placeholder="Nombre de la dirección">
                                <strong id="mensajenombreDir" class="comprobaciones" ></strong>
                                @error('nombreDir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="tipoInmueble">Tipo Inmueble</label>
                                <select id="tipoInmueble" name="tipoInmueble" class="form-control @error('tipoInmueble') is-invalid @enderror">
                                    <option value="-">-</option>
                                    <option id="Pi" value="P">Piso</option>
                                    <option id="Du" value="D">Duplex</option>
                                    <option id="Ad" value="A">Adosado</option>
                                    <option id="Ch" value="C">Chalet</option>
                                    <option id="Ba" value="B">Bajo</option>
                                </select>
                                <strong id="mensajetipoInmueble" class="comprobaciones" ></strong>
                                @error('tipoInmueble')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <strong id="mensajetipoInmueble" class="comprobaciones" ></strong>
                            @error('tipoInmueble')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="nPatio">Patio</label>
                                <input type="number" class="form-control @error('nPatio') is-invalid @enderror" name="nPatio" id="nPatio" placeholder="NºPatio">
                                <strong id="mensajenPatio" class="comprobaciones" ></strong>
                                @error('nPatio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="nPuerta">Puerta</label>
                                <input type="text" value="{{$datos[0]->nPuerta}}" class="form-control @error('nPuerta') is-invalid @enderror" name="nPuerta" id="nPuerta" placeholder="NºPuerta">
                                <strong id="mensajenPuerta" class="comprobaciones" ></strong>
                                @error('nPuerta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="nPiso">Piso</label>
                                <input type="number" class="form-control @error('nPuerta') is-invalid @enderror" name="nPiso" id="nPiso" placeholder="NºPiso">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="bloque">Bloque</label>
                                <input type="text" class="form-control" name="bloque" id="bloque" placeholder="Bloque">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="escalera">Escalera</label>
                                <input type="text" class="form-control" name="escalera" id="escalera" placeholder="Escalera">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="cp">Barrio</label>
                                <input id="barrio" type="text" class="form-control @error('barrio') is-invalid @enderror" name="barrio" id="barrio" placeholder="Nombre del Barrio">
                                <strong id="mensajenbarrio" class="comprobaciones" ></strong>
                                @error('cp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="provincia">Provincia</label>
                                <input id="provincia" value="{{$datos[0]->provincia}}" type="text" class="form-control  @error('provincia') is-invalid @enderror" value=""name="provincia" id="provincia" placeholder="Provincia">
                                <strong id="mensajeprovincia" class="comprobaciones" ></strong>
                                @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="localidad">Localidad</label>
                                <input id="localidad" type="text" value="{{$datos[0]->localidad}}" class="form-control  @error('localidad') is-invalid @enderror" name="localidad" id="localidad" placeholder="Localidad">
                                <strong id="mensajelocalidad" class="comprobaciones" ></strong>
                                @error('localidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-12">
                                <label class="font-weight-bold" for="cp">Código Postal</label>
                                <input id="cp" type="number" value="{{$datos[0]->codigo_postal}}" class="form-control @error('cp') is-invalid @enderror" name="cp" id="cp" placeholder="Codigo Postal">
                                <strong id="mensajencp" class="comprobaciones" ></strong>
                                @error('cp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                        
                        <hr>
                        <p class="font-weight-bold">Especificaciones del Inmueble</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold" for="nHabitaciones">Habitaciones</label>
                                <input type="number" value="{{$datos[0]->n_habitaciones}}" class="form-control @error('nHabitaciones') is-invalid @enderror" name="nHabitaciones" id="nHabitaciones" placeholder="NºHabitaciones">
                                <strong id="mensajenHabitaciones" class="comprobaciones" ></strong>
                                @error('nHabitaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold" for="nCuartosBanyo">Baños</label>
                                <input type="number" value="{{$datos[0]->n_cuartos_de_banyo}}" class="form-control @error('nCuartosBanyo') is-invalid @enderror" name="nCuartosBanyo" id="nCuartosBanyo" placeholder="Nº Cuartos de Baño">
                                <strong id="mensajenCuartosBanyo" class="comprobaciones" ></strong>
                                @error('nCuartosBanyo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold" for="nMetrosCuadrados">Área</label>
                                <input type="number" value="{{$datos[0]->metros_cuadrados}}" class="form-control @error('nMetrosCuadrados') is-invalid @enderror" name="nMetrosCuadrados" id="nMetrosCuadrados" placeholder="Metros Cuadrados">
                                <strong id="mensajenMetrosCuadrados" class="comprobaciones" ></strong>
                                @error('nMetrosCuadrados')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                     
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <span class="font-weight-bold" >Extras del Inmueble</span>
                                <div class="form-check">
                                    <input id="formAscensor" class="form-check-input" type="checkbox" name="ascensor" value="ascensor" id="ascensor">
                                    <label class="form-check-label" for="ascensor">Ascensor</label>
                                </div>
                                <div class="form-check">
                                    <input id="formGaraje" class="form-check-input" type="checkbox" name="garage" value="garage" id="garage">
                                    <label class="form-check-label" for="garage">Garage</label>
                                </div>
                                <div class="form-check">
                                    <input id="formPiscina" class="form-check-input" type="checkbox" name="piscina" value="piscina" id="piscina">
                                    <label class="form-check-label" for="piscina">Piscina</label>
                                </div>
                            </div>
                            @if($datos[0]->alquiler == true)
                            <div id="extraAlquiler" class="col-6">
                                <span class="font-weight-bold" >Extras del Inmueble Alquilado</span>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="animales" value="animales" id="formAnimales">
                                    <label class="form-check-label" for="animales">Se Admiten Animales</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reformas" value="reformas" id="formReformas">
                                    <label class="form-check-label" for="reformas">Se Permiten reformas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="internet" value="internet" id="formInternet">
                                    <label class="form-check-label" for="internet">Hay Internet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="calefaccion" value="formCalefaccion" id="formCalefaccion">
                                    <label class="form-check-label" for="calefaccion">Calefaccion</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="aire" value="aire" id="formAire">
                                    <label class="form-check-label" for="aire">Aire Acondicionado</label>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label class="font-weight-bold" for="precio">Precio del Inmueble</label>
                                <input type="number" value="{{$datos[0]->precio}}" class="form-control @error('precio') is-invalid @enderror" name="precio" id="formPrecio" placeholder="Precio del Inmueble">
                                <strong id="mensajeprecio" class="comprobaciones" ></strong>
                                @error('nCuartosBanyo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if($datos[0]->alquiler == true)
                            <div id="fianza" class="form-group col-6">
                                <label class="font-weight-bold" for="fianza">Fianza que se debe abonar</label>
                                <input type="number" class="form-control @error('fianza') is-invalid @enderror" name="fianza" id="formFianza" placeholder="Fianza que se debe abonar">
                                <strong id="mensajefianza" class="comprobaciones" ></strong>
                                @error('fianza')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="form-group" id="divButton">
                            <div class="form-row">
                                <div class="col-md-6" id="perf">
                                    <span  class="font-weight-bold">Imagén de perfil</span>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('perfil') is-invalid @enderror" name="perfil" id="perfil">
                                        <label id="labelImagenPefil" class="custom-file-label" for="perfil">Selecionar Imagen de Perfil</label>
                                        <strong id="mensajeperfil" class="comprobaciones"></strong>
                                        @error('perfil')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id="masImg">
                                    <span  class="font-weight-bold">Añadir más imagenes</span>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="masImagenes[]" multiple="" id="masImagenes">
                                        <label id="labelmasImagenes" class="custom-file-label" for="masImagenes">Selecionar más Imagenes</label>
                                        <strong id="mensajemasImagenes" class="comprobaciones"></strong>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion"name="descripcion" id="descripcion"rows="5"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" id='botonRegistro' class="btn btn-info">Guardar Modificaciones</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop