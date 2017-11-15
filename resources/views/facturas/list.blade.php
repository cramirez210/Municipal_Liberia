@extends('layouts.app')

@section('content')

@include('mensajes.alertas')
    
  <div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    @include('facturas.filtrar')
</div>
</div>
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    @if(isset($estado_id))
        @if($estado_id == 3) <b>Facturas pendientes</b> @endif
        @if($estado_id == 4) <b>Facturas pagas</b> @endif
    @else <b>Todas las facturas</b>
    @endif
  </div>
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/facturas/list">Listado de Facturas</a>
      </li>
  
         <li class="nav-item dropdown ">
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
      <center class="col-md-2 mr-5">
        <a href="/facturas/index" class="btn btn-primary btn-md">
           Regresar
        </a>
   </center>
    </li>
    </ul>
    
  </div> 

<div id="tabla_facturas" class="col-md-auto offset-md-1 mt-4">

<div  class="row">

<div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-12">
<div class="row">

 <div class="table-responsive ml-4">

  @include('facturas.table')

    </div>

 </div>
</div>
</div>
  <div class="mt-2 mx-auto float-right">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>
</div>
    </div>

 </div>

</div>

@endsection

@section('titulo')

Facturas

@endsection