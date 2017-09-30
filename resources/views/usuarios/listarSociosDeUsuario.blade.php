 
@extends('layouts.app')

@section('content')


  @if(session('success')) 

  <div class="mt-4 card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  
        
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
            <th class="text-center">Cédula</th> 
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($sociosActivos as $socioActivo)
                       
        <tr>
            <td class="info" >{{ $socioActivo->persona->cedula }}</td>
            <td class="info" >{{ $socioActivo->persona->primer_nombre }} {{ $socioActivo->persona->primer_apellido }} {{ $socioActivo->persona->segundo_apellido }}</td>
            <td class="info"> 
              <a href="/socios/show/{{ $socioActivo->id }}" class="btn btn-info btn-xs">
              <span class="glyphicon glyphicon-remove-circle"></span>Ver socio</a>
            </td>
        </tr>   

        @empty
        <div class="card-text text-warning">No existen socios activos registrados con este usuario.</div>
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
             <th class="text-center">Cédula</th> 
            <th class="text-center">Nombre</th>
            <th class="text-center">Opciones</th>
            </tr>
        </thead>
    <tbody>
           
         @forelse($sociosInactivos as $socioInactivo)
                       
        <tr>
            <td class="info" >{{ $socioInactivo->persona->cedula }}</td>
            <td class="info" >{{ $socioInactivo->persona->primer_nombre }} {{ $socioInactivo->persona->primer_apellido }} {{ $socioInactivo->persona->segundo_apellido }}</td>
            <td class="info"> 
              <a href="/socios/show/{{ $socioInactivo->id }}" class="btn btn-info btn-xs">
              <span class="glyphicon glyphicon-remove-circle"></span>Ver socio</a>
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
   
  </div>
</div>



@endsection

@section('titulo')

Listar Socios de Usuario

@endsection