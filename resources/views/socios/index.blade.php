@extends('layouts.app')

@section('content')

@if(count($errors))
<div>
<br>
<span class="text-danger mt-4">
        @if($errors->has('valor'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('valor') }}</strong>
          </span>
        @endif
        <br>
        @if($errors->has('criterio'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('criterio') }}</strong>
          </span>
        @endif
    </span>
</div>
@endif

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">


  <form class="form-inline" method="GET" action="/socios/find" style="margin-left: 29%;">
  

  <select id="select" class="custom-select mb-2 mr-sm-2 mb-sm-0" name="criterio">
    @if(count($socios))
    <option value="1">Cedula</option>
    <option selected value="2">Numero de Socio</option>
    <option value="3">Categoria</option>
    @else
    <option value="1">Cedula</option>
    <option selected value="2">Numero de Socio</option>
    @endif
    
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input id="valor" type="text" class="form-control" placeholder="Ejemplo: 243" type="text" name="valor" value="{{ old('valor') }}" required autofocus onkeyup="filtrar()">

        <span class="input-group-btn">
        <button class="btn btn-info" type="submit">Buscar !</button>
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
    <ul class="nav nav-pills nav-fill card-header-pills">
      <li class="nav-item">
         <a class="nav-link text-primary" href="/socios/asignarEjecutivo">Nuevo Socios</a>
      </li>

      <li class="nav-item dropdown mt-2">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/socios/listarTodos">Todos los Socios</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/socios/listarPorEstado/1">Socios Activos</a>
        <a class="dropdown-item" href="/socios/listarPorEstado/2">Socios Inactivos</a> 
        <div class="dropdown-divider"></div> 
      </div>
      </li>
    </ul>
    
  </div> 
<div class="col-md-8 offset-md-2 mt-4">

<div class="row">

 <div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Carnet</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Ejecutivo</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

      @if($socios!==null)

         @forelse($socios as $socio)
                       
        <tr>
            <td class="info text-center"> {{ $socio->id }} </td>
            <td class="info text-center"> {{ $socio->primer_nombre }} </td>
            <td class="info text-center"> {{ $socio->primer_apellido }} {{ $socio->segundo_apellido }} </td>
            <td class="info text-center"> {{ $socio->categoria }} </td>
            <td class="info text-center"> {{ $socio->nombre_usuario }} </td>
            <td class="info text-center"> {{ $socio->estado }} </td>
            <td class="warning text-center"> 
              
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
        Se encontraron {{ count($socios) }} resultados. 

    </div>
</div>
@endif

@endsection

@section('titulo')

Socios

@endsection
