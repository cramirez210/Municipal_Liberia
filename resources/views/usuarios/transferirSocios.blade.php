@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@if(count($socios))
  <div class="card text-center mt-2">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de socio</option>
    <option value="1">Cédula</option>
    <option value="2">Nombre</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: 1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>
</div>
</div>
@endif

<!--_______________________________ Tabla _____________________________-->
<form name="form_liquidar_cobro" method="GET" action="/usuarios/seleccionarNuevoEjecutivo" >
  {{ csrf_field() }}
<div class="card text-center ">




  <div class="card-header">

    <div class="row ">
      <div class="col-md-7 text-md-right text-xs-center">
             <label class="text-primary"> Socios Activos del Usuario " {{ $usuario->nombre_usuario }} "</label>      
      </div>

       <div class="col-md-5 float-right">
           <div class="nav-item float-md-right float-xs-center">
       <button type="submit" class="btn btn-success btn-xs fa fa-check system-icons" style="color: white;">Siguiente</button>
         <a href="/usuarios/home" class="btn btn-danger fa fa-times system-icons">
        <span class="glyphicon glyphicon-remove-circle "></span> Cancelar </a>
    </div> 
        @if(count($socios))
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
      </div>
         
  </div>
  <div class="card-body tab-content mt-md-4">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container col-md-8">
<div class="row">

 <div class="table-responsive  table-condensed scroll">
        
    <table id="table" WIDTH="100%" class="table table-responsive" >
        <thead>
            <tr>
            <th class="text-center">N° de socio</th> 
            <th class="text-center">Cédula</th> 
            <th class="text-center">Nombre</th>
            <th class="text-center">Seleccion</th>
            </tr>
        </thead>
    <tbody>

        @if($socios !== null)
         @forelse($socios as $socio)
                       
        <tr>
            <td class="info" > {{ $socio->id }} </td>
            <td class="info" > {{ $socio->persona->cedula }} </td>
            <td class="info" > {{ $socio->persona->primer_nombre }} {{ $socio->persona->primer_apellido }} {{ $socio->persona->segundo_apellido }} </td>
   
            <td class="info"> 
              <input type="checkbox" value="{{$socio->id}}" name="{{$socio->id}}">
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No existen socios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($socios))

       {{ $socios->links('pagination::bootstrap-4') }}

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

Transferir Socios

@endsection