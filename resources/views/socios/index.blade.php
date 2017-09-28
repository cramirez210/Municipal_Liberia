@extends('layouts.app')

@section('content')

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">



  <form class="form-inline" style="margin-left: 29%;">
  

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
    <option selected>Criterio...</option>
    <option value="1">Cedula</option>
    <option value="2">Numero de Socio</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Criterio">
        <span class="input-group-btn">
        <button class="btn btn-info" type="button">Buscar !</button>
        </span>
  </label>

</form>  


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
<div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link text-primary" href="/socios/index">Listado de Socios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-primary" href="/socios/home">Nuevo Socios</a>
      </li>
  
         <li class="nav-item dropdown " style="margin-left: 60%;">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/socios/listarPorEstado/1">Socios Activos</a>
         <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/socios/listarPorEstado/2">Socios Inactivos</a>
        </div>
    </li>
    </ul>
    
  </div> 
<div class="col-md-8 offset-md-2 mt-4">

<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Cedula</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Ejecutivo</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($socios as $socio)
                       
        <tr>
            <td class="info"> {{ $socio->cedula }} </td>
            <td class="info"> {{ $socio->primer_nombre }} </td>
            <td class="info"> {{ $socio->primer_apellido }} {{ $socio->segundo_apellido }} </td>
            <td class="info"> {{ $socio->categoria }} </td>
            <td class="info"> {{ $socio->nombre_usuario }} </td>
            <td class="info"> {{ $socio->estado }} </td>
            <td class="warning"> 
              
              <a href="/socios/show/{{ $socio->id }}" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Detalle</a>

            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay Datos Registradas </span>

        </div>
        <br>
        @endforelse

       

    </tbody>
    </table>  

    </div>
    </div>

 </div>

<div class="mt-2 mx-auto">
        @if(count($socios))

       {{ $socios->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    <div class="card-footer text-muted">

    </div>
</div>

@endsection

@section('titulo')

Socios

@endsection