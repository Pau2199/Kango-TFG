<header class="container-fluid" id="colorCabecera">
    <div class="row justify-content-between">
        <div class="col-md-3 col-4">
            <a href="{{url('/')}}"><img id="imgLogo" src="{{asset('img/Logo.png')}}" alt="Logo Página"></a>
        </div>
        <div class="col-md-6 d-none d-md-block search mt-4">
            <form class="form-inline">
                <input class="form-control mr-2 w-75" type="text" placeholder="Buscar Inmueble" aria-label="Buscar">
                <button class="btn btn-outline-success my-2" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-md-3 col-8 my-5 my-md-4 text-center">
            <div class="btn-group mr-5 mr-md-4">
                <a href="#" data-toggle="dropdown"><img class="svgTamanyo" class="mt-4" src="{{asset('img/user.svg')}}" alt="Usuario"></a>
                <div class="dropdown-menu mr-5">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <div class="btn-group mr-5 mr-md-4">
                <a href="#" data-toggle="dropdown"><img class="svgTamanyo" class="mt-4" src="{{asset('img/notificacion.svg')}}" alt="Correo"></a>
                <div class="dropdown-menu mr-5">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <img class="svgTamanyo" class="mt-4" src="{{asset('img/corazon.svg')}}" alt="Me gusta">
        </div>
    </div>
</header>
<nav class="navbar navbar-expand filtro">
    <div class="collapse navbar-collapse" id="navbarNav">
        <img id="imagenFiltros" class="svgTamanyo m-2 d-md-block d-lg-none" src="{{asset('img/filtro.svg')}}" alt="">
        <div class="ml-auto d-sm-block d-md-none search mt-1">
            <form class="form-inline">
                <input class="form-control mr-2 w-50" type="text" placeholder="Buscar Inmueble" aria-label="Buscar">
                <button class="btn btn-outline-success my-2" type="submit">Buscar</button>
            </form>
        </div>
        <ul class="d-md-none d-none d-lg-flex navbar-nav ml-auto mr-5">
            <li class="nav-item mt-1">
                <span class="mr-3">Ordenar por: </span>
            </li>
            <li class="nav-item mr-1">
                <span class="btn btn-light">Menor a Mayor</span>
            </li>
            <li class="nav-item mr-1">
                <span class="btn btn-light">Mayor a Menor</span>
            </li>
            <li class="nav-item dropdown mr-5">
                <span class="dropdown-toggle btn btn-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</span>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <span class="dropdown-item" href="#">M2</span>
                    <span class="dropdown-item" href="#">Recientes</span>
                </div>
            </li>
        </ul>
    </div>
</nav>


