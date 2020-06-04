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
<div class="table-responsive">
    <table class="table table-bordered w-75 ml-auto mr-auto">
        <thead>
            <tr class="text-center">
                <th scope="col">
                <a type="button" data-toggle="modal" data-target="#ventanaModal"><img title="Click para obtener mas información"class="question" src="{{asset('img/question.svg')}}" alt="Ventana Modal"></a>
                </th>
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
<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Instrucciones de Uso</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Debes realizar doble click sobre un recuadro que no este colerado para agregar una franja Horaria</li>
                    <li>Para eliminar una franja horaria, simplemente haz click sobre un recuadro coloreado</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@stop