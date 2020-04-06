<header class="container-fluid" id="colorCabecera">
    <div class="row justify-content-between">
        <div class="col-md-4 d-md-block d-none my-4">
            <a href="{{url('/')}}"><img id="imgLogo" src="{{asset('img/Logo.png')}}" alt="Logo Página"></a>
        </div>
        <div class="my-md-4 col-md-6 d-md-block d-none search">
            <form class="form-inline">
                <input class="form-control mr-2 w-50" type="text" placeholder="Buscar imueble" aria-label="Buscar">
                <button class="btn btn-outline-success my-2" type="submit">Buscar</button>
            </form>
        </div>
        <div class="d-none d-md-block col-md-2">
            <a href="{{{ Auth::user() ? url('perfil') : url('login') }}}"><img class="svgTamanyo iconosMovil ml-3" src="{{asset('img/user.svg')}}" alt="Control Usuario"></a>
            <a href="{{url('carrito')}}" ><img class="svgTamanyo iconosMovil ml-3" src="{{asset('img/carritoCompra.svg')}}" alt="Carrito de la Compra"> </a>
        </div>
        <div class="d-block d-md-none col-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <img class="imgLogo" src="{{asset('img/logo.png')}}" alt="Logo Página">
                    </div>
                    <div class="col-6">
                        <a href="" ><img id="svgTamanyo iconosMovil ml-3" src="{{asset('img/user.svg')}}" alt="Control Usuario"></a>

                        <a href="{{url('carrito')}}" ><img class="svgTamanyo iconosMovil ml-3" src="{{asset('img/carritoCompra.svg')}}" alt="Carrito de la Compra"> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>