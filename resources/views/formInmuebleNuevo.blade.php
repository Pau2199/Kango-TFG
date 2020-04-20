@extends('layouts.master')
@section('titulo')
<title>Nuevo Inmueble | Kangoo Home</title>    
@stop
<!--
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloIndex.css')}}">
@stop
-->
@section('js')
<script src="{{asset('js/registrarInmuebleJS.js')}}"></script>
@stop
@section('content')
<div class="container">
    <div class="row p-5 justify-content-center">
        <div class="col-sm-12 col-md-8">
            <form action="agregarInmueble" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="tipoCompra">Tipo de Publicación</label>
                        <select id="opcionAlquiler" name="tipoCompra" class="form-control">
                            <option value="-">-</option>
                            <option value="A">Alquiler</option>
                            <option value="AQ">Alquiler Vacacional</option>
                            <option value="C">Compra</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="tipoInmueble">Tipo de Inmueble</label>
                        <select name="tipoInmueble" class="form-control">
                            <option value="-">-</option>
                            <option value="P" selected>Piso</option>
                            <option value="D">Duplex</option>
                            <option value="A">Adosado</option>
                            <option value="C">Chalet</option>
                            <option value="B">Bajo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="provincia">Provincia</label>
                        <input type="text" class="form-control" value="valencia" name="provincia" id="provincia" placeholder="Provincia">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="localidad">Localidad</label>
                        <input type="text" class="form-control" value="valencia" name="localidad" id="localidad" placeholder="Localidad">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label  class="font-weight-bold" for="tipoVia">Tipo Vía</label>
                        <select name="tipoVia" class="form-control">
                            <option value="-">-</option>
                            <option value="C" selected>Calle</option>
                            <option value="A">Avenida</option>
                            <option value="P">Plaza</option>
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label class="font-weight-bold" for="nombreDir">Nombre</label>
                        <input type="text" class="form-control" value="Calvo Acacio" name="nombreDir" id="nombreDir" placeholder="Nombre de la dirección">
                    </div>
                    <div class="form-group col-md-2">
                        <label class="font-weight-bold" for="nPatio">Patio</label>
                        <input type="text" class="form-control" value="21" name="nPatio" id="nPatio" placeholder="NºPatio">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="nPuerta">Puerta</label>
                        <input type="text" class="form-control" value="6" name="nPuerta" id="nPuerta" placeholder="NºPuerta">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="nPiso">Piso</label>
                        <input type="text" class="form-control" value="2" name="nPiso" id="inputAddress2" placeholder="NºPiso">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="bloque">Bloque</label>
                        <input type="text" class="form-control" name="bloque" id="bloque" placeholder="Bloque">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="escalera">Escalera</label>
                        <input type="text" class="form-control" name="escalera" id="escalera" placeholder="Escalera">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="nHabitaciones">Número de Habitaciones</label>
                        <input type="number" class="form-control" value="5" name="nHabitaciones" id="nHabitaciones" placeholder="NºHabitaciones">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="nCuartosBanyo">Número de Cuartos de Baño</label>
                        <input type="number" class="form-control" value="1" name="nCuartosBanyo" id="nCuartosBanyo" placeholder="Nº Cuartos de Baño">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="nMetrosCuadrados">Metros Cuadrados</label>
                        <input type="number" class="form-control" value="90" name="nMetrosCuadrados" id="nMetrosCuadrados" placeholder="Metros Cuadrados">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="font-weight-bold" >Extras del Inmueble</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="acensor" value="ascensor" id="ascensor">
                                <label class="form-check-label" for="ascensor">Ascensor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="garage" value="garage" id="garage">
                                <label class="form-check-label" for="garage">Garage</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="piscina" value="piscina" id="piscina">
                                <label class="form-check-label" for="piscina">Piscina</label>
                            </div>
                        </div>
                        <div id="extraAlquiler" class="col-md-6">
                            <span class="font-weight-bold" >Extras del Inmueble Alquilado</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="animales" value="animales" id="animales">
                                <label class="form-check-label" for="animales">Se Admiten Animales</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reformas" value="reformas" id="reformas">
                                <label class="form-check-label" for="reformas">Se Permiten reformas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="internet" value="internet" id="internet">
                                <label class="form-check-label" for="internet">Hay Internet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="calefaccion" value="calefaccion" id="calefaccion">
                                <label class="form-check-label" for="calefaccion">Calefaccion</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="aire" value="aire" id="aire">
                                <label class="form-check-label" for="aire">Aire Acondicionado</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold" for="precio">Precio del Inmueble</label>
                            <input type="number" class="form-control" value="240" name="precio" id="precio" placeholder="Precio del Inmueble">
                        </div>
                        <div id="fianza" class="form-group col-md-6">
                            <label class="font-weight-bold" for="fianza">Fianza que se debe abonar</label>
                            <input type="number" class="form-control" value="900" name="fianza" id="fianza" placeholder="Fianza que se debe abonar">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <span  class="font-weight-bold">Imagén de perfil</span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="perfil" id="perfil">
                                <label class="custom-file-label" for="perfil">Selecionar Imagen de Perfil</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span  class="font-weight-bold">Añadir más imagenes</span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="masImagenes[]" multiple="" id="masImagenes">
                                <label class="custom-file-label" for="masImagenes">Selecionar más Imagenes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" cols="90" rows="5">asasasas</textarea>
                </div>
                <div class="justify-content-center">
                    <button type="submit" class="btn btn-primary">Registrar Inmueble!</button>
                </div>
                <input type="hidden" class="form-control" name="usuario" value="{{auth()->id()}}"id="usuario">
            </form>
        </div>
    </div>
</div>
@stop