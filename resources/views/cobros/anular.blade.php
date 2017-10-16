@extends('layouts.app')

@section('content')

 @if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

    @endif 

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
<form class="container-fluid mt-4 w-100" method="POST" action="/cobros/confirmar" enctype="multipart/form-data">
                        
    {{ csrf_field() }}

<div class="card text-center mt-4">
<div class="card-header">
    <div class="card-tittle text-primary"><b>Anular cobros</b></div>
    @if(count($cobros))
    <input type="hidden" name="user_id" value="{{$cobros[0]->user_id}}">
    <div class="float-right mr-5">
      <button type="submit" class="btn btn-warning btn-xs" style="color: white;">
                      Continuar
      </button>
    </div>
   @endif                 
  </div> 
<div class="col-md-10 offset-md-1 mt-4">

<div class="row">


 <div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° de factura</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Fecha de factura</th>
            <th class="text-center">Fecha de cobro</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Seleccionar</th>
            </tr>
        </thead>
    <tbody>

         @forelse($cobros as $cobro)
                       
        <tr>
            <td class="info"> <a href="/facturas/show/id/{{$cobro->factura_id}}">{{ $cobro->factura_id }}</a></td>
            <td class="info"> {{ $cobro->primer_nombre }} {{ $cobro->primer_apellido }} {{ $cobro->segundo_apellido }} </td>
            <td class="info"> {{ date('d-m-Y', strtotime($cobro->fecha_factura)) }} </td>
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