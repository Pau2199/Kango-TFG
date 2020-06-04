@extends('layouts.master')
@section('titulo')
<title>Favoritos | Kangoo Home</title>    
@stop
@section('js')
<script src="{{asset('js/favoritosJS.js')}}"></script>
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-hover table-bordered w-75 my-3 ml-auto mr-auto">
        <thead>
            <tr class="text-center">
                <th></th>
                <th scope="col">Tipo Inmueble</th>
                <th scope="col">Precio</th>
                <th scope="col">Disponible</th>
                <th scope="col">Direccion</th>
                <th scope="col">Alquilable</th>
                <th scope="col">Fianza</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="contenido">
            @foreach($datos as $key => $valor)
            <tr>
                <td>
                    <?php 
                    $id ="";
                    if($valor->alquiler == 1){
                        $id = 'A';    
                    }else{
                        $id = 'V';
                        $valor->id;    
                    }
                    $id .= '-'.$valor->id
                    ?>
                    @if($valor->disponible == true)
                    <a href="/inmuebles/vistaInmueble/{{$id}}" class="btn btn-warning">Visualizar</a>
                    @endif
                </td>
                <td id="{{$id}}">
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
                </td>
                <td>{{$valor->precio}} €</td>
                <td>
                    @if($valor->disponible == true)
                    Sí
                    @else
                    No
                    @endif
                </td>
                <td>
                    @if($valor->direccion[0]->tipo_de_via == 'A')
                    Avenida
                    @elseif($valor->direccion[0]->tipo_de_via == 'C')
                    Calle
                    @else
                    Plaza
                    @endif
                    - {{$valor->direccion[0]->nombre_de_la_direccion}} 
                    {{$valor->direccion[0]->idProvincia[0]->nombre}},{{$valor->direccion[0]->idLocalidad[0]->nombre}}
                </td>
                <td>
                    @if($valor->alquiler == 1)
                    Sí
                    @else
                    No
                    @endif
                </td>
                <td>
                    @if($valor->alquiler == 1)
                    {{$valor->datosAlq[0]->fianza}} €
                    @endif
                </td>
                <td>
                    <span class="btn btn-danger">Eliminar</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="noticia"class="text-center"></div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


@stop