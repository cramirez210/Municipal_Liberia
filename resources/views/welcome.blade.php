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
<h1 class="h1 d-inline ml-4"> En Mantenimiento </h1></center>


	<div class="list-group mt-4">
  <a href="#" class="list-group-item active">
    Acceder a:
  </a>
  <a href="/usuarios/home" class="list-group-item">Administración de los usuarios</a>
  <a href="/socios/index" class="list-group-item">Administración de los socios</a>
  <a href="/facturas/index" class="list-group-item">Gestión de facturas</a>
  <a href="/cobros/index" class="list-group-item">Liquidación de cobros</a>
  <a href="/conf/index" class="list-group-item">Administración de la configuración</a>
</div>

</div>


@endsection







@section('titulo')
    ASMLG | Municipal Liberia
@endsection

