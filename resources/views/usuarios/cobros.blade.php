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
<div class="card-header">
  <div class="card-tittle text-primary">
    <b> Cobros del usuario: {{$user->nombre_usuario}}</b>
  </div>
    <ul class="nav nav-pills card-header-pills float-right mr-4">
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/cobros/user/{{$user->user_id}}">Todas los cobros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/{{$user->user_id}}/3">Cobros pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/{{$user->user_id}}/4">Cobros cancelados</a>
        </div>
    </li>
    <li class="nav-item">
      <div class="col-md-2 mr-5">
        <a href="/cobros/buscar" class="btn btn-warning btn-md">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 
<div class="col-md-10 offset-md-1 mt-4">

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

Cobros - Usuario

@endsection