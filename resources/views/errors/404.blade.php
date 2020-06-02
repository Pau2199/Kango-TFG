@extends('layouts.master')

@section('code', '404')
@section('titulo')
<title>Página No Encontrada</title>    
@stop

@section('content')
<h2 class="text-center">Error 404</h2>
<p class="text-center">Lo sentimos, no se ha encontrado la página solicitada</p>
<div class="text-center">
    <a href="/"><span class="btn btn-warning shadow-sm rounded-pill">Volver al Inicio</span></a>
</div>
@endsection