@extends('layouts.app')

@section('content')


	@if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

  @endif  

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="jumbotron mt-4">
 

<h1 class="h1"> En Mantenimiento </h1>
<h3 class="card-text text-muted"> Josué, Jafet, Carlos </h1>

	<div class="list-group mt-5">
  <a href="#" class="list-group-item active">
    Acciones
  </a>
  <a href="/usuarios/home" class="list-group-item">Usuarios</a>
  <a href="/socios/index" class="list-group-item">Socios</a>
  <a href="/facturas/index" class="list-group-item">Facturación</a>
  <a href="/cobros/index" class="list-group-item">Cobros</a>
  <a href="/conf/index" class="list-group-item">Configuración</a>
</div>

</div>




@endsection







@section('titulo')
    ASMLG | Municipal Liberia
@endsection