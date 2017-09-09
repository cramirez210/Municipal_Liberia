@extends('layouts.app')

@section('content')

<div class="col-md-8 offset-md-2 mt-4">
	

 <h3 class="h3 text-primary mt-4">Datos a Actualizar</h3>
   
 <form class="form-inline" method="POST" action="/categoria/update/{{$categoria->id}}">
 			{{ csrf_field() }}
   <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('categoria') ? ' has-danger' : '' }}">
    <label for="categoria" class="col-md-5 form-control-label">Nueva Categoria</label>

    <div class="col-md-3 ">
        <input id="categoria" placeholder="Ejemplo: Sol" type="text" class="form-control" name="categoria" value="{{ $categoria->categoria }}" required autofocus>

         
    </div>
                           

</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('precio_categoria') ? ' has-danger' : '' }}">
        <label for="precio_categoria" class="col-md-5 form-control-label">Precio Categoria</label>

     <div class="col-md-3 mt-2">
        <input id="precio_categoria" placeholder="Ejemplo: ₡5000" type="text" class="form-control" name="precio_categoria" value="{{ $categoria->precio_categoria }}" required autofocus>

       
    </div>
                           

    </div>



    <!--_______________________________ Botón _____________________________-->

    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-warning">
               Registrar Categoria
            </button>
        </div>
    </div>



    </form>


 </div>

 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('categoria'))
            <span class="form-control-feedback">
                <strong class="text-danger offset-md-2">{{ $errors->first('categoria') }}</strong>
            </span>
        @endif  
        <br>
        @if ($errors->has('precio_categoria'))
            <span class="form-control-feedback">
                <strong class="text-danger offset-md-2">{{ $errors->first('precio_categoria') }}</strong>
            </span>
        @endif 


@endsection

@section('titulo')
ActuCategorias 

@endsection