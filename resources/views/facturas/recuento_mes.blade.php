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
    <b>Recuento de facturación del mes {{$mes}} del año {{$anio}}</b> 
  </div>

  <div class="card-block"> 
  <p>En el mes {{$mes}} del año {{$anio}} se emitieron {{$facturas_fecha}} facturas, de las cuales {{$facturas_pendientes}} están pendientes de pago, mientras que las restantes {{$facturas_pagas}} ya fueron canceladas por los respectivos socios.</p>
</div>

  <div class="card-block"> 
  <p><b>De lo anterior, deducimos que:</b></p>

  <div class="table-responsive mr-5">
        
    <table class="table table-hover">
        <thead>
            <tr>
            <th class="text-center">Facturas emitidas</th>
            <th class="text-center">Facturas cobradas</th>
            <th class="text-center">Porcentaje (%)</th>
            <th class="text-center">Facturas pendientes de cobro</th>
            <th class="text-center">Porcentaje (%)</th>
            </tr>
        </thead>
    <tbody>
                       
        <tr>
            <td class="info"> {{$facturas_fecha}} </td>
            <td class="info"> {{$facturas_pagas}}</td>
            <td class="info"> {{$porcentaje_pagas}}%</td>
            <td class="info"> {{$facturas_pendientes}}</td>
            <td class="info"> {{$porcentaje_pendientes}}%</td>
        </tr>
        <tr>
            <td class="info"> 
              <a href="/facturas/recuento/{{$mes}}/{{$anio}}">Ver facturas emitidas</a> </td>
            <td class="info">
               <a href="/facturas/recuento/{{$mes}}/{{$anio}}/4">Ver facturas cobradas</a> </td>
               <td></td>
            <td class="info"> 
              <a href="/facturas/recuento/{{$mes}}/{{$anio}}/3">Ver facturas pendientes</a></td>
              <td></td>
        </tr>

    </tbody>
    </table>  

    </div>
</div>
</div>

@endsection

@section('titulo')
    Facturación
@endsection