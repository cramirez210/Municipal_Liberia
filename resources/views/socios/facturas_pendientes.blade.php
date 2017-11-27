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
  <div class="card-tittle text-primary"><b>Facturas pendientes del socio: {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}} N° {{$socio->socio_id}}</b></div>
    <ul class="nav nav-pills card-header-pills float-right">
    <li class="nav-item">
      <div class="col-md-2 mr-3">
        <a href="{{URL::previous()}}" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
           Regresar
        </a>
   </div>
    </li>
    </ul>
    
  </div> 


  <div class="card-body tab-content">
    <div class="tab-pane active" id="tabc" role="tabpanel">
    
    <div class="container-fluid col-md-9">
<div class="row">

@include('socios.facturas_table')
    </div>

 </div>
</div>
</div>

<div class="mt-2 mx-auto">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>

    <div class="card-footer text-muted">
        Se encontraron {{ count($facturas) }} resultados.

    </div>
</div>

@endsection

@section('titulo')

Facturas - Socio

@endsection