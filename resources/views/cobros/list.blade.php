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

  <form class="form-inline" method="GET" action="/socios/find" style="margin-left: 29%;"> 

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="Criterio">
    <option selected value="1">Cedula</option>
    <option value="2">Numero de Socio</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" required autofocus>

        <span class="input-group-btn">
        <button class="btn btn-info" type="submit">Buscar !</button>
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
<div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/facturas/list">Listado de Cobros</a>
      </li>
  
         <li class="nav-item dropdown " style="margin-left: 60%;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/cobros/list">Todas los cobros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/3">Cobros pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/list/4">Cobros cancelados</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link text-primary" href="{{ URL::previous() }}">Regresar</a>
      </li>
    </ul>
    
  </div> 
<div class="col-md-9 offset-md-1 mt-4">

<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° de factura</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($cobros as $cobro)
                       
        <tr>
            <td class="info"> {{ $cobro->factura_id }} </td>
            <td class="info"> {{ $cobro->primer_nombre }} </td>
            <td class="info"> {{ $cobro->primer_apellido }} {{ $cobro->segundo_apellido }} </td>
            <td class="info"> {{ $cobro->monto }} </td>
            <td class="info"> {{ $cobro->created_at }} </td>
            <td class="info"> {{ $cobro->estado }} </td>
            <td class="warning"> 
              @if($cobro->estado_id == 3)
              <a href="#" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Pagar</a>
              @else
              <a href="#" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Detalle</a>
              @endif
            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay facturas registradas </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    </div>
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

Cobros

@endsection