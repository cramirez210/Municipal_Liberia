<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('titulo','Municipal Liberia')</title>
        <link rel="shortcut icon" href="{{ asset('storage/img/logo-title.ico') }}"/>

        <!-- Bootstrap CSS -->
        <link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/css/bootstrap.css"> 
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="/css/index.css">
        <link rel="stylesheet" href="/css/style.css"/>
        

    </head>
    <body>
        <!-- Encabesado -->
        <div id="barra" class="container-fluid navbar-light">
            <nav class="navbar navbar-toggleable-md container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><img id="imagen-logo" src="{{ asset('storage/img/logo.png') }}" alt="Logo Municipal Liberia"><span class="hidden-sm-down">Gestor de Membresias</span></a>
            
            <div class="collapse navbar-collapse" id="menu">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                @if (Auth::guest())
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-power-off .iconos-nav" aria-hidden="true"></i> Entrar</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/usuarios/home"><i class="fa fa-user-o .iconos-nav" aria-hidden="true"></i> Usuarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/socios/index"><i class="fa fa-users .iconos-nav" aria-hidden="true"></i> Socios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/facturas/index"> <i class="fa fa-file-text-o .iconos-nav" aria-hidden="true"></i> Facturacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/conf/index"><i class="fa fa-cogs .iconos-nav" aria-hidden="true"></i> Configuracion</a>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuario(a) {{ Auth::user()->nombre_usuario}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-app" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item dropdown-item-app" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                     Cerrar Secion
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                      </form>
                    </div>
                  </li>
                @endif
              </ul>
            </div>
          </nav>
        </div>
     <!-- End Encabesado --> 

     <!-- Contenido Dinamico --> 
     <div class="container h-100 py-5">
         @yield('content')
     </div>
     <!-- End contenido --> 
        <!-- footer -->
    <footer class="text-white">
      <div class="container-fluid footer-info d-flex align-items-center d-flex justify-content-center py-5">
        <div class="container">
          <div class="row text-center">
            <!-- seccion 1 -->
            <div class="col-sm-12 col-md-6 col-xl-3 pt-sm-3 pt-md-3">
              <h5 class="py-2">Navegacion</h5>
              <ul>
                <li><a id="as" href="/socios/index">Socios</a></li>
                <li><a id="as" href="/usuarios/home">Usuarios</a></li>
                <li><a id="as" href="/facturas/index">Facturacion</a></li>
                <li><a id="as" href="/conf/index">Configuracion</a></li>
              </ul>
            </div> <!--End seccion 1 -->

            <!-- seccion 2 -->
            <div class="col-sm-12 col-md-6 col-xl-3 pt-sm-3 pt-md-3">
                <h5 class="py-2">Facturacion</h5>
                <ul>
                  <li><a id="as" href="#">Pago de Facturas</a></li>
                  <li><a id="as" href="#">Facturas</a></li>
                  <li><a id="as" href="#">Morocidad</a></li>
                </ul>
              </div> <!--End seccion 2 -->

              <!-- seccion 3 -->
            <div class="col-sm-12 col-md-6 col-xl-3 pt-sm-3 pt-md-3">
                <h5 class="py-2">Liquidación Cobros</h5>
                <ul>
                  <li><a id="as" href="#">Liquidaciones</a></li>
                  <li><a id="as" href="#">Reporte de Cobro</a></li>
                  <li><a id="as" href="#">Morocidad</a></li>
                </ul>
              </div> <!--End seccion 3 -->

              <!-- seccion 4 -->
            <div class="col-sm-12 col-md-6 col-xl-3 pt-sm-3 pt-md-3">
                <h5 class="py-2">Informacion</h5>
                
                <p class="title-card">Municipal Liberia.</p>
                <p><b>Sitio Oficial: </b><a id="as" class="links" href="http://municipalliberia.com/">www.municipalliberia.com</a></p>
                <p>Costado este estadio Edgardo Baltodano Briceño, Tercer Piso.</p>
                <p><b>Telefono: </b>+(506) 4700-5179</p>
              </div> <!--End seccion 4 -->

          </div>

          <div class="row d-flex align-items-center d-flex justify-content-center py-2">
                <a id="as" class="footer-icon" href="https://www.facebook.com/ADMLiberia"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a id="as" class="footer-icon" href="https://twitter.com/admliberia"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a id="as" class="footer-icon" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a id="as" class="footer-icon" href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>

      <div class="container-fluid footer-copi pt-2">
        <div class="row d-flex align-items-center">
          <div class="col-sm-12 text-sm-center col-md-6 text-md-left">
            <p class="text-footer"> Municipal Liberia © Copyright - UCR </p>
          </div>
          <div class="col-sm-12 text-sm-center col-md-6 text-md-right">
            <p class="text-footer">Proyecto Universitario: / <a id="as" href="https://www.facebook.com/josue.barrantes.18" class="links">Josué Barrantes</a> / <a id="as" href="https://www.facebook.com/carlos.r.ramirez.35" class="links">Carlos Ramirez</a> / <a id="as" href="https://www.facebook.com/jafet.chevez.7" class="links">Jafet Chevez</a></p>
          </div>
        </div> 
      </div>
    </footer>
    <!-- End footer -->    
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script src="http://code.gijgo.com/1.5.1/js/gijgo.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/main.js"></script>
        
    </body>
</html>