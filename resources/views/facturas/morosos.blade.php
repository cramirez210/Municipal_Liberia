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

     
 <div class="table-responsive mr-5">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Facturas pendientes</th>
            <th class="text-center">Email</th>
            <th class="text-center">Teléfono</th>
            </tr>
        </thead>
    <tbody>

         @forelse($morosos as $moroso)
                       
        <tr>
            <td class="info"> {{ $moroso->primer_nombre }} {{ $moroso->primer_apellido }} {{ $moroso->segundo_apellido }} </td>
            <td class="info"> <a href="/facturas/pendientes/{{$moroso->id}}/3">{{ $factura->ObtenerPorSocioEstado($moroso->id, 3)->count() }}</a>  </td>
            <td class="info"> {{ $moroso->email }} </td>
            <td class="info"> {{ $moroso->telefono }} </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    </div>
    </div>

 </div>
</div>

@endsection

@section('titulo')

Facturas

@endsection