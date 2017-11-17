@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<button class="btn btn-success btn-md mt-3" data-toggle="modal" data-target="#filtrar_socios">Realizar una búsqueda</button>
@include('socios.filtrar')

<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
    <div class="card-tittle text-primary ml-5">
    @if(isset($id)) <h5 class="ml-5">
        @if($id == 1) <b>Lista de socios activos</b> @endif
        @if($id == 2) <b>Lista de socios inactivos</b> @endif
        @if($id == 0) <b>Todos los socios</b> @endif
    </h5>
    @else <h5 class="ml-4"> <b>Socios</b> </h5>
  
    @endif
  </div>
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
         <label class="nav-link text-primary">Lista de Socios</label>
      </li>
      <li class="nav-item">
         <a class="nav-link text-primary" href="/socios/asignarEjecutivo">Nuevo Socios</a>
      </li>

      <li class="nav-item dropdown mt-2">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/socios/listarTodos">Todos los Socios</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/socios/listarPorEstado/1">Socios Activos</a>
        <a class="dropdown-item" href="/socios/listarPorEstado/2">Socios Inactivos</a> 
        <div class="dropdown-divider"></div> 
      </div>
      </li>
    </ul>
    
  </div> 
<div id="tabla_socios" class="col-md-8 offset-md-2 mt-4">

<div class="row">

  @include('socios.table')
    </div>

 </div>

<div class="mt-2 mx-auto">
        @if(count($socios))

       {{ $socios->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    <div class="card-footer text-muted">
        Se encontraron {{ $registros }} resultados. 

    </div>
</div>

@endsection

@section('titulo')

Socios

@endsection
