@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

<div class="py-4">
	@include('reportes.tiposReportes.machoteFactura')
</div>

<div class="print"> 
    @include('reportes.imprimir')
</div>
@endsection