 
@extends('layouts.app')

@section('content')


 
        
<!--_______________________________ Tabla _____________________________-->
<div class="card text-center mt-4"> 
<div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Listado de Usuarios</label>
      </li>
    </ul>
  </div>
<div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th>Cédula</th>
            <th>Primer nombre</th>
            <th>Primer apellido</th>
            <th>Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($personas as $persona)
                       
        <tr>
            <td class="info" > {{$persona->cedula}} </td>
            <td class="info"> {{$persona->primer_nombre}} </td>
            <td class="info"> {{$persona->primer_apellido}} </td>


            <td class="info"> 
                 <a href="/personas/mostrar/{{ $persona->id }}" class="btn btn-info btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Ver usuario</a>
            </td>
        </tr>

        

        @empty
        <div class="card-text text-warning">No existen usuarios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

        <div class="card-text text-success">Existen {{count($personas)}} usuarios registrados.</div>
        <br>
    </table>

     <div class="mt-2 mx-auto">
        @if(count($personas))

       {{ $personas->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>

</div>


@endsection

@section('titulo')
Lista de usuarios

@endsection