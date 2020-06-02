@extends('layouts.master')
@section('titulo')
<title>Inmueble | Kangoo Home</title>    
@stop
@section('css')
@stop
@section('js')
<script src="{{asset('js/solicitudesJS.js')}}"></script>
@stop
@section('content')
<table class="table table-striped text-center">
    <thead class="table-warning">
        <tr>
            <th>Fecha Inicio Alquiler</th>
            <th>Fecha Finalización</th>
            <th>Dirección</th>
            <th>Fianza Abonada</th>
            <th>Pago Mensual</th>
            <th>NºCuenta</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alquiler as $key => $datos)
        <span>{{$datos}}</span>
        <td>{{$datos->fecha_inicio}}</td>
        <td>{{$datos->fecha_final}}</td>
        <td>{{$datos->direccion[0]->tipo_de_via}} {{$datos->direccion[0]->nombre_de_la_direccion}} {{$datos->direccion->idProvincia[0]->nombre}}, {{$datos->direccion->idLocalidad[0]->nombre}}</td>
        <td>{{$datos->fianza[0]->fianza}} €</td>
        <td>{{$datos->precio[0]->precio}} €</td>
        <td>{{$datos->numero_de_cuenta}}</td>
        @endforeach     
    </tbody>
</table>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@stop