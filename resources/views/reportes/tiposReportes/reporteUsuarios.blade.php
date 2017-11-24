@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

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
            </tr>
        </thead>
    <tbody>
          
        <tr>
            <td class="info text-center"> socio->id </td>
            <td class="info text-center"> socio->primer_nombre </td>
            <td class="info text-center"> socio->primer_apellido </td>
            <td class="info text-center"> socio->categoria </td>
            <td class="info text-center"> socio->nombre_usuario </td>
            <td class="info text-center"> socio->estado </td>
        </tr>
    </tbody>
    </table>  
    </div>

@endsection