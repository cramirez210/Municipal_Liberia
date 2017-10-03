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
  <a href="/facturas/list" class="list-group-item">Todas las facturas</a>
  <a href="/facturas/list/3" class="list-group-item">Facturas pendientes</a>
  <a href="/facturas/list/4" class="list-group-item">Facturas pagadas</a>
  <a href="/facturas/buscar" class="list-group-item">Facturas de un socio específico</a>
  <a href="/facturas/recuento" class="list-group-item">Recuento mensual de facturación</a>
</div>

</div>

@endsection

@section('titulo')
    Facturación
@endsection