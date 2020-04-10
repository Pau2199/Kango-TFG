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
<div class="container-fluid">
    <div class="row">
        <div id="panelFiltros"class="col-lg-2 d-none d-lg-block">
            <aside class="colorFondo my-3">
                <h4>Filtros de Busqueda</h4>
                <form id="filtroBusqueda">
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Tipo de busqueda</span>
                        <div class="checkbox mt-1">
                            <label class="mr-2"><input class="tipoBusqueda" name="tipoBusqueda" value="alquiler" type="radio">Alquiler</label>
                            <label class="ml-2"><input class="tipoBusqueda" name="tipoBusqueda" value="comprar" type="radio">Compra</label>
                        </div>
                    </div>
                    <!-- Desde aquí-->
                    <!-- Sera tratado con javascript dependiendo de la opción que elija en tipo de Busqueda.-->
                    <div id="eleccionTipoBusqueda" class="form-group m-3">
                        <span id="elegidoEnTipoDeBusqueda" class="font-weight-bold"></span>
                        <div class="checkbox mt-1">
                            <label class="mr-2"><input id="Si" name="tipoBusqueda" value="alquiler" type="radio">Si</label> 
                            <label class="ml-2"><input id="No" name="tipoBusqueda" value="compra" type="radio">No</label>
                        </div>
                    </div>
                    <!-- Hasta aquí-->
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Seleciona una Provincia</span>
                        <select id="provincia" class="form-control w-100">
                            <option selected>-</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Seleciona una Localidad</span>
                        <select id="localidad" class="form-control w-100">
                            <option selected>-</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Tipo de Vivienda</span>
                        <select id="tipoVivienda" class="form-control w-100">
                            <option selected>-</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Nº de Habitaciones</span>
                        <input class="w-100" type="number" name="nHabitaciones" min="1" max="10">
                    </div>
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Nº de Cuartos de Baño</span>
                        <input class="w-100" type="number" name="nHabitaciones" min="1" max="10">
                    </div>
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Opciones de la Vivienda</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="garage" id="garage" value="garage">
                            <label class="form-check-label" for="garage">Garage</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="piscina" id="piscina" value="piscina">
                            <label class="form-check-label" for="piscina">Piscina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="Ascensor" id="Ascensor" value="Ascensor">
                            <label class="form-check-label" for="Ascensor">Ascensor</label>
                        </div>
                        <div id="opcionesAlquiler">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="internet" id="internet" value="internet">
                                <label class="form-check-label" for="internet">Internet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amueblado" id="amueblado" value="amueblado">
                                <label class="form-check-label" for="amueblado">Amueblado</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="animales" id="animales" value="animales">
                                <label class="form-check-label" for="animales">Admite Animales</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reformas" id="reformas" value="reformas">
                                <label class="form-check-label" for="reformas">Admite Reformas</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-3 text-center">
                        <span type="button" class="btn btn-light d-lg-none ">Menor a Mayor</span>
                        <span type="button" class="btn btn-light d-lg-none">Mayor a Menor</span>
                        <span type="button" class="btn btn-danger">Reiniciar Filtros</span>
                    </div>
                </form>
            </aside>
        </div>
        <div class="col-lg-8 cold-md-2 col-12">
            <section>
                CASAASASASASASASA
            </section>
        </div>
    </div>
</div>
@stop