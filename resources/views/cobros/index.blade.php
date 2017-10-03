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
  <a href="/cobros/list" class="list-group-item">Todos los cobros</a>
  <a href="/cobros/list/3" class="list-group-item">Cobros pendientes</a>
  <a href="/cobros/list/4" class="list-group-item">Cobros pagados</a>
  <a href="#" class="list-group-item">Cobros de un ejecutivo específico</a>
  <a href="#" class="list-group-item">Registrar cobros realizados por un ejecutivo específico</a>
  <a href="#" class="list-group-item">Recuento mensual de cobros</a>
</div>

</div>




@endsection

@section('titulo')
    Facturación
@endsection