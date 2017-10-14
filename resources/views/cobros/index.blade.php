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
 <center><img width="110" height="120" src="http://www.monstruolocura.com/saprissa/wp-content/uploads/2015/06/Municipal-Liberia-Logo1.png" >
<h1 class="h1 d-inline ml-4"> En Mantenimiento </h1>

<div class="list-group mt-4">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <ul class="list-group-item">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/cobros/list">Todos los cobros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/3">Cobros pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/4">Cobros cancelados</a>
        </div>
    </li>
  </ul>
  <a class="list-group-item" href="/cobros/buscar/anular">Anular cobros de un usuario</a>
  <a href="/cobros/buscar" class="list-group-item">Buscar cobros de un ejecutivo específico</a>
  <a href="/cobros/recuento" class="list-group-item">Reporte de cobros</a>
</div>

</div>
@endsection

@section('titulo')
    Cobros
@endsection