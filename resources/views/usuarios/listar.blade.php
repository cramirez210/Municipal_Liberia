 
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



<form class="form-inline" method="GET" action="/usuarios/find" style="margin-left: 29%;">
  

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="criterio">
    <option selected value="1">Cedula</option>
    <option value="2">Nombre de usuario</option>
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
        
<!--_______________________________ Tabla _____________________________-->


<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">


      <li class="nav-item">
        <a class="nav-link text-primary" href="/usuarios/showCreate">Nuevo usuario</a>
      </li>


      <li class="nav-item dropdown mt-2">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/usuarios/listarPorEstado/1">Usuarios Activos</a>
         <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/usuarios/listarPorEstado/2">Usuarios Inactivos</a>
             <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/usuarios/listarTodos">Todos los usuarios</a>
        </div>
      </li>



    </ul>
  </div>
  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-9">
<div class="row">

 <div class="table-responsive  table-condensed">
        
    <table WIDTH="100%" class="table table-responsive" >
        <thead>
            <tr>
            <th class="text-center w-50">Nombre de usuario</th>
            <th class="text-center">Nombre</th>
            <th class="text-center w-50">Apellidos</th>
            <th class="text-center">Cédula</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

        @if($usuarios !== null)
         @forelse($usuarios as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
            <td class="info" > {{$usuario->primer_nombre}} {{$usuario->segundo_nombre}} </td>
            <td class="info" > {{$usuario->primer_apellido}} {{$usuario->segundo_apellido}} </td>
            <td class="info" > {{$usuario->cedula}} </td>
   
            <td class="info"> 
                <a href="/personas/mostrar/{{ $usuario->id }}" class="btn btn-success btn-xs col-md-12 mt-1">
                <span class="glyphicon glyphicon-remove-circle"></span>Detalle</a>
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



@endsection

@section('titulo')

Listar Usuarios

@endsection

