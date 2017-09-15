 
@extends('layouts.app')

@section('content')


  @if(session('success')) 

  <div class="mt-4 card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  
        
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
            <th>Nombre de usuario</th>
            <th>Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($usuarios as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
   

            <td class="info"> 
                 <a href="/personas/mostrar/{{ $usuario->id }}" class="btn btn-info btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Ver usuario</a>
                <a href="/personas/editar/{{ $usuario->id }}" class="btn btn-warning btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
                <a href="" class="btn btn-danger btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Eliminar</a>

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

        </div>
    </div>

 </div>

</div>


@endsection

@section('titulo')
Lista de usuarios

@endsection