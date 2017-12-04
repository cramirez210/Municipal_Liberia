@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

 <div class="print"> 
    @include('reportes.imprimir')
    </div>

 @include('reportes.tiposReportes.table_cobros')



@endsection

