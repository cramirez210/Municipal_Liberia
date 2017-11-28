@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

 @include('reportes.tiposReportes.table_cobros')

 <div class="print"> 
    @include('reportes.imprimir')
    </div>

@endsection

