 
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
    <h4 class="card-title text-primary">Agregar nuevos descuentos</h4>
     <div class="col-md-auto offset-md-2 mt-4">
 <br>

<div class="d-inline-block col-md-auto">
     
    <form class="form-inline col-md-auto" method="POST" action="/descuentos/store">
            {{ csrf_field() }}

  <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('categoria') ? ' has-danger' : '' }}">
    <label for="categoria" class="col-md-auto form-control-label mr-2">Categoría</label>

    <div class="col-md-auto mt-2 mr-3">
     <select class="custom-select col-md-8" name="categoria">

        @foreach($categorias as $categoria)
          <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
        @endforeach
  </select>
    </div>
                           
</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('semestral') ? ' has-danger' : '' }}">
        <label for="semestral" class="col-md-auto form-control-label mr-2"> Semestral </label>

     <div class="col-md-auto mt-2 mr-3">
        <input id="semestral" placeholder="Ejemplo: 10000" type="text" class="form-control" name="semestral" value="{{ old('semestral') }}" required autofocus>
    </div>                       
    </div>

    <div class="form-group{{ $errors->has('anual') ? ' has-danger' : '' }}">
        <label for="anual" class="col-md-auto form-control-label mr-2"> Anual </label>

     <div class="col-md-auto mt-2">
        <input id="anual" placeholder="Ejemplo: 20000" type="text" class="form-control" name="anual" value="{{ old('anual') }}" required autofocus>
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

    @if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

  @endif  
<!--_______________________________ Tabla _____________________________-->
<div class="card text-center mt-4"> 
<div class="col-md-8 offset-md-2 mt-4">
  
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Categoria</th>
            <th class="text-center">Semestral</th>
            <th class="text-center">Anual</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

         @forelse($descuentos as $descuento)
                       
        <tr>
            <td class="info"> {{ $descuento->categoria }} </td>
            <td class="info"> {{ $descuento->semestral }} </td>
            <td class="info"> {{ $descuento->anual }} </td>
            <td class="warning"> 
                 <a href="/descuentos/show/{{ $descuento->id }}" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No hay descuentos registrados</div>
        <br>
        @endforelse

    </tbody>
    </table>  

        </div>
    </div>

 </div>

      <div class="mt-2 mx-auto">
        @if(count($descuentos))

       {{ $descuentos->links('pagination::bootstrap-4') }}

        @endif 
    </div> 

     <div class="card-footer text-muted">
        
    </div>
     
</div>



@endsection

@section('titulo')

Descuentos

@endsection

