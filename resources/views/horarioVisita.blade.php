@extends('layouts.master')
@section('titulo')
<title>Horario Visita | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/horarioVisitaJS.js')}}"></script>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloHorarioVisita.css')}}">
@stop
@section('content')
<div class="text-center w-100 font-weight-bold" id="mensajeInfo">
    <p id="texto"></p>
</div>
<ul>
    <li>Haz doble click sobre un recuadro para agregar una franja horaria</li>
    <li>Para eliminar una franja horaria simplemente haz click sobre el recuadro coloreado</li>
</ul>
<div class="table-responsive">
    <table class="table table-bordered w-75 ml-auto mr-auto">
        <thead>
            <tr class="text-center">
                <th scope="col"></th>
                <th scope="col">Lunes</th>
                <th scope="col">Martes</th>
                <th scope="col">Miercoles</th>
                <th scope="col">Jueves</th>
                <th scope="col">Viernes</th>
                <th scope="col">Sabado</th>
                <th scope="col">Domigo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="text-center font-weight-bold" id="H08">08:00 - 09:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H09">09:00 - 10:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H10">10:00 - 11:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H11">11:00 - 12:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H12">12:00 - 13:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H13">13:00 - 14:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H14">14:00 - 15:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H15">15:00 - 16:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H16">16:00 - 17:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H17">17:00 - 18:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H18">18:00 - 19:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
            <tr>
                <th class="text-center font-weight-bold" id="H19">19:00 - 20:00</th>
                <td class="Lunes"></td>
                <td class="Martes"></td>
                <td class="Miercoles"></td>
                <td class="Jueves"></td>
                <td class="Viernes"></td>
                <td class="Sabado"></td>
                <td class="Domingo"></td>
            </tr>
        </tbody>
    </table>
</div>


<!--<div class="container-fluid">
<div class="row">
<div class="col-3">
<h3 class="text-center">Lunes</h3>
<ul>
<li>Prueba</li>
</ul>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
<div class="col-3">
<h3 class="text-center">Martes</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
<div class="col-3">
<h3 class="text-center">Miercoles</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
</div>
<div class="row">
<div class="col-3">
<h3 class="text-center">Jueves</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
<div class="col-3">
<h3 class="text-center">Viernes</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
<div class="col-3">
<h3 class="text-center">Sabado</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
</div>
<div class="row">
<div class="col-3">
<h3 class="text-center">Domingo</h3>
<div class="text-center">
<span class="btn bg-info">Agregar Hora</span>
</div>
</div>
</div>
</div>-->

@stop