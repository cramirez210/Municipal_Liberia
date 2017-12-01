@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@if(count($usuarios))
  <div class="card text-center mt-2">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">Nombre de usuario</option>
    <option value="1">Nombre completo</option>
    <option value="2">Cédula</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: 1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
</div>
</div>
@endif

<!--_______________________________ Tabla _____________________________-->
<form method="GET" action="/usuarios/finalizarTransferencia" >
  {{ csrf_field() }}
<div class="card text-center ">

  @foreach ($socios as $socio)
    <input type="hidden" name="{{$socio}}" value="{{$socio}}">
@endforeach


  <div class="card-header">

    <div class="row ">
      <div class="col-md-7 text-md-right text-xs-center">
             <label class="text-primary"> Ejecutivos Registrados </label>      
      </div>

       <div class="col-md-5">
           <div class="nav-item float-md-right float-xs-center">
       <button type="submit" class="btn btn-success btn-xs fa fa-check system-icons" style="color: white;">Siguiente</button>
         <a href="/usuarios/home" class="btn btn-danger fa fa-times system-icons">
        <span class="glyphicon glyphicon-remove-circle "></span> Cancelar </a>
    </div>  
      </div>
  
    
    
      </div>
         
  </div>
  <div class="card-body tab-content mt-md-4">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container col-md-8">
<div class="row">

 <div class="table-responsive  table-condensed">
        
    <table id="table" WIDTH="100%" class="table table-responsive" >
        <thead>
            <tr>
            <th class="text-center">Nombre de usuario</th>
            <th class="text-center w-50">Nombre Completo</th>
            <th class="text-center">Cédula</th>
            <th class="text-center">Seleccion</th>
            </tr>
        </thead>
    <tbody>

        @if($usuarios !== null)
         @forelse($usuarios as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
            <td class="info" > {{$usuario->primer_nombre}} {{$usuario->segundo_nombre}} {{$usuario->primer_apellido}} {{$usuario->segundo_apellido}} </td>
            <td class="info" > {{$usuario->cedula}} </td>
   
            <td class="info"> 
              <input type="radio" name="idNuevoEjecutivo" value="{{$usuario->id}}">
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No existen usuarios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($usuarios))

       {{ $usuarios->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

    @endif

        </div>
    </div>

 </div>
    
    </div>
  
  </div>
</div>


</form>

@endsection

@section('titulo')

Transferir Socio

@endsection