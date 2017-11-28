@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

<div class="d-flex align-items-center px-5">
	<h2 class="text-warning mb-5">Detalle: </h2>
   	<b>Número de factura: </b>{{ $listas->id }} <br>
    <b>Socio: </b> {{ $listas->primer_nombre }} {{ $listas->segundo_nombre }} {{ $listas->primer_apellido }} {{ $listas->segundo_apellido }} <br>
    <b>Categoria:</b>{{ $listas->categoria }} <br>
    <b>Monto a pagar: </b>{{ $listas->monto }} colones. <br>
    <b>Periodo: </b>{{ date('m-Y', strtotime($listas->periodo)) }}

    <div style="page-break-before: always;"></div>
</div>

@endsection