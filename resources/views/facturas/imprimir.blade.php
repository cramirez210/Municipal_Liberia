@extends('layouts.app')

@section('content')

@if(count($errors))
<div>
<br>
<span class="text-danger mt-4">
        @if($errors->has('valor'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('valor') }}</strong>
          </span>
        @endif
        <br>
        @if($errors->has('Criterio'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('Criterio') }}</strong>
          </span>
        @endif
    </span>
</div>
@endif

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

     <form class="form-inline" method="POST" action="/facturas/buscar" style="margin-left: 29%;"> 
    {{ csrf_field() }}

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="Criterio">
    <option selected value="1">Numero de Socio</option>
    <option value="2">Cédula</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" required autofocus>

        <span class="input-group-btn">
        <button class="btn btn-info" type="submit">Buscar</button>
        </span>

  </label>
  </form>  

</div>
</div>

    @if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

    @endif  
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
  <form class="form mr-5" method="POST" action="/facturas/imprimir" style="width: 100%;"> 
    {{ csrf_field() }}
<div class="card-header">
  <div class="card-tittle text-primary">
    <b>Imprimir facturas</b>
  </div>
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">
    <li class="nav-item">
      <span class="col-md-3 ml-5 mt-5">
        <button class="btn btn-link float-right mr-5" type="submit">Imprimir</button>
        </span>
    </li>
    </ul>
    
  </div> 
<div class="col-md-auto offset-md-1 mt-4">

<div class="row">
  <div class="table-responsive mr-5">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">Socio</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info"> {{ $factura->id }} </td>
            <td class="info"> {{ $factura->primer_nombre }} </td>
            <td class="info"> {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </td>
            <td class="info"> {{ $factura->created_at }} </td>
            <td class="warning"> 
              <div class="form-group">
                <input class="form-check-input" type="checkbox" name="{{$factura->id}}" value="{{$factura->id}}">
              </div>
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