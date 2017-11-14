@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@include('mensajes.errors') 

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    <b class="center">Filtro de Busqueda</b> 
  </div>

    
  <div class="card-body">

    <center>

  <form class="form col-md-6" method="POST" action="/facturas/recuento"> 
    {{ csrf_field() }}

    @include('layouts.filtrar_fechas')

        <button class="btn btn-success " type="submit">Buscar</button>
        <a href="/facturas/index" class="btn btn-danger ">Cancelar</a>
      
  </form>  

  </center>


</div>

</div>


@endsection

@section('titulo')
    Facturación
@endsection