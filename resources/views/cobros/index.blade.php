@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="jumbotron mt-4">
 <center>
<h1 class="h1 d-inline ml-4"> En Mantenimiento </h1>

<div class="list-group mt-4">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <a class="list-group-item" href="#" data-toggle="modal" data-target="#buscar_liquidar">Liquidación de cobros de un ejecutivo</a>
  @include('cobros.buscar_liquidar')
  <ul class="list-group-item">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/cobros/list">Todos los cobros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/3">Cobros pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/4">Cobros liquidados</a>
        </div>
    </li>
  </ul>
  <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar">Buscar cobros de un ejecutivo específico</a>
  @include('cobros.buscar')
  <a href="/cobros/recuento" class="list-group-item">Reporte de cobros</a>
  <ul class="list-group-item">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Morosidad</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/cobros/morosos">Todos los ejecutivos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#buscar_moroso">Un ejecutivo</a>
        </div>
    </li>
  </ul>
  @include('cobros.buscar_moroso')
</div>

</div>
@endsection

@section('titulo')
    Cobros
@endsection