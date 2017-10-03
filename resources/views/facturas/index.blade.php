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

<h1 class="h1 d-inline ml-4"> En Mantenimiento </h1>

	<div class="list-group mt-4">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <a href="/facturas/generar" class="list-group-item">Generar facturas del mes</a>
  <a href="/facturas/pagar/buscar" class="list-group-item">Pago de facturas pendientes de un socio</a>
  <a href="/facturas/list" class="list-group-item">Ver todas las facturas</a>
  <a href="/facturas/list/3" class="list-group-item">Ver facturas pendientes</a>
  <a href="/facturas/list/4" class="list-group-item">Ver facturas pagadas</a>
  <a href="/facturas/buscar" class="list-group-item">Ver facturas de un socio específico</a>
  <a href="/facturas/recuento" class="list-group-item">Ver recuento mensual de facturación</a>
</div>

</div>

@endsection

@section('titulo')
    Facturación
@endsection