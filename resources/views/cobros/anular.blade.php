@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@if(count($cobros))
   <div class="card text-center mt-4">
  <div class="card-header text-primary">
    <b>Filtro de Busqueda</b> 
  </div>

  <div class="card-block">

     <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Usuario</option>
    <option value="2">Periodo</option>
    <option value="3">Fecha de cobro</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: 1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
</div>
</div>
@endif
 
<!--_______________________________ Tabla _____________________________-->
<form name="form_liquidar_cobro" class="container-fluid mt-4 w-100" method="POST" action="/cobros/anularFactura" enctype="multipart/form-data">
                        
    {{ csrf_field() }}

<div class="card text-center mt-4">
<div class="card-header">
    <div class="card-tittle text-primary"><b>Anular cobros</b></div>
    <a href="/facturas/index" class="btn btn-warning btn-xs float-right mr-5 fa fa-exclamation-triangle system-icons"> Regresar</a>
    @if(count($cobros))
    <input type="hidden" name="user_id" value="{{$cobros[0]->user_id}}">
    <div class="float-right mr-2">
      <button type="submit" class="btn btn-success btn-xs fa fa-arrow-right system-icons" style="color: white;">
                      Continuar
      </button>
    </div>
   @endif   
   @if(count($cobros))
   <ul class="float-right mr-3 mt-1">
    <li class="list-unstyled dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Opciones</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:seleccionar_todo()">Marcar todo</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:deseleccionar_todo()">Desmarcar todo</a>
        </div>
    </li>
  </ul>  
  @endif             
  </div> 
<div class="col-md-10 offset-md-1 mt-4">

<div class="row">


 <div class="table-responsive scroll">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° de factura</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Periodo</th>
            <th class="text-center">Fecha de cobro</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Seleccionar</th>
            </tr>
        </thead>
    <tbody>

         @forelse($cobros as $cobro)
                       
        <tr>
            <td class="info"> 
              <a class="detail-factura" href="#" data-toggle="modal" data-target="#modal">
                {{ $cobro->factura_id }}</a></td>
            <td class="info"> {{ $cobro->primer_nombre }} {{ $cobro->primer_apellido }} {{ $cobro->segundo_apellido }} </td>
            <td class="info"> {{ date('m-Y', strtotime($cobro->fecha_factura)) }} </td>
            <td class="info"> {{ date('d-m-Y', strtotime($cobro->created_at)) }} </td>
            <td class="info"> {{ $cobro->monto }} </td>
            <td class="warning"> 
              <input type="checkbox" value="{{$cobro->factura_id}}" name="{{$cobro->factura_id}}">
            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay cobros registrados </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    @include('modal') 

    </div>
    </div>

 </div>

    <div class="card-footer text-muted">
        Se encontraron {{ count($cobros) }} resultados.

    </div>
</div>
</form>
@endsection

@section('titulo')

Cobros

@endsection