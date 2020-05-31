@extends('layouts.master')
@section('titulo')
<title>Pago Fianza Alquiler | Kangoo Home</title>    
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloPago.css')}}">
@stop
@section('js')
<script src="{{asset('js/pagoJS.js')}}"></script>
@stop
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <ul class="nav bg-light rounded-pill nav-fill mb-3">
                <li class="nav-item rounded-pill nav-tab-datosPer font-weight-bold">
                    Paso 1
                </li>
                <li class="nav-item rounded-pill nav-tab-pago font-weight-bold">
                    Paso 2
                </li>
                <li class="nav-item rounded-pill nav-tab-continuar font-weight-bold">
                    Paso 3
                </li>
            </ul>
            <form role="form">
                <div class="tab-content">
                    <div id="nav-tab-datosPer" class="tab-pane fade show active">
                        <div class="form-group">
                            <label for="cardNumber">Número de Cuenta</label>
                            <input type="text" id="numeroCuenta" name="numeroCuenta" placeholder="ESXX XXXX XXXX XXXX XXXX XXXX" class="form-control" required>
                            <strong id="mensajenumeroCuenta"></strong>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="duracion">Duración del Alquiler</label>
                                <select id="duracion" name="duracion" class="form-control">
                                    <option value="-" selected>-</option>
                                    <option value="Indefinido">Indefinido</option>
                                    <option value="FechaConcreta">Fecha Concreta</option>
                                </select>
                                <strong id="mensajeduracion"></strong>
                            </div>
                            <div class="form-group col-md-6">
                                <label><span class="hidden-xs">Tiempo Alquiler</span></label>
                                <input type="date" id="fechaDuracion" name="fechaDuracion" class="form-control" required>
                                <strong id="mensajefechaDuracion"></strong>
                            </div>
                        </div>
                        <div class="text-center">
                            <button data-toggle="pill" href="#nav-tab-pago" class="btn btn-warning shadow-sm rounded-pill">
                                Siguiente Paso
                            </button>
                        </div>
                    </div>
                    <div id="nav-tab-pago" class="tab-pane fade">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <div class="form-group">
                                <label for="username">Titular de la Tarjeta</label>
                                <input type="text" id="username" name="username" placeholder="Kangoo Home" required class="form-control">
                                <strong id="mensajeusername"></strong>
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">Número de la Tarjeta</label>
                                <input type="text" id="numeroTarjeta" name="numeroTarjeta" placeholder="123456789" class="form-control" required>
                                <strong id="mensajenumeroTarjeta"></strong>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-5">
                                    <label>Fecha de Caducidad</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" placeholder="MM" id="mes" name="mes" class="form-control" required>
                                            <strong id="mensajemes"></strong>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" placeholder="YY" id="anyo" name="anyo" class="form-control" required>
                                            <strong id="mensajeanyo"></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-3">
                                    <label for="cvv">CVV</label>
                                    <input id="cvv" name="cvv" type="text" required class="form-control">
                                    <strong id="mensajecvv"></strong> 
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button data-toggle="pill" href="#nav-tab-datosPer" class="btn btn-warning shadow-sm rounded-pill">
                                Paso Anterior
                            </button>
                            <button data-toggle="pill" id="segundoPaso" class="btn btn-warning shadow-sm rounded-pill">
                                Siguiente paso
                            </button>
                        </div>
                    </div>

                    <div id="nav-tab-continuar" class="tab-pane fade">
                        <div class="row">
                            <div class="col-6">
                                <h6>Detalles del Contrato</h6>
                                <p id="cuenta"></p>
                                <p id="tiempo"></p>
                                <p>Mensualidad: 500 €</p>  
                            </div>
                            <div class="col-6">
                                <h6>Detalles del Pago</h6>
                                <p id="titular"></p>
                                <p id="tarjeta"></p>
                                <p>Importe a Pagar: 1500 €</p>
                                <p>Concepto: Pago de fianza</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="btn btn-warning">Pagar</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop