@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

    <div class="print">
    @include('reportes.imprimir')
    </div>

<div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N°</th>
            <th class="text-center">Ejecutivo</th>
            <th class="text-center">Teléfono</th>
            <th class="text-center">Monto recaudado</th>
            <th class="text-center">Comision</th>
            <th class="text-center">Fecha</th>

            </tr>
        </thead>
    <tbody>
        
        @if($comisiones != null)
         @forelse($comisiones as $comision)

        <tr>
            <td class="info text-center"> {{ $comision->id }} </td>
            <td class="info text-center"> {{ $comision->primer_nombre }} {{ $comision->primer_apellido }} {{ $comision->segundo_apellido }} </td>
            <td class="info text-center"> {{ $comision->telefono }} </td>
            <td class="info text-center"> {{ $comision->monto }} </td>
            <td class="info text-center"> {{ $comision->comision }} </td>
            <td class="info text-center"> {{ date('d-m-Y', strtotime($comision->created_at)) }} </td>
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