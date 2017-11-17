@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    <form method="GET" action="/cobros/usuario/filtrar">
      <select class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Periodo</option>
    <option value="2">Fecha cobro</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($estado_id))
        <input name="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif

        <input name="user_id" type="hidden" value="{{$user->id}}">
        <button type="submit" class="btn btn-success ml-2" >Buscar</button>
  </label>
    </form>
    
    
</div>
</div>
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    <b> Cobros  @if(isset($estado_id))
        @if($estado_id == 3) pendientes de liquidar @endif
        @if($estado_id == 4) liquidados @endif
    @endif del usuario: {{$user->primer_nombre}} {{$user->segundo_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}</b> 
  </div>
    <ul class="nav nav-pills card-header-pills float-right mr-4">
    <li class="nav-item">
      <div class="col-md-2 mr-5">
        <a href="{{URL::previous()}}" class="btn btn-warning btn-md">
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