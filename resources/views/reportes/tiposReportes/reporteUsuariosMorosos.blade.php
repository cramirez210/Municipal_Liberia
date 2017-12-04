@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

    <div class="print">
    @include('reportes.imprimir')
    </div>

 <div class="table-responsive ml-4">
        
    <table id="table" class="table table-hover text-center">
        <thead>
            <tr>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Cobros a liquidar</th>
            <th class="text-center">Monto</th>
            <th class="text-center print">Email</th>
            <th class="text-center">Teléfono</th>
            </tr>
        </thead>
    <tbody>

         @forelse($morosos as $moroso)
                       
        <tr>
            <td class="info"> {{ $moroso->primer_nombre }} {{ $moroso->primer_apellido }} {{ $moroso->segundo_apellido }} </td>
            <td class="info"> {{ $DB->ObtenerPorUsuarioEstado($moroso->id, 3)->count() }}  </td>
            <td class="info"> {{ round($DB->ObtenerPorUsuarioEstado($moroso->id, 3)->sum('monto'), 0, PHP_ROUND_HALF_UP) }}  </td>
            <td class="info print"> {{ $moroso->email }} </td>
            <td class="info"> {{ $moroso->telefono }} </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    </div>

@endsection