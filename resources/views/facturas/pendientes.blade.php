@extends('layouts.app')

@section('content')

@if(count($facturas))
  <div class="card text-center mt-2">
  <div class="card-header text-primary">
    Filtro de búsqueda
  </div>

  <div class="card-block">

  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Nombre</option>
    <option value="2">Periodo</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: 1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
</div>
</div>
@endif


@include('mensajes.alertas')
<!--_______________________________ Tabla _____________________________-->
<form name="form_liquidar_cobro" class="form mr-5" method="POST" action="/facturas/imprimir" style="width: 100%;"> 
    {{ csrf_field() }}

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary"><b>Imprimir facturas</b></div>
   <ul class="row mt-2" id="outerTab" role="tablist">
   @if(count($facturas))
    <li class="col-md-4 mt-2 dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Opciones</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:seleccionar_todo()">Marcar todo</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:deseleccionar_todo()">Desmarcar todo</a>
        </div>
    </li> 
    <li class="col-md-4 mt-2">
      <button type="submit" class="btn btn-success btn-xs fa fa-arrow-right system-icons" style="color: white;">
                      Continuar
      </button>
    </li>
  @endif
  <li class="col-md-4 mt-2">
        <a href="/facturas/index" class="btn btn-warning btn-xs fa fa-exclamation-triangle system-icons"> Regresar</a>  
  </li>
  </ul> 
  </div> 
<div class="col-md-10 offset-md-1 mt-4">
<div class="row">
  <div class="table-responsive mr-5 scroll">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Periodo</th>
            <th class="text-center">Opción</th>
            </tr>
        </thead>
    <tbody>

         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info"> {{ $factura->id }} </td>
            <td class="info"> {{ $factura->primer_nombre }} {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </td>
            <td class="info"> {{date('m-Y', strtotime($factura->periodo)) }} </td>
            <td class="warning">
              <input type="checkbox" value="{{$factura->id}}" name="{{$factura->id}}">
            </td>
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

    <div class="card-footer text-muted">
        Se encontraron {{ count($facturas) }} resultados.

    </div>
  </form>
</div>

@endsection

@section('titulo')

Facturas

@endsection