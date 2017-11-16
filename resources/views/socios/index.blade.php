@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">


  <div class="card-body">
  
  <form method="GET" action="/socios/filtrar">
  <select class="custom-select mb-1" name="Criterio">
    <option selected value="0">Numero de Socio</option>
    <option value="1">Categoria</option>
    <option value="2">Cedula</option>
    <option value="3">Nombre</option>
    <option value="4">Ejecutivo</option>
    
  </select>

  <label>
        <input type="text" class="form-control" placeholder="Ejemplo: 243" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($id))
        <input name="estado" type="hidden" value="{{$id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif

  </label>
     <button type="submit" class="btn btn-success ml-2" >Buscar</button>
  </form>
  </div>  


</div>

</div>

<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
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
