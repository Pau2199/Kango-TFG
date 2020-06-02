<header class="container-fluid footerGrande">
    <div class="row justify-content-between">
        <div class="col-md-3 col-4">
            <a href="{{url('/')}}"><img id="imgLogo" src="{{asset('img/Logo.png')}}" alt="Logo Página"></a>
        </div>
        <div class="col-md-6 d-none d-md-block search mt-4">
            <form class="form-inline">
                <input class="form-control mr-2 w-75" type="text" placeholder="Buscar Inmueble" aria-label="Buscar">
                <button class="btn btn-warning my-2" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-md-3 col-8 my-5 my-md-4 text-center">
            <div class="btn-group mr-5 mr-md-4">
                <a href="#" data-toggle="dropdown"><img id="login" class="svgTamanyo" src="{{asset('img/user.svg')}}" alt="Usuario"></a>
                @if(!Auth::user())
                <div class="container dropdown-menu login mr-3 dropdown-menu-right">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <form class="px-4 py-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group text-left">
                                    <label for="emailLogin" class="font-weight-bold col-form-label">{{ __('Correo Electronico') }}</label>
                                    <input id="emailLogin" type="email" class="form-control @error('emailLogin') is-invalid @enderror" name="email" value="{{ old('emailLogin') }}" required autocomplete="email" autofocus>
                                    @error('emailLogin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="textoLogin">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group text-left">
                                    <label for="password" class="font-weight-bold col-form-label">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="textoLogin">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar Datos') }}
                                    </label>
                                </div>
                                <button type="submit" class="mt-3 btn btn-warning">
                                    {{ __('Entrar') }}
                                </button>
                            </form>
                            <div class="dropdown-divider"></div>
                            @if (Route::has('password.request'))
                            <!--                            <a class="btn btn-link" href="{{ route('password.request') }}">
{{ __('¿Has olvidado tu contraseña?') }}
</a>-->
                            <a class="btn colorTexto" href="{{ route('register') }}">
                                {{ __('¿Nuevo en Kangoo Home? Registrarte aquí!') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="dropdown-menu dropdown-menu-right bg-light menuUser">
                    <a class="dropdown-item" href="/inmuebles/anunciosActivos">Inmuebles</a>
                    <a class="dropdown-item" href="/perfil/datosPersonales">Perfil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Session') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @endif
            </div>
            @if(Auth::user())
            <div class="btn-group mr-5 mr-md-4" id="notificacion">
                <a href="/notificaciones"><img class="svgTamanyo" class="mt-4" src="{{asset('img/notificacion.svg')}}" alt="Correo"></a>
            </div>
            @endif
            <a href="/favoritos/mostrarFavoritos"><img class="svgTamanyo" class="mt-4" src="{{asset('img/corazon.svg')}}" alt="Me gusta"></a>
        </div>
    </div>
</header>
<nav id="navbar" class="navbar navbar-expand footerPequenyo">
    <div class="collapse navbar-collapse" id="navbarNav">
        @if(Request::is('inmuebles/anunciosActivos', 'inmuebles/publicarNuevo'))
        @include('Partials.Navs.inmuebleNav')
        @elseif(Request::is('perfil/horarioVisita', 'perfil/datosPersonales', 'perfil/solicitudesVisita', 'perfil/solicitudesAlquiler','notificaciones', 'favoritos/mostrarFavoritos', 'perfil/misalquileres'))
        @include('Partials.Navs.perfilNav')
        @else
        @include('Partials.Navs.indexNav')
        @endif
    </div>
</nav>


