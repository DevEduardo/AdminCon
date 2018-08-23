<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admincon</title>

    <!-- Fonts -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
</head>
<body class="teal lighten-5">
    <div id="app">
        @if(Auth::check())
          @if(Auth::user()->rol == 1)
            <!--Navbar Admin-->
            <nav class="navbar navbar-expand-lg navbar-dark teal">

              <!-- Navbar brand -->
              <a class="navbar-brand" href="#">Admincon</a>

              <!-- Collapse button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <!-- Collapsible content -->
              <div class="collapse navbar-collapse" id="basicExampleNav">
                  <ul class="navbar-nav nav-flex-icons ml-auto">
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name}}</a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Cerrar sesion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                          </div>
                      </li>
                  </ul>
              </div>
              <!-- Collapsible content -->
            </nav>
            <!--/.Navbar Admin-->
          @endif
          @if(Auth::user()->rol == 2 || Auth::user()->rol == 3)
            <!--Navbar Agency/employee-->
            <nav class="navbar navbar-expand-lg navbar-dark teal">

              <!-- Navbar brand -->
              <a class="navbar-brand" href="#">Admincon</a>

              <!-- Collapse button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <!-- Collapsible content -->
              <div class="collapse navbar-collapse" id="basicExampleNav">

                  <!-- Links -->
                  @if(Request::path() != 'login' && !isset($home))
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                          <a class="nav-link" href="{{url('/home')}}">Inicio
                              <span class="sr-only">(current)</span>
                          </a>
                      </li>
                      @if(Auth::user()->rol == 2)
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="Registros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Registros</a>
                          <div class="dropdown-menu dropdown-menu-center" aria-labelledby="Registros">
                              <a class="dropdown-item" href="{{ url('condominios') }}">Condominios</a>
                              <a class="dropdown-item" href="{{ url('inmuebles') }}">Inmuebles</a>
                              <a class="dropdown-item" href="{{ url('salones') }}">Salones</a>
                              <a class="nav-link" href="{{ url('cuentas') }}">Cuentas</a>
                          </div>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="Registros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movimientos</a>
                          <div class="dropdown-menu dropdown-menu-center" aria-labelledby="Registros">
                            <a class="nav-link" href="{{ url('gastos') }}">Gastos</a>
                            <a class="nav-link" href="{{ url('pago') }}">Pagos</a>
                            <a class="nav-link" href="{{ url('facturacion') }}">Facturación</a>
                            <a class="nav-link" href="{{ url('mora') }}">Mora</a>
                          </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('correos') }}">Correos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('informes') }}">Informes</a>
                        </li>
                      @endif
                      @if(Auth::user()->rol == 3 && session('records') == 1)
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="Registros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Registros</a>
                          <div class="dropdown-menu dropdown-menu-center" aria-labelledby="Registros">
                              <a class="dropdown-item" href="{{ url('condominios') }}">Condominios</a>
                              <a class="dropdown-item" href="{{ url('inmuebles') }}">Inmuebles</a>
                              <a class="dropdown-item" href="{{ url('salones') }}">Salones</a>
                              <a class="nav-link" href="{{ url('cuentas') }}">Cuentas</a>
                          </div>
                        </li>
                      @endif
                      @if(Auth::user()->rol == 3 && session('moves') == 1)
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="Registros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Movimientos</a>
                          <div class="dropdown-menu dropdown-menu-center" aria-labelledby="Registros">
                            <a class="nav-link" href="{{ url('gastos') }}">Gastos</a>
                            <a class="nav-link" href="{{ url('pago') }}">Pagos</a>
                            <a class="nav-link" href="{{ url('mora') }}">Mora</a>
                          </div>
                        </li>
                      @endif
                      @if(Auth::user()->rol == 3 && session('emails') == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('correos') }}">Correos</a>
                        </li>
                      @endif
                      @if(Auth::user()->rol == 3 && session('informe') == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('informes') }}">Informes</a>
                        </li>
                      @endif
                  </ul>
                  @endif
                  <!-- Collapsible content -->
                  <div class="collapse navbar-collapse" id="basicExampleNav">
                      <ul class="navbar-nav nav-flex-icons ml-auto">
                        <li class="nav-item"><a class="nav-link"><b>Condominio:</b> {{session('nameCondominium')}}</a></li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name}}</a>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ url('agencia/edit') }}">Modificar datos</a>
                                  <a class="dropdown-item" href="{{ url('agencia/password') }}">Cambiar contraseña</a>
                                  <a class="dropdown-item" href="{{ url('empleados') }}">Empleados</a>
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Cerrar sesion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                              </div>
                          </li>
                      </ul>
                  </div>
                  <!-- Collapsible content -->
              </div>
              <!-- Collapsible content -->
            </nav>
            <!--/.Navbar Agency/employee-->
          @endif
           @if(Auth::user()->rol == 4)
            <!--Navbar Admin-->
            <nav class="navbar navbar-expand-lg navbar-dark teal">

              <!-- Navbar brand -->
              <a class="navbar-brand" href="#">Admincon</a>

              <!-- Collapse button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
                  aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                          <a class="nav-link" href="{{url('/home')}}">Inico
                              <span class="sr-only">(current)</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('residente/salones') }}">Salones</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('residente/correos') }}">Correos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('residente/pagos') }}">Notificacion de pagos</a>
                      </li>
                  </ul>
              <!-- Collapsible content -->
              <div class="collapse navbar-collapse" id="basicExampleNav">
                  <ul class="navbar-nav nav-flex-icons ml-auto">
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name}}</a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Modificar datos</a>
                              <a class="dropdown-item" href="#">Cambiar contraseña</a>
                              <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Cerrar sesion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                          </div>
                      </li>
                  </ul>
              </div>
              <!-- Collapsible content -->
            </nav>
            <!--/.Navbar Admin-->
          @endif
        @endif
        <main class="py-4">
            <div class="container-fluid">
              <div class="row justify-content-center">
                @yield('content')
              </div>
            </div>
        </main>
    </div>
    
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/mdb.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/form-validate.js')}}"></script>
    <script src="{{asset('js/jquery-maskmoney.js')}}"></script>
    <script>
      $(document).ready(function () {
        new WOW().init();
      });
    </script>
</body>
</html>
