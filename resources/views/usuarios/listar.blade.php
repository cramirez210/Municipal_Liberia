 
@extends('layouts.app')

@section('content')


  @if(session('success')) 

  <div class="mt-4 card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de búsqueda para usuarios.
  </div>

  <div class="card-block">



  <form class="form-inline"  method="GET" action="/usuarios/find" style="margin-left: 29%;">
  

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0"  id="inlineFormCustomSelect">

    <option value="1">Cédula</option>
    <option value="2">Nombre de usuario</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Criterio">
        <span class="input-group-btn">
        <button class="btn btn-info" type="button">Buscar usuario</button>
        </span>
  </label>

</form>  


</div>

</div>
        
<!--_______________________________ Tabla _____________________________-->


<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="outerTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#tabc" aria-controls="tabc" role="tab" aria-expanded="true">Administradores
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tabb" aria-controls="tabb" role="tab">Estándar </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-primary" href="/register">Nuevo usuario</a>
      </li>

       <li class="nav-item dropdown " style="margin-left: 57%;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/socios/indexActivos">Usuarios Activos</a>
         <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/socios/indexInactivos">Usuarios Inactivos</a>
            
        </div>
    </li>

      
    </ul>
  </div>
  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th class="text-center">Nombre de usuario</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($usuariosAdministrador as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
   
            <td class="info"> 
                <a href="socios/{{ $usuario->id }}" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Ver socios relacionados</a>

                <a href="/personas/mostrar/{{ $usuario->id }}" class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Mostrar usuario</a>

                <a href="/personas/editar/{{ $usuario->id }}" class="btn btn-warning btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        

        @empty
        <div class="card-text text-warning">No existen usuarios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($usuariosAdministrador))

       {{ $usuariosAdministrador->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>
    
    </div>
    <div class="tab-pane" id="tabb" role="tabpanel">
          <div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th class="text-center">Nombre de usuario</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($usuariosEstandar as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
   
            <td class="info"> 
                 <a href="socios/{{ $usuario->id }}" class="btn btn-success btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Ver socios relacionados</a>

                <a href="/personas/mostrar/{{ $usuario->id }}" class="btn btn-info btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Mostrar usuario</a>

                <a href="/personas/editar/{{ $usuario->id }}" class="btn btn-warning btn-xs">
                <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        

        @empty
        <div class="card-text text-warning">No existen usuarios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($usuariosEstandar))

       {{ $usuariosEstandar->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>
    
    </div>
   
  </div>
</div>



@endsection

@section('titulo')

Listar Usuarios

@endsection