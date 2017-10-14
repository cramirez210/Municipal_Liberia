@extends('layouts.app')

@section('content')

@if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>
@endif  

@if(count($facturas))
  <div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Nombre</option>
    <option value="2">Fecha</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: 1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
</div>
</div>
@endif

<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
  <form class="form mr-5" method="POST" action="/facturas/imprimir" style="width: 100%;"> 
    {{ csrf_field() }}
<div class="card-header">
  <div class="card-tittle text-primary">
    <b>Imprimir facturas</b>
  </div>
    
  </div> 
<div class="col-md-auto offset-md-1 mt-4">
<div class="row">
  <div class="table-responsive mr-5">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info"> {{ $factura->id }} </td>
            <td class="info"> {{ $factura->primer_nombre }} {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </td>
            <td class="info"> {{ $factura->created_at }} </td>
            <td class="warning"> 
              <div style="display: none;">
                   @include('facturas.factura')
              </div>
              <a href="/imprimir/{{$factura->id}}" class="btn btn-success btn-sm" onclick="javascript:imprSelec('factura')">Imprimir</a>
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

<div class="mt-2 mx-auto">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
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