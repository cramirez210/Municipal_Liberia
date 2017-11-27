 
@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

<button class="btn btn-success btn-md mt-3 fa fa-search system-icons" data-toggle="modal" data-target="#filtrar_users"> Realizar una búsqueda</button>
@include('usuarios.filtrar')
        
<!--_______________________________ Tabla _____________________________-->


<div class="card text-center mt-4">
  <div class="card-header">
    <div class="card-tittle text-primary ml-5">
    @if(isset($estado_id)) <h5 class="ml-5">
        @if($estado_id == 1) <b>Lista de usuarios activos</b> @endif
        @if($estado_id == 2) <b>Lista de usuarios inactivos</b> @endif
        @if($estado_id == 0) <b>Todos los usuarios</b> @endif
    </h5>
    @else

    @if(isset($rol_id)) <h5 class="ml-5">
        @if($rol_id == 1) <b>Lista de usuarios administradores</b> @endif
        @if($rol_id == 2) <b>Lista de usuarios estándar</b> @endif
        @if($rol_id == 3) <b>Lista de usuarios ejecutivos</b> @endif
        @if($rol_id == 0) <b>Todos los usuarios</b> @endif
    </h5>
    @else <h5 class="ml-4"> <b>Usuarios</b> </h5>

    @endif
    @endif
  </div>
    <ul class="nav nav-tabs nav-fill card-header-tabs" id="outerTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link text-primary fa fa-user-plus system-icons" href="/usuarios/showCreate">  Nuevo usuario</a>
      </li>


      <li class="nav-item dropdown mt-2">
            <a class="dropdown-toggle fa fa-list system-icons" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Listar</a>

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
    
    <div id="tabla_usuarios" class="container-fluid col-md-9">

      @include('usuarios.table')
    </div>
    
    </div>
  </div>
</div>



@endsection

@section('titulo')

Listar Usuarios

@endsection