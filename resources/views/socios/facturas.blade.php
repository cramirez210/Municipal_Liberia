@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

 <div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    <form method="GET" action="/socio/facturas/filtrar">
      <select class="custom-select mb-2 mb-sm-0" name="Criterio">
        <option selected value="0">N° de factura</option>
        <option value="4">Periodo</option>
      </select>

      <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
            <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
            @if(isset($estado_id))
            <input name="estado" type="hidden" value="{{$estado_id}}">
            @else
            <input name="estado" type="hidden" value="0">
            @endif

            <input name="socio_id" type="hidden" value="{{$socio->socio_id}}">
            <button type="submit" class="btn btn-success ml-2" >Buscar</button>
      </label>
    </form>


</div>
</div>
 
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary"><b>Socio: {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}} N° {{$socio->socio_id}}</b></div>
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
      <div class="col-md-2 mt-2">
        <a href="/facturas/index" class="btn btn-primary btn-md">
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