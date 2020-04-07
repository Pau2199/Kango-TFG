<header class="container-fluid" id="colorCabecera">
    <div class="row justify-content-between">
        <div class="col-md-3">
            <a href="{{url('/')}}"><img id="imgLogo" src="{{asset('img/Logo.png')}}" alt="Logo Página"></a>
        </div>
        <div class="col-md-7 search mt-4">
            <form class="form-inline">
                <input class="form-control mr-2 w-75" type="text" placeholder="Buscar Inmueble" aria-label="Buscar">
                <button class="btn btn-outline-success my-2" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-md-2 my-1">
            <div class="btn-group mr-5">
                <a href="#" data-toggle="dropdown"><img id="svgTamanyo" class="ml-3 mt-4" src="{{asset('img/user.svg')}}" alt="Me gusta"></a>
                <div class="dropdown-menu mr-5">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <img id="svgTamanyo" class="ml-3 mt-4" src="{{asset('img/corazon.svg')}}" alt="Me gusta">
        </div>
    </div>
</header>