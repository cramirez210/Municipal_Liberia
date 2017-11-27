@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

<div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Cedula</th>
            <th class="text-center">Nombre Completo</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Telefono</th>
            <th class="text-center">Correo Electronico</th>
            <th class="text-center">Estado</th>
            </tr>
        </thead>
    <tbody>
        
        @if($listas != null)
         @forelse($listas as $lista)

        <tr>
            <td class="info text-center"> {{ $lista->cedula }} </td>
            <td class="info text-center"> {{ $lista->primer_nombre }} {{ $lista->primer_apellido }} {{ $lista->segundo_apellido }} </td>
            <td class="info text-center"> {{ $lista->categoria }} </td>
            <td class="info text-center"> {{ $lista->telefono }} </td>
            <td class="info text-center"> {{ $lista->email }} </td>
            <td class="info text-center"> {{ $lista->estado }} </td>
        </tr>
        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron datos..</span>

        </div>
        <br>
        @endforelse

        @endif
    </tbody>
    </table>  
    </div>

@endsection