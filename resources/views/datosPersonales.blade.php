@extends('layouts.master')
@section('titulo')
<title>Datos Personales | Kangoo Home</title>    
@stop
@section('content')

<h4 class="text-center my-3">Datos Personales</h4>
<div class="container justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label class="font-weight-bold">Nombre Completo</label>
                </div>
                <div class="col-md-8 col-6">
                    <span>{{Auth::User()->nombre}} {{Auth::User()->primer_apellido}} {{Auth::User()->segundo_apellido}}</span>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label class="font-weight-bold">DNI o NIE</label>
                </div>
                <div class="col-md-8 col-6">
                    <span>{{Auth::User()->nif_nie}}</span>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label class="font-weight-bold">Sexo</label>
                </div>
                <div class="col-md-8 col-6">
                    <span>
                        @if(Auth::User()->sexo == 'H')
                        Hombre
                        @else
                        Mujer
                        @endif
                    </span>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label class="font-weight-bold">Correo Electrónico</label>
                </div>
                <div class="col-md-8 col-6">
                    <span>{{Auth::User()->email}}</span>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label class="font-weight-bold">Fecha de Nacimiento</label>
                </div>
                <div class="col-md-8 col-6">
                    <span>{{Auth::User()->fecha_nacimiento}}</span>
                </div>
            </div>
            <hr/>
            <div class="row justify-content-center">
                <div class="col-sm-3 col-md-2 col-5">
                    <a href="/perfil/editarPerfil/{{Auth::User()->id}}"><span class="btn btn-warning">Modificar Datos</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
