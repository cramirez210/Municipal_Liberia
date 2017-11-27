@extends('layouts.app')

@section('content')

@include('mensajes.alertas')
    
@if(count($morosos))
  <div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    @include('cobros.filtrar')
</div>
</div>
@endif
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    <b>Lista de cobradores morosos</b>
  </div>
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">
    <li class="nav-item">
      <div class="col-md-2 float-right mr-5 mb-2">
        <a href="/cobros/index" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 
  
  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-9">
<div class="row">

 <div class="table-responsive ml-4">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Cobros a liquidar</th>
            <th class="text-center">Email</th>
            <th class="text-center">Teléfono</th>
            </tr>
        </thead>
    <tbody>

         @forelse($morosos as $moroso)
                       
        <tr>
            <td class="info"> {{ $moroso->primer_nombre }} {{ $moroso->primer_apellido }} {{ $moroso->segundo_apellido }} </td>
            <td class="info"> <a href="/cobros/pendientes/{{$moroso->id}}">{{ $cobro->ObtenerPorUsuarioEstado($moroso->id, 3)->count() }}</a>  </td>
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

 </div>
</div>

@endsection

@section('titulo')

Facturas

@endsection