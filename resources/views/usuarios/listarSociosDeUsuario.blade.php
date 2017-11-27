 
@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 
        
<!--_______________________________ Tabla _____________________________-->


<div class="card text-center mt-4">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="outerTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#tabc" aria-controls="tabc" role="tab" aria-expanded="true">Activos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#tabb" aria-controls="tabb" role="tab">Inactivos </a>
      </li>
      
    </ul>
  </div>
  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th class="text-center">N° de socio</th> 
            <th class="text-center">Cédula</th> 
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($sociosActivos as $socioActivo)
                       
        <tr>
            <td class="info" >{{ $socioActivo->id }}</td>
            <td class="info" >{{ $socioActivo->persona->cedula }}</td>
            <td class="info" >{{ $socioActivo->persona->primer_nombre }} {{ $socioActivo->persona->primer_apellido }} {{ $socioActivo->persona->segundo_apellido }}</td>
            <td class="info"> 
              <button type="button" class="btn btn-info btn-sm detail-socio fa fa-info-circle system-icons" data-toggle="modal" data-target="#modal"> Ver socio</button>
            </td>
        </tr>   

        @empty
        <div class="card-text text-warning">No existen socios relacionados con este usuario.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($sociosActivos))

       {{ $sociosActivos->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>
    
    </div>
    <div class="tab-pane" id="tabb" role="tabpanel">
          <div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
             <th class="text-center">N° de socio</th>
             <th class="text-center">Cédula</th> 
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>
           
         @forelse($sociosInactivos as $socioInactivo)
                       
        <tr>
          <td class="info" >{{ $socioInactivo->id }}</td>
            <td class="info" >{{ $socioInactivo->persona->cedula }}</td>
            <td class="info" >{{ $socioInactivo->persona->primer_nombre }} {{ $socioInactivo->persona->primer_apellido }} {{ $socioInactivo->persona->segundo_apellido }}</td>
            <td class="info"> 
              <button type="button" class="btn btn-info btn-sm detail-socio" data-toggle="modal" data-target="#modal">Ver socio</button>
            </td>
        </tr>  
        

        @empty
        <div class="card-text text-warning">No existen socios inactivos registrados para este usuario.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($sociosInactivos))

       {{ $sociosInactivos->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>
    
    </div>
   @include('modal')
  </div>
</div>



@endsection

@section('titulo')

Listar Socios de Usuario

@endsection