@extends('layouts.app')

@section('content')
    
@include('mensajes.alertas')

@if(count($cobros))
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
<div class="card-header text-primary">
  <b>Cobros del {{date('m-Y', strtotime($desde))}} al {{date('m-Y', strtotime($hasta))}}</b>
      <div class="col-md-2 float-right mr-5">
        <a href="/cobros/mostrar/recuento/{{$desde}}/{{$hasta}}" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
           Regresar
        </a>
   </div>
  </div> 
<div class="col-md-10 offset-md-1 mt-4 mr-4">

<div class="row">

  @include('cobros.table')
    </div>

 </div>

<div class="mt-2 mx-auto">
        @if(count($cobros))

       {{ $cobros->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    <div class="card-footer text-muted">
        Se encontraron {{ count($cobros) }} resultados.

    </div>
</div>

@endsection

@section('titulo')

Cobros

@endsection