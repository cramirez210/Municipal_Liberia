
@extends('layouts.app')

@section('content')

  
<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#"><h5> Listado de descuentos </h5></label>
      </li>

      <li class="nav-item">
        <a class="nav-link text-primary" href="/conf/index"> <h5> Regresar a Configuracion </h5></a>
      </li>


    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary">Actualizar descuentos</h4>
     <div class="col-md-auto offset-md-2 mt-4">
 <br>

<div class="d-inline-block col-md-auto">
     
    <form class="form-inline col-md-auto" method="POST" action="/descuentos/update/{{$descuento->id}}">
            {{ csrf_field() }}

  <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('categoria') ? ' has-danger' : '' }}">
    <label for="categoria" class="col-md-auto form-control-label mr-2">Categoría</label>

    <div class="col-md-auto mt-2 mr-3">
     <select class="custom-select col-md-8" name="categoria">

        @foreach($categorias as $categoria)
           @if($descuento->categoria_id == $categoria->id)
          <option selected value="{{$categoria->id}}">{{$categoria->categoria}}</option>
          @else
          <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
          @endif
        @endforeach
  </select>
    </div>
                           
</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('semestral') ? ' has-danger' : '' }}">
        <label for="semestral" class="col-md-auto form-control-label mr-2"> Semestral </label>

     <div class="col-md-auto mt-2 mr-3">
        <input id="semestral" placeholder="Ejemplo: 10000" type="text" class="form-control" name="semestral" value="{{$descuento->semestral}}" required autofocus>
    </div>                       
    </div>

    <div class="form-group{{ $errors->has('anual') ? ' has-danger' : '' }}">
        <label for="anual" class="col-md-auto form-control-label mr-2"> Anual </label>

     <div class="col-md-auto mt-2">
        <input id="anual" placeholder="Ejemplo: 20000" type="text" class="form-control" name="anual" value="{{ $descuento->anual }}" required autofocus>
    </div>                       
    </div>



    <!--_______________________________ Botón _____________________________-->

    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary mt-2">
               Registrar
            </button>
        </div>
    </div>
    </form>

 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('semestral'))
            <span class="form-control-feedback">
                <strong class="text-danger">{{ $errors->first('semestral') }}</strong>
            </span>
        @endif  
        <br>
        @if ($errors->has('anual'))
            <span class="form-control-feedback">
                <strong class="text-danger">{{ $errors->first('anual') }}</strong>
            </span>
        @endif
</div>


<br>
    </div>
    </div>

    </div>

@endsection

@section('titulo')
Actualizar descuento  
@endsection
