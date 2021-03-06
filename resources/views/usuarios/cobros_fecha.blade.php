@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

<button class="btn btn-success btn-md mt-3 fa fa-search system-icons" data-toggle="modal" data-target="#filtrar_cobros__user_fecha"> Realizar una búsqueda</button>
@include('usuarios.filtrar_cobros_fecha')

<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    <b> Cobros @if(isset($estado_id))
        @if($estado_id == 3) pendientes de liquidar @endif
        @if($estado_id == 4) liquidados @endif
    @endif del usuario: <br> {{$user->primer_nombre}} {{$user->segundo_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}} del {{date('d-m-Y', strtotime($desde))}} al {{date('d-m-Y', strtotime($hasta))}}</b> 
  </div>
    <ul class="nav nav-pills card-header-pills float-right mr-4">
    <li class="nav-item">
      <div class="col-md-2 mr-5">
        <a href="/cobros/user/fechas/{{$user->user_id}}/{{$desde}}/{{$hasta}}" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 
<div class="col-md-10 offset-md-1 mt-4">

<div id="tabla_cobros_user" class="row">

  @include('usuarios.cobros_table')
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

Cobros - Usuario

@endsection