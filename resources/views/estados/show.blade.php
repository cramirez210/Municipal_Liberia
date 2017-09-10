@extends('layouts.app')

@section('content')

<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-info" href="/estados/home">Regresar</a>
      </li>
    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary mt-2">Datos Para Ser Actualizados</h4>
    
 <div class="col-md-8 offset-md-2 mt-4">
   
 <form class="form-inline" method="POST" action="/estados/update/{{$estado->id}}">
 			{{ csrf_field() }}
   <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('estado') ? ' has-danger' : '' }}">
    <label for="estado" class="col-md-5 form-control-label">Nueva Categoria</label>

    <div class="col-md-3 ">
        <input id="estado" placeholder="Ejemplo: Sol" type="text" class="form-control" name="estado" value="{{ $estado->estado }}" required autofocus>

         
    </div>
                           

</div>
    <!--_______________________________ Botón _____________________________-->
    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-warning">
               Guardar
            </button>
        </div>
    </div>

 </form>

 </div>

 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('estado'))
            <span class="form-control-feedback">
                <strong class="text-danger offset-md-2">{{ $errors->first('estado') }}</strong>
            </span>
        @endif  
  </div>
</div>

@endsection

@section('titulo')
Actualizar Estado 
@endsection

