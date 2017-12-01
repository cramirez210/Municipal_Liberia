@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<button class="btn btn-success btn-md mt-3 Realizar una búsqueda fa fa-search system-icons" data-toggle="modal" data-target="#filtrar_factura"> Realizar una búsqueda</button>
@include('facturas.filtrar')
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary h3">
    @if(isset($estado_id))
        @if($estado_id == 3) <b>Facturas pendientes</b> @endif
        @if($estado_id == 4) <b>Facturas pagadas</b> @endif
        @if($estado_id == 0) <b>Todas las facturas</b> @endif
    @else <b>Todas las facturas</b>
    @endif
  </div>

    <ul class="row" id="outerTab" role="tablist">
      <li class="col-md-4">
        <a class="nav-link text-primary" href="/facturas/list">Listado de Facturas</a>
      </li>
  
         <li class="col-md-4 dropdown ">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/list">Todas las facturas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/3">Facturas pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/list/4">Facturas pagadas</a>
        </div>
    </li>
    <li class="col-md-4 ">
      <center class="col-12">
        <a href="/facturas/index" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
           Regresar
        </a>
   </center>
    </li>
    </ul>
    
  </div> 

<div id="tabla_facturas" class="col-md-auto offset-md-1 mt-4">

<div  class="row">



  @include('facturas.table')


  <div class="mt-2 mx-auto float-right">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    </div>

 </div>

</div>

@endsection

@section('titulo')

Facturas

@endsection