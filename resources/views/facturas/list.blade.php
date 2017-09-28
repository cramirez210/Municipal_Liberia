 
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
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Listado de Facturas</label>
      </li>
    </ul>
  </div>
<div class="col-md-10 offset-md-1 mt-2">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th>N° de factura</th>
            <th>Socio</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Opciones</th>
            </tr>
        </thead>
    <tbody>

        
         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info" > {{$factura->id}} </td>

            <td class="info" > {{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}</td>

            <td class="info" > {{$factura->created_at}} </td>

            <td class="info" > {{$factura->estado}} </td>

            <td class="info"> 
                 <a href="#" class="btn btn-info btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Detalles</a>
                <a href="#" class="btn btn-warning btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
                <a href="#" class="btn btn-danger btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Eliminar</a>

            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No existen facturas registradas.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

        </div>
    </div>
<div class="mt-2 mx-auto">
        @if(count($facturas))

       {{ $facturas->links('pagination::bootstrap-4') }}

        @endif 
    </div>
 </div>

</div>


@endsection

@section('titulo')
Lista de facturas

@endsection