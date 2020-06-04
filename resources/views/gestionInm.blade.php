@extends('layouts.master')
@section('titulo')
<title>Gestión Inmuebles | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/gestionInmJS.js')}}"></script>
@stop
@section('content')
<table class="table table-hover my-3">
    <thead class="thead-light">
        <tr class="text-center">
            <th scope="col"></th>
            <th scope="col">Propietario</th>
            <th scope="col">Tipo</th>
            <th scope="col">Alquilable</th>
            <th scope="col">€</th>
            <th scope="col">Desc</th>
            <th scope="col">Dirección</th>
            <th scope="col">Piscina</th>
            <th scope="col">Ascensor</th>
            <th scope="col">Garaje</th>
            <th scope="col">Hab.</th>
            <th scope="col">Baños</th>
            <th scope="col">m²</th>
            <th scope="col">Activo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($inmueble as $key => $inm)
        <tr class="text-center" id="I-{{$inm->id}}">
            <td>
                @if($inm->alquiler == true)
                <a href="/inmuebles/vistaInmueble/A-{{$inm->id}}"><span class="btn btn-warning">Ver</span></a>
                @else
                <a href="/inmuebles/vistaInmueble/V-{{$inm->id}}"><span class="btn btn-warning">Ver</span></a>
                @endif
            </td>
            <td>
                {{$inm->usuario[0]->nombre}} {{$inm->usuario[0]->primer_apellido}} {{$inm->usuario[0]->segundo_apellido}}
            </td>
            <td>                
                @if($inm->tipo_de_vivienda == 'P')
                Piso
                @elseif($inm->tipo_de_vivienda == 'D')
                Duplex
                @elseif($inm->tipo_de_vivienda == 'A')
                Adosado
                @elseif($inm->tipo_de_vivienda == 'C')
                Chalet
                @else
                Bajo
                @endif
            </td>
            <td>
                @if($inm->alquiler == true)
                Sí
                @else
                No
                @endif
            </td>
            <td>{{$inm->precio}}</td>
            <td>            
                <a class="descripcion" type="button" data-toggle="modal" data-target="#ventanaModal"><img class="lupa" src="{{asset('img/lupa.svg')}}" alt=""></a>
            </td>
            <td>                            
                @if($inm->direccion[0]->tipo_de_via == 'C')
                Calle 
                @elseif($inm->direccion[0]->tipo_de_via == 'A')
                Avenida
                @else
                Plaza
                @endif
                {{$inm->direccion[0]->nombre_de_la_direccion}}
                {{$inm->direccion[0]->idProvincia[0]->nombre}},
                {{$inm->direccion[0]->idLocalidad[0]->nombre}}
            </td>
            <td>
                @if($inm->piscina == 0)
                No
                @else
                Sí
                @endif
            </td>
            <td>
                @if($inm->ascenso == 0)
                No
                @else
                Sí
                @endif
            </td>
            <td>
                @if($inm->garage == 0)
                No
                @else
                Sí
                @endif
            </td>
            <td>{{$inm->n_habitaciones}}</td>
            <td>{{$inm->n_cuartos_de_banyo}}</td>
            <td>{{$inm->metros_cuadrados}}</td>
            <td>
                @if($inm->disponible == 0)
                No
                @else
                Sí
                @endif
            </td>
            <td>
                <span id="eliminar" class="btn btn-danger">Eliminar</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Descripción del Inmueble</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
            <span id="introducirTexto"></span>
            </div>
        </div>
    </div>
</div>
@stop
