@extends('reportes.reporte')

@section('header')

@include('reportes.encabezados.encabezadoReportes')

@endsection

@section('contenido')

@include('reportes.tiposReportes.machoteFactura')

@endsection