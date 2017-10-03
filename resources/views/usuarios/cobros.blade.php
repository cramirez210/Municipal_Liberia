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
   <h4>Usuario: {{$user->nombre_usuario}}</h4> 
  </div>

  <div class="card-block">
  <h5><label>Nombre: </label> </h5>{{$user->primer_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}
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
            <a class="dropdown-item" href="/cobros/user/{{$user->user_id}}">Todas los cobros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/{{$user->user_id}}/3">Cobros pendientes</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/cobros/{{$user->user_id}}/4">Cobros cancelados</a>
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

Cobros - Usuario

@endsection