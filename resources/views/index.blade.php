@extends('layouts.master')
@section('titulo')
<title>Kangoo Home | Index</title>    
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloIndex.css')}}">
@stop
@section('js')
<script src="{{asset('js/indexJS.js')}}"></script>
@stop
@section('content')
<div class="container-fluid colorBody">
    <div class="row">
        <div id="panelFiltros"class="col-lg-2 d-none d-lg-block mr-5">
            <aside class="colorFondo my-3">
                <h5 class="mx-1 pt-3 text-center">Filtros de Busqueda</h5>
                <form id="filtroBusqueda">
                   @csrf
                    <div class="form-group m-3 text-center">
                        <span class="">Tipo de busqueda</span>
                        <div class="checkbox mt-1">
                            <label class="mr-2"><input class="tipoBusqueda" name="tipoBusqueda" value="alquiler" type="radio"> Alquiler</label>
                            <label class="ml-2"><input class="tipoBusqueda" name="tipoBusqueda" value="comprar" type="radio"> Compra</label>
                        </div>
                    </div>
                    <div class="form-group m-3">
                        <span class="">Seleciona una Provincia</span>
                        <select name="provincia" id="provincia" class="form-control w-100">
                            <option id="guionPro" selected>-</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="">Seleciona una Localidad</span>
                        <select name="localidad" id="localidad" class="form-control w-100">
                            <option id="guionLocal" selected>-</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="">Tipo de Vivienda</span>
                        <select name="tipoInmueble" id="tipoVivienda" class="form-control w-100">
                            <option id="guionInm" selected>-</option>
                            <option value="P">Piso</option>
                            <option value="D">Duplex</option>
                            <option value="A">Adosado</option>
                            <option value="C">Chalet</option>
                            <option value="B">Bajo</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="">Nº de Habitaciones</span>
                        <input class="w-100 form-control" type="number" name="nHabitaciones" min="1" max="10">
                    </div>
                    <div class="form-group m-3">
                        <span class="">Nº de Cuartos de Baño</span>
                        <input class="w-100 form-control" type="number" name="nBanyos" min="1" max="10">
                    </div>
                    <div class="form-group m-3">
                        <span class="">Opciones de la Vivienda</span>
                        <div class="ml-1 mt-1 form-check">
                            <input class="form-check-input" type="checkbox" name="garage" id="garage" value="garage">
                            <label class="form-check-label" for="garage">Garage</label>
                        </div>
                        <div class="ml-1 form-check">
                            <input class="form-check-input" type="checkbox" name="piscina" id="piscina" value="piscina">
                            <label class="form-check-label" for="piscina">Piscina</label>
                        </div>
                        <div class="ml-1 form-check">
                            <input class="form-check-input" type="checkbox" name="ascensor" id="Ascensor" value="Ascensor">
                            <label class="form-check-label" for="Ascensor">Ascensor</label>
                        </div>
                        <div id="opcionesAlquiler">
                            <div class="ml-1 form-check">
                                <input class="form-check-input" type="checkbox" name="internet" id="internet" value="internet">
                                <label class="form-check-label" for="internet">Internet</label>
                            </div>
                            <div class="ml-1 form-check">
                                <input class="form-check-input" type="checkbox" name="aireAcondicionado" id="aireAcondicionado" value="amueblado">
                                <label class="form-check-label" for="aireAcondicionado">Aire Acondicionado</label>
                            </div>
                            <div class="ml-1 form-check">
                                <input class="form-check-input" type="checkbox" name="calefaccion" id="calefaccion" value="calefaccion">
                                <label class="form-check-label" for="calefaccion">Calefacion</label>
                            </div>
                            <div class="ml-1 form-check">
                                <input class="form-check-input" type="checkbox" name="animales" id="animales" value="animales">
                                <label class="form-check-label" for="animales">Admite Animales</label>
                            </div>
                            <div class="ml-1 form-check">
                                <input id="reformas" class="form-check-input" type="checkbox" name="reformas" id="reformas" value="reformas">
                                <label class="form-check-label" for="reformas">Admite Reformas</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group py-4 m-3 text-center">
                        <span type="button" class="btn btn-light d-lg-none botonesOrden">Menor a Mayor</span>
                        <span type="button" class="btn btn-light d-lg-none botonesOrden">Mayor a Menor</span>
                        <span id="reiniciarFiltro" class="btn btn-danger">Reiniciar Filtros</span>
                    </div>
                </form>
            </aside>
        </div>
        <div class="col-lg-9 cold-md-2 col-12">
            <img class="img-fluid" id="carga" src="{{asset('img/carga.jpg')}}" alt="Cargando...">
            <img class="img-fluid" id="sinDatos" src="{{asset('img/sinDatos1.jpg')}}" alt="No se han Encontrado datos">
            <section id="anuncios">
                @foreach($datos as $key => $valor)
                <?php if($valor->alquiler == true){
                    $id = 'A-'.$valor->id;    
                    }else{
                    $id = 'V-'.$valor->id;    
                    }
                    $img = $valor->img[0]->nombre
                ?>
                <div class="card mt-3">
                    <div id="{{$id}}" class="d-flex justify-content-between card-header">
                        <h5>
                            @if($valor->alquiler == true)
                            Alquiler
                            @else
                            Venta
                            @endif
                            de
                            @if($valor->tipo_de_vivienda == 'P')
                            Piso
                            @elseif($valor->tipo_de_vivienda == 'D')
                            Duplex
                            @elseif($valor->tipo_de_vivienda == 'A')
                            Adosado
                            @elseif($valor->tipo_de_vivienda == 'C')
                            Chalet
                            @else
                            Bajo
                            @endif
                            en {{$valor->idProvincia[0]->nombre}}@if($valor->idLocalidad[0]->nombre != $valor->idProvincia[0]->nombre),  {{$valor->idLocalidad[0]->nombre}} @endif
                            - Barrio de {{$valor->barrio}}
                        </h5>
                        <span>{{$valor->nombre}} {{$valor->primer_apellido}} {{$valor->segundo_apellido}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12">
                                <img class="img-fluid" src='{{asset("uploads/$img")}}' alt="">
                            </div>
                            <div class="col-xl-6">
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <img src="{{asset('img/ubicacion.svg')}}" class="iconos" alt="Icono Ubicacion">
                                    </div>
                                    <div class="col-11 d-flex justify-content-between">
                                        <span>
                                            @if($valor->tipo_de_via == 'C')
                                            Calle
                                            @elseif($valor->tipo_de_via == 'A')
                                            Avenida
                                            @else
                                            Plaza
                                            @endif
                                            {{$valor->nombre_de_la_direccion}}
                                            - {{$valor->codigo_postal}}
                                        </span>
                                        <i class="fa fa-heart-o {{$id}} @if($valor->favorito == true) colorCorazon @endif iconoCorazon"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <h4 class="colorPrecio">{{$valor->precio}} €</h4>
                                    </div>
                                    <div class="col-4">
                                        <span>{{$valor->n_habitaciones}} Hab. {{$valor->metros_cuadrados}} m²</span>
                                    </div>
                                    @if($valor->alquiler == true)
                                    <div class="col-4">
                                        <span>Fianza:  {{$valor->datosAlq[0]->fianza}}€</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row justify-content-center my-5">
                                    @if($valor->garage == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/garage.svg')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->piscina == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/piscina.svg')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->ascensor == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/ascensor.png')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->alquiler == true)
                                    @if($valor->datosAlq[0]->animales == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/animales.svg')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->datosAlq[0]->calefaccion == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/calefaccion.png')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->datosAlq[0]->aireAcondicionado == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/aireAcondicionado.svg')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->datosAlq[0]->internet == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/internet.svg')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @if($valor->datosAlq[0]->reformas == true)
                                    <div class="col-1">
                                        <img src="{{asset('img/reformas.png')}}" class="iconos" alt="">
                                    </div>
                                    @endif
                                    @endif

                                </div>
                                <p class="card-text">
                                    {{$valor->descripcion}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>
        </div>
    </div>
</div>
@stop