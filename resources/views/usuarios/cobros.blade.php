@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">
    
    <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Periodo</option>
    <option value="2">Fecha cobro</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($estado_id))
        <input id="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input id="estado" type="hidden" value="0">
        @endif

        <input id="tipo_lista" type="hidden" value="cobros_user">
        <input id="user_id" type="hidden" value="{{$user->id}}">
        <button id="filtrar" type="button" class="btn btn-success ml-2" >Buscar</button>
  </label>
</div>
</div>
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary">
    <b> Cobros del usuario: {{$user->primer_nombre}} {{$user->segundo_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}</b>
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