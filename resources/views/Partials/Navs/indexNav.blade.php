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
        <span class="btn btn-light botonesOrden">Menor a Mayor</span>
    </li>
    <li class="nav-item mr-1">
        <span class="btn btn-light botonesOrden">Mayor a Menor</span>
    </li>
    <li class="nav-item dropdown mr-5">
        <span class="dropdown-toggle btn btn-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</span>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <span class="dropdown-item" href="#">M2</span>
            <span class="dropdown-item" href="#">Recientes</span>
        </div>
    </li>
</ul>