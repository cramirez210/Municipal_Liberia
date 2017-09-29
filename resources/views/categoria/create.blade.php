 
@extends('layouts.app')

@section('content')

<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Listado de Categorias</label>
      </li>

      <li class="nav-item">
        <a class="nav-link text-primary" href="/conf/index" style="margin-left: 76%;">Regresar a Configuracion</a>
      </li>
      
    </ul>
  </div>
  <div class="card-block">
    <h4 class="card-title text-primary">Incluir Categoria</h4>
     <div class="col-md-8 offset-md-2 mt-4">
 <br>
   
@include('categoria.formulario')
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
            <th class="text-center">Precio Categoria</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

         @forelse($categorias as $categoria)
                       
        <tr>
            <td class="info"> {{$categoria->categoria}} </td>
            <td class="info"> ₡{{$categoria->precio_categoria}} </td>
            <td class="warning"> 
                 <a href="/categoria/{{$categoria->id}}" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No hay Categorias Registradas</div>
        <br>
        @endforelse

       

    </tbody>
    </table>  

        </div>
    </div>

 </div>

      <div class="mt-2 mx-auto">
        @if(count($categorias))

       {{ $categorias->links('pagination::bootstrap-4') }}

        @endif 
    </div> 
    <div class="card-footer text-muted">
        
    </div>
</div>

@endsection

@section('titulo')

Categorias Socios 

@endsection

