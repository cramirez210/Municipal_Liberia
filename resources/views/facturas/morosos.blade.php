@extends('layouts.app')

@section('content')

@include('mensajes.alertas')
    
@if(count($morosos))
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
  <div class="card-tittle text-primary">
    <b>Lista de socios morosos</b>
  </div>
    <ul class="nav nav-tabs nav-fill card-header-tabs float-right mr-5 mb-1" id="outerTab" role="tablist">
    <li class="nav-item mr-1">
        <a href="/facturas/reporte/morosos" target="_blank" class="btn btn-success btn-sm fa fa-download system-icons">
          <b>Descargar lista</b> 
        </a>
    </li>
    <li class="nav-item">
        <a href="/facturas/index" class="btn btn-warning btn-sm fa fa-exclamation-triangle system-icons">
           <b>Regresar</b> 
        </a>
    </li>
    </ul>
    
  </div>




  
  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-9">
<div class="row">

 <div class="table-responsive ml-4">

     
 @include('facturas.morosos_table')
    </div>

 </div>
</div>
</div>
</div>

</div>

@endsection

@section('titulo')

Facturas

@endsection