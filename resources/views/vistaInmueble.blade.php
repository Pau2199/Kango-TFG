@extends('layouts.master')
@section('titulo')
<title>Inmueble | Kangoo Home</title>    
@stop
@section('letra')
<link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
@stop
@section('css')
<link rel="stylesheet" href="{{asset('css/estiloAnuncios.css')}}">
@stop
@section('js')
<script src="{{asset('js/anunciosInmuebleJS.js')}}"></script>
@stop
@section('content')

<div class="container-fluid my-4">
    <div class="row">
        <div class=" col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-75" src="{{asset('uploads/perfil15.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-75" src="{{asset('uploads/perfil15.jpg')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-75" src="{{asset('uploads/perfil14.png')}}" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-75" src="{{asset('uploads/perfil14.png')}}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                <img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1">
                                <img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2">
                                <img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2">
                                <img src="https://pbs.twimg.com/profile_images/905183271046193153/q_P1KBUJ_400x400.jpg" class="img-fluid"/>
                            </li>
                        </ol>
                    </div> 
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="col-md-6">
                        <img src="{{asset('uploads/perfil15.jpg')}}" class="img-fluid mb-3" data-target="#carouselExampleIndicators" data-slide-to="0"/>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('uploads/perfil15.jpg')}}" class="img-fluid" data-target="#carouselExampleIndicators" data-slide-to="1"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-md-6">
                        <img src="{{asset('uploads/perfil14.png')}}" class="img-fluid mb-3" data-target="#carouselExampleIndicators" data-slide-to="2"/>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('uploads/perfil14.png')}}" class="img-fluid" data-target="#carouselExampleIndicators" data-slide-to="2"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@stop