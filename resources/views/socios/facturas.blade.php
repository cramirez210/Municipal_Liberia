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

     <form class="form-inline" method="POST" action="/facturas/buscar" style="margin-left: 29%;"> 
    {{ csrf_field() }}

  <select id="select" class="custom-select mb-2 mr-sm-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="5">Fecha</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input id="valor" type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
  </form>  

</div>
</div>
@endif
 
<!--_______________________________ Tabla _____________________________-->

<div class="card text-center mt-4">
<div class="card-header">
  <div class="card-tittle text-primary"><b>Facturas del socio: N° {{$socio->socio_id}}</b></div>
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/facturas/socio/{{$socio->socio_id}}">Listado de Facturas</a>
      </li>
  
         <li class="nav-item dropdown " style="margin-left: 60%;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/facturas/socio/{{$socio->socio_id}}">Todas las facturas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/{{$socio->socio_id}}/3">Facturas pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/facturas/{{$socio->socio_id}}/4">Facturas canceladas</a>
        </div>
    </li>
    <li class="nav-item">
      <a href="/facturas/index" class="nav-link text-primary">Menú</a>
    </li>
    </ul>
    
  </div> 
<div class="col-md-auto offset-md-1 mt-4">

<div class="row">

  @include('facturas.table')
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
</div>

@endsection

@section('titulo')

Facturas - Socio

@endsection