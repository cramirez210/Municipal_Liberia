@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@include('mensajes.errors')
	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="jumbotron mt-4">

<h1 class="h1 d-inline ml-4"> En Mantenimiento </h1>

	<div class="list-group mt-4">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar_socio">Pago de facturas</a>
  @include('facturas.buscar_socio')
  <ul class="list-group-item">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/list">Todas las facturas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/3">Facturas pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/4">Facturas canceladas</a>
        </div>
    </li>
  </ul>
  <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar">Buscar facturas de un socio específico</a>
  @include('facturas.buscar')
  <a href="/facturas/recuento" class="list-group-item">Reporte de facturación</a>
  <ul class="list-group-item">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Morosidad</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/morosos">Todos los socios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moroso">Un socio</a>
        </div>
    </li>
  </ul>
  @include('facturas.buscar_moroso')
</div>

</div>

@endsection

@section('titulo')
    Facturación
@endsection