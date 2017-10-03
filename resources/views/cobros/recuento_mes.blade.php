@extends('layouts.app')

@section('content')


	@if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

  @endif  

	<!-- Si la sesión tiene algo guardado, muestrelo -->
<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Recuento de cobros realizados el mes {{$mes}} del año {{$anio}}
  </div>

  <div class="card-block"> 
  <p>En el mes {{$mes}} del año {{$anio}} se realizaron {{$cobros_fecha}} cobros, de los cuales {{$cobros_pendientes}} están pendientes de pago por parte de los ejecutivos, mientras que los restantes {{$cobros_pagos}} ya fueron cancelados por los respectivos encargados.</p>
</div>

 <div class="list-group mt-5">
  <a href="#" class="list-group-item active">
    Ir a:
  </a>
  <a href="/cobros/recuento/{{$mes}}/{{$anio}}" class="list-group-item">Cobros realizados el mes {{$mes}} del año {{$anio}}</a>
  <a href="/cobros/recuento/{{$mes}}/{{$anio}}/3" class="list-group-item">Cobros pendientes del mes {{$mes}} del año {{$anio}}</a>
  <a href="/cobros/recuento/{{$mes}}/{{$anio}}/4" class="list-group-item">Cobros pagados del mes {{$mes}} del año {{$anio}}</a>
</div>
</div>

@endsection

@section('titulo')
    Facturación
@endsection