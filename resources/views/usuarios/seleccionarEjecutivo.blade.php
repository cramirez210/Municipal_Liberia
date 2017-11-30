@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<button class="btn btn-success btn-md mt-3 fa fa-search system-icons mb-2" data-toggle="modal" data-target="#filtrar_users"> Realizar una búsqueda</button>
@include('socios.filtrarEjecutivo')

<!--_______________________________ Tabla _____________________________-->
<form method="GET" action="/usuarios/finalizarTransferencia/{{ $idSocio }}" >
  {{ csrf_field() }}
<div class="card text-center ">




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