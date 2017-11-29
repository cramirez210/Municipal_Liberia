@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

<div class="py-5">
	<div class="row d-flex align-items-center">
		<div class="col-12 text-center">
			<h2 class="text-warning mb-5">Detalle: </h2>
		</div>
	</div>
	
	<div class="row">
	<div class="d-flex flex-column text-right col-6 pr-5">
	    <b>Número de factura: </b>
		<b>Socio: </b>
		<b>Categoria:</b>
		<b>Monto a pagar: </b>
		 <b>Periodo: </b>
	</div>

	<div class="d-flex flex-column col-6">
		{{ $listas->id }} <br>
		{{ $listas->primer_nombre }} {{ $listas->segundo_nombre }} {{ $listas->primer_apellido }} {{ $listas->segundo_apellido }} <br>
		{{ $listas->categoria }} <br>
		{{ $listas->monto }} colones. <br>
       {{ date('m-Y', strtotime($listas->periodo)) }}
	</div>
	</div>


    <div style="page-break-before: always;"></div>
</div>

@endsection