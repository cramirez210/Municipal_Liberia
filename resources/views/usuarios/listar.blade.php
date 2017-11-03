 
@extends('layouts.app')

@section('content')


@include('mensajes.alertas') 

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de búsqueda para usuarios.
  </div>

  <div class="card-block">




<form  method="GET" action="/usuarios/find">
  
  <select class="custom-select mb-1" name="criterio">
    <option selected value="1">Cedula</option>
    <option value="2">Nombre de usuario</option>
  </select>
  <label class=" ">
        <input type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" required autofocus>  
       
  </label>
      <button class="btn btn-success mb-1" type="submit">Buscar !</button>

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
          <a class="dropdown-item" href="/usuarios/listarTodos">Todos los usuarios</a>
            <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/usuarios/listarPorEstado/1">Usuarios Activos</a>
            <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/usuarios/listarPorEstado/2">Usuarios Inactivos</a>
            <div class="dropdown-divider"></div>
            <div class="dropdown-submenu" style="">  
                <a id="subRoles" tabindex="-1" href="#" style="">Roles</a>
                <ul class="dropdown-menu">
                 
                  <li><a id="subRoles" tabindex="-1" href="/usuarios/listarPorRole/1">Administrador</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a  id="subRoles" href="/usuarios/listarPorRole/2">Estándar</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a id="subRoles" href="/usuarios/listarPorRole/3">Ejecutivo</a></li>
             
                </ul>
            </div>
            

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
            <th class="text-center">Rol</th>
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
            <td class="info" >  {{$usuario->rol}} </td>
   
            <td class="info"> 
                 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$usuario->id}}">Detalle</button>

                    <div id="{{$usuario->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detalle de usuario</h4>
                            @include('usuarios.links')
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
                            @include('personas.show')
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>
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

