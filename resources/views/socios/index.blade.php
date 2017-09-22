@extends('layouts.app')

@section('content')


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
        <label class="nav-link text-primary" href="#">Listado de Socios</label>
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
                 <a href="#" class="btn btn-success btn-xs">
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
</div>

@endsection

@section('titulo')

Socios

@endsection