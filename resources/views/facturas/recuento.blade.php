@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@include('mensajes.errors') 

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    <b class="ml-5">Filtro de Busqueda</b> 
  </div>

  <div class="card-block">

  <form class="form col-md-6" method="POST" action="/facturas/recuento" style="margin-left: 29%;"> 
    {{ csrf_field() }}

    @include('layouts.filtrar_fechas')

        <span class="col-md-3 ml-5 mt-5">

        <button class="btn btn-info d-inline-block ml-4 mt-3" type="submit">Buscar</button>
        <a href="/facturas/index" class="btn btn-warning d-inline-block mt-3 mr-5">Cancelar</a>
        
        </span>
  </form>  
</div>
</div>


@endsection

@section('titulo')
    Facturación
@endsection