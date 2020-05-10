@extends('layouts.master')
@section('titulo')
<title>Nuevo Inmueble | Kangoo Home</title>    
@stop
@section('letra')
<link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloRegistrarInmueble.css')}}">
@stop

@section('js')
<script src="{{asset('js/registrarInmuebleJS.js')}}"></script>
@stop
@section('content')
<?php if(!isset($pulsado)) $pulsado ='' ; ?>
<div class="container">
    <div class="row p-5 justify-content-center">
        <div class="col-sm-12 col-md-8">
            <form action="agregarInmueble" id="formAgregarInmueble" enctype="multipart/form-data" method="post">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="tipoCompra">Tipo de Publicación</label>
                        <select id="tipoCompra" name="tipoCompra" class="form-control  @error('tipoCompra') is-invalid @enderror">
                            <option value="-">-</option>
                            <option value="A">Alquiler</option>
                            <option value="AQ">Alquiler Vacacional</option>
                            <option value="C">Compra</option>
                        </select>
                        <strong id="mensajetipoCompra" class="comprobaciones" ></strong>
                        @error('tipoCompra')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="tipoInmueble">Tipo de Inmueble</label>
                        <select id="tipoInmueble" name="tipoInmueble" class="form-control @error('tipoInmueble') is-invalid @enderror">
                            <option value="-">-</option>
                            <option value="P">Piso</option>
                            <option value="D">Duplex</option>
                            <option value="A">Adosado</option>
                            <option value="C">Chalet</option>
                            <option value="B">Bajo</option>
                        </select>
                        <strong id="mensajetipoInmueble" class="comprobaciones" ></strong>
                        @error('tipoInmueble')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="cp">Codigo Postal</label>
                        <input type="number" class="form-control @error('cp') is-invalid @enderror" name="cp" id="cp" placeholder="Codigo Postal">
                        <strong id="mensajencp" class="comprobaciones" ></strong>
                        @error('cp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="provincia">Provincia</label>
                        <input type="text" class="form-control  @error('provincia') is-invalid @enderror" value=""name="provincia" id="provincia" placeholder="Provincia">
                        <strong id="mensajeprovincia" class="comprobaciones" ></strong>
                        @error('provincia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="localidad">Localidad</label>
                        <input type="text" class="form-control  @error('localidad') is-invalid @enderror" name="localidad" id="localidad" placeholder="Localidad">
                        <strong id="mensajelocalidad" class="comprobaciones" ></strong>
                        @error('localidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="cp">Barrio</label>
                        <input type="text" class="form-control @error('barrio') is-invalid @enderror" name="barrio" id="barrio" placeholder="Nombre del Barrio">
                        <strong id="mensajenbarrio" class="comprobaciones" ></strong>
                        @error('cp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label  class="font-weight-bold" for="tipoVia">Tipo Vía</label>
                        <select id="tipoVia" name="tipoVia" class="form-control @error('tipoVia') is-invalid @enderror">
                            <option value="-">-</option>
                            <option value="C">Calle</option>
                            <option value="A">Avenida</option>
                            <option value="P">Plaza</option>
                        </select>
                        <strong id="mensajetipoVia" class="comprobaciones" ></strong>
                        @error('tipoVia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-7">
                        <label class="font-weight-bold" for="nombreDir">Nombre</label>
                        <input type="text" class="form-control @error('nombreDir') is-invalid @enderror" name="nombreDir" id="nombreDir" placeholder="Nombre de la dirección">
                        <strong id="mensajenombreDir" class="comprobaciones" ></strong>
                        @error('nombreDir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label class="font-weight-bold" for="nPatio">Patio</label>
                        <input type="number" class="form-control @error('nPatio') is-invalid @enderror" name="nPatio" id="nPatio" placeholder="NºPatio">
                        <strong id="mensajenPatio" class="comprobaciones" ></strong>
                        @error('nPatio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="nPuerta">Puerta</label>
                        <input type="text" class="form-control @error('nPuerta') is-invalid @enderror" name="nPuerta" id="nPuerta" placeholder="NºPuerta">
                        <strong id="mensajenPuerta" class="comprobaciones" ></strong>
                        @error('nPuerta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold" for="nPiso">Piso</label>
                        <input type="number" class="form-control @error('nPuerta') is-invalid @enderror" name="nPiso" id="nPiso" placeholder="NºPiso">
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
                        <input type="number" class="form-control @error('nHabitaciones') is-invalid @enderror" name="nHabitaciones" id="nHabitaciones" placeholder="NºHabitaciones">
                        <strong id="mensajenHabitaciones" class="comprobaciones" ></strong>
                        @error('nHabitaciones')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="nCuartosBanyo">Número de Cuartos de Baño</label>
                        <input type="number" class="form-control @error('nCuartosBanyo') is-invalid @enderror" name="nCuartosBanyo" id="nCuartosBanyo" placeholder="Nº Cuartos de Baño">
                        <strong id="mensajenCuartosBanyo" class="comprobaciones" ></strong>
                        @error('nCuartosBanyo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold" for="nMetrosCuadrados">Metros Cuadrados</label>
                        <input type="number" class="form-control @error('nMetrosCuadrados') is-invalid @enderror" name="nMetrosCuadrados" id="nMetrosCuadrados" placeholder="Metros Cuadrados">
                        <strong id="mensajenMetrosCuadrados" class="comprobaciones" ></strong>
                        @error('nMetrosCuadrados')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="font-weight-bold" >Extras del Inmueble</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ascensor" value="ascensor" id="ascensor">
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
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" id="precio" placeholder="Precio del Inmueble">
                            <strong id="mensajeprecio" class="comprobaciones" ></strong>
                            @error('nCuartosBanyo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="fianza" class="form-group col-md-6">
                            <label class="font-weight-bold" for="fianza">Fianza que se debe abonar</label>
                            <input type="number" class="form-control @error('fianza') is-invalid @enderror" name="fianza" id="fianza" placeholder="Fianza que se debe abonar">
                            <strong id="mensajefianza" class="comprobaciones" ></strong>
                            @error('fianza')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <span  class="font-weight-bold">Añadir más imagenes</span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="masImagenes[]" multiple="" id="masImagenes">
                                <label id="labelmasImagenes" class="custom-file-label" for="masImagenes">Selecionar más Imagenes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" cols="90" rows="5"></textarea>
                </div>
                <div class="justify-content-center">
                    <button type="submit" id='botonRegistro' class="btn btn-primary">Registrar Inmueble!</button>
                </div>
                <input type="hidden" class="form-control" name="usuario" value="{{auth()->id()}}"id="usuario">
            </form>
        </div>
    </div>
</div>
@stop