@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<button class="btn btn-success btn-md mt-3 fa fa-search" data-toggle="modal" data-target="#filtrar_facturas_socio"> Realizar una búsqueda</button>
@include('socios.filtrar_facturas')
 
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    <b>@if(isset($estado_id))
              @if($estado_id == 3) <b>Facturas pendientes</b> @endif
              @if($estado_id == 4) <b>Facturas pagadas</b> @endif
              @if($estado_id == 0) <b>Fodas las facturas</b> @endif
              @else <b>Todas las facturas</b>
     @endif 
      del socio: {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}} N° {{$socio->socio_id}}</b></div>
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/facturas/socio/{{$socio->socio_id}}">Listado de Facturas</a>
      </li>
  
         <li class="nav-item dropdown mt-2">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="margin-top: 5px;">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/socio/{{$socio->socio_id}}">Todas las facturas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/{{$socio->socio_id}}/3">Facturas pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/{{$socio->socio_id}}/4">Facturas canceladas</a>
        </div>
    </li>
   <li class="nav-item">
      <div class="col-md-12 mt-2">
        <a href="/facturas/index" class="btn btn-warning btn-md">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 


  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-8">
<div id="tabla_facturas_socio" class="row">

 <div class="table-responsive ml-4">
        

  @include('socios.facturas_table')
    </div>

 </div>
</div>
</div>
</div>


<div class="mt-2 mx-auto">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>
</div>

@endsection

@section('titulo')

Facturas - Socio

@endsection