 
@extends('layouts.app')

@section('content')

<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#"> <h5> Listado de Estados </h5></label>
      </li>
      <li class="nav-item">
        <a class="nav-link text-primary" href="/conf/index"> <h5> Regresar a Configuracion </h5></a>
      </li>
    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary">Incluir Estado</h4>
     <div class="col-md-8 offset-md-2 mt-4">
 <br>
   
@include('estados.formulario')
<br>
    </div>
    </div>

    </div>

   @include('mensajes.alertas') 
<!--_______________________________ Tabla _____________________________-->
<div class="card text-center mt-4"> 
<div class="col-md-8 offset-md-2 mt-4">

<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Estado</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

         @forelse($estados as $estado)
                       
        <tr>
            <td class="info"> {{$estado->estado}} </td>
            <td class="warning"> 
                 <a href="/estados/{{$estado->id}}" class="btn btn-success btn-xs fa fa-pencil system-icons">
                     <span class="glyphicon glyphicon-remove-circle"></span> Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay Datos Registradas </span>

        </div>
        <br>
        @endforelse

       

    </tbody>
    </table>

     <div class="mt-2 mx-auto">
        @if(count($estados))

       {{ $estados->links('pagination::bootstrap-4') }}

        @endif 
    </div>   

        </div>
    </div>

 </div>
  <div class="card-footer text-muted">
        
  </div>
</div>

@endsection

@section('titulo')

Estados 

@endsection

