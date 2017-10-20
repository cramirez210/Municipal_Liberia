@extends('layouts.app')

@section('content')

@include('mensajes.alertas')
    
@if(count($facturas))
  <div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    @include('facturas.filtrar')
</div>
</div>
@endif
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/facturas/list">Listado de Facturas</a>
      </li>
  
         <li class="nav-item dropdown " style="margin-left: 60%;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/list">Todas las facturas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/3">Facturas pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/4">Facturas canceladas</a>
        </div>
    </li>
    <li class="nav-item">
      <div class="col-md-2 mr-5">
        <a href="/facturas/index" class="btn btn-warning btn-md">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 
<div class="col-md-auto offset-md-1 mt-4">

<div class="row">

  @include('facturas.table')
    </div>

 </div>

<div class="mt-2 mx-auto">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    <div class="card-footer text-muted">
        Se encontraron {{ count($facturas) }} resultados.

    </div>
</div>

@endsection

@section('titulo')

Facturas

@endsection