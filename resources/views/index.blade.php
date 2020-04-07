@extends('layouts.master')
@section('titulo')
<title>Kangoo Home | Index</title>    
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
            <aside>
                <h4>Filtros de Busqueda</h4>
                <form id="filtroBusqueda">
                    <div class="form-group m-3">
                        <span class="font-weight-bold">Tipo de busqueda</span>
                        <div class="checkbox mt-1">
                            <label class="mr-2"><input type="radio">Alquiler</label>
                            <label class="ml-2"><input type="radio">Compra</label>
                        </div>
                    </div>
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
                </form>
            </aside>
        </div>
        <div class="col-lg-8">
            <section>
                CASAASASASASASASA
            </section>
        </div>
    </div>
</div>
@stop