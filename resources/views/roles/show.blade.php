
@extends('layouts.app')

@section('content')

<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-info" href="/roles/index">Regresar</a>
      </li>
    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary mt-2">Datos a actualizar</h4>
    
 <div class="col-md-8 offset-md-2 mt-4">
   
 <form class="form-inline" method="POST" action="/role/update/{{ $role->id }}">

 			{{ csrf_field() }}

   <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('rol') ? ' has-danger' : '' }}">
    <label for="role" class="col-md-5 form-control-label">Rol seleccionado</label>

    <div class="col-md-3 ">
        <input id="rol" placeholder="Ejemplo: Administrador" type="text" class="form-control" name="rol" value="{{ $role->rol }}" required autofocus>
         
    </div>
                           

</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
        <label for="descripcion" class="col-md-5 form-control-label ml-2">Descripcion</label>

     <div class="col-md-3 mt-2">
        <input id="descripcion" placeholder="Ejemplo: Acceso total a las funcionalidades" type="text" class="form-control" name="descripcion" value="{{ $role->descripcion }}" required autofocus> 
    </div>                        
    </div>
    <!--_______________________________ Botón _____________________________-->
    <div class="float-right">
        <div class="col-md-6 ml-3 mt-2">
            <button type="submit" class="btn btn-warning">
               Actualizar rol
            </button>
        </div>
    </div>

 </form>

 </div>

 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('rol'))
            <span class="form-control-feedback">
                <strong class="text-danger offset-md-2">{{ $errors->first('rol') }}</strong>
            </span>
        @endif  
        <br>
        @if ($errors->has('descripcion'))
            <span class="form-control-feedback">
                <strong class="text-danger offset-md-2">{{ $errors->first('descripcion') }}</strong>
            </span>
        @endif 
  </div>
</div>

@endsection

@section('titulo')
Actualizar rol  
@endsection
