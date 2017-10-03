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

	<div class="list-group mt-5">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <a href="/cobros/list" class="list-group-item">Todos los cobros</a>
  <a href="/cobros/list/3" class="list-group-item">Cobros pendientes</a>
  <a href="/cobros/list/4" class="list-group-item">Cobros pagados</a>
  <a href="/cobros/buscar" class="list-group-item">Cobros de un ejecutivo específico</a>
  <a href="/cobros/recuento" class="list-group-item">Recuento mensual de cobros</a>
</div>

</div>




@endsection

@section('titulo')
    Facturación
@endsection