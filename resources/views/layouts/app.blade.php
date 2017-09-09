<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('titulo', 'Municipal Liberia') }}</title>

    <!-- Styles -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

</head>
<body>
    <div id="app" class="container">
        <nav id="header" class="navbar navbar-light static-top navbar-toggleable-md bg-faded">
       
            <div class="container">

             <a class="navbar-brand" href="{{ url('/') }}">
                       Municipal Liberia
                    </a>


                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @if (Auth::guest()) <!--Si soy un invitado-->

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/registro_personas') }}">Registrar Persona</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrar Usuario</a>
                            </li>

                        @else


                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrar Usuario</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <p> Bienvenido(a) {{ Auth::user()->nombre_usuario}}</p> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" role="menu">
                                        <a class=" nav-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir

                                        </a>
                                

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                   </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->

    <script
              src="http://code.jquery.com/jquery-3.2.1.min.js"
              integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
              crossorigin="anonymous"></script>

     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>




     <style type="text/css">
     
     body
     {
        
     }

     #header
     {
        box-shadow: 8px 5px 3px  #888888;
     }


    </style>

</body>
</html>


