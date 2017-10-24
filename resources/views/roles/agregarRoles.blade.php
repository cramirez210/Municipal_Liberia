 
@extends('layouts.app')

@section('content')



<div class="card text-center mt-4">`
  <div class="card-header">
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#"><h5> Listado de roles </h5></label>
      </li>

      <li class="nav-item">
        <a class="nav-link text-primary" href="/conf/index"> <h5> Regresar a Configuracion </h5></a>
      </li>


    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary">Agregar nuevos roles</h4>
     <div class="col-md-8 offset-md-2 mt-4">
 <br>
   



<div class="panel panel-default">
     
    <form class="form-inline" method="POST" action="/roles/create">
            {{ csrf_field() }}

  <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('rol') ? ' has-danger' : '' }}">
    <label for="rol" class="col-md-6 form-control-label"> Nuevo rol</label>

    <div class="col-md-3 ">
        <input id="rol" placeholder="Ejemplo: Administración" type="text" class="form-control" name="rol" value="{{ old('rol') }}" required autofocus>
    </div>
                           
</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
        <label for="descripcion" class="col-md-5 form-control-label">Descripción del rol </label>

     <div class="col-md-3 mt-2">
        
        <input id="descripcion" placeholder="Ejemplo: Acceso a todas las funciones" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

       
    </div>
                           

    </div>



    <!--_______________________________ Botón _____________________________-->

    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
               Registrar nuevo rol
            </button>
        </div>
    </div>
    </form>

 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('rol'))
            <span class="form-control-feedback">
                <strong class="text-danger">{{ $errors->first('rol') }}</strong>
            </span>
        @endif  
        <br>
        @if ($errors->has('descripcion'))
            <span class="form-control-feedback">
                <strong class="text-danger">{{ $errors->first('descripcion') }}</strong>
            </span>
        @endif
</div>


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
            <th class="text-center">Role</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

         @forelse($roles as $role)
                       
        <tr>
            <td class="info"> {{ $role->rol }} </td>
            <td class="info"> {{ $role->descripcion }} </td>
            <td class="warning"> 
                 <a href="/role/show/{{ $role->id }}" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No hay roles registrados</div>
        <br>
        @endforelse

       

    </tbody>
    </table>  

        </div>
    </div>

 </div>

      <div class="mt-2 mx-auto">
        @if(count($roles))

       {{ $roles->links('pagination::bootstrap-4') }}

        @endif 
    </div> 

     <div class="card-footer text-muted">
        
    </div>
     
</div>



@endsection

@section('titulo')

Roles de usuarios

@endsection

