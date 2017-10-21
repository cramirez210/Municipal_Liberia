@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

  <!-- Si la sesión tiene algo guardado, muestrelo -->
<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

  <form class="form-inline" method="POST" action="/cobros/usuarios/morosos/consultar" style="margin-left: 29%;"> 
    {{ csrf_field() }}

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="Criterio">
    <option selected value="1">Cedula</option>
    <option value="2">Nombre de usuario</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>

    <span class="col-md-10">

        <button class="btn btn-info d-inline-block ml-1 mt-3" type="submit">Buscar</button>
        <a href="/cobros/index" class="btn btn-warning d-inline-block mt-3 mr-5">Cancelar</a>
        
        </span>
  </form>  
</div>
</div>




@endsection

@section('titulo')
    Consultar morosidad
@endsection