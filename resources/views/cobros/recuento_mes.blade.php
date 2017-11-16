@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

	<!-- Si la sesión tiene algo guardado, muestrelo -->
<div class="card text-center mt-4">
  <div class="card-header text-primary">
    <div class="card-tittle">
      <b>Recuento de cobros realizados del {{date('d-m-Y', strtotime($desde))}} al {{date('d-m-Y', strtotime($hasta))}}</b>
    </div>
    
   <div class="col-md-2 ml-3 float-right">
        <a href="/cobros/recuento" class="btn btn-warning btn-md">
           Regresar
        </a>
   </div>
  </div>

  <div class="card-block"> 
  <p>Del {{date('m-Y', strtotime($desde))}} al {{date('m-Y', strtotime($hasta))}} se realizaron {{$cobros_fecha}} cobros, de los cuales {{$cobros_pendientes}} están pendientes de pago por parte de los ejecutivos, mientras que los restantes {{$cobros_pagos}} ya fueron cancelados por los respectivos encargados.</p>
</div>

  <div class="card-block"> 
  <p><b>De lo anterior, deducimos que:</b></p>

  <div class="table-responsive mr-5">
        
    <table class="table table-hover">
        <thead>
            <tr>
            <th class="text-center">Cobros</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Porcentaje (%)</th>
            <th class="text-center">Opción</th>
            </tr>
        </thead>
    <tbody>
        
        <tr>
            <td ><b>Efectuados</b> </td>
            <td > {{$cobros_fecha}}</td>
            <td > {{$monto_recaudado + $monto_sin_liquidar}}</td>
            <td > 100.00%</td>
            <td>
              <a href="/cobros/recuento/{{$desde}}/{{$hasta}}">Ver lista</a> </td>
        </tr>               
        <tr>
            <td ><b>Liquidados</b> </td>
            <td > {{$cobros_pagos}}</td>
            <td > {{$monto_recaudado}}</td>
            <td > {{$porcentaje_pagos}}%</td>
            <td >
               <a href="/cobros/recuento/{{$desde}}/{{$hasta}}/4">Ver lista</a> </td>
        </tr>
        <tr>
            <td > <b>Pendientes</b> </td>
            <td > {{$cobros_pendientes}}</td>
            <td > {{$monto_sin_liquidar}}</td>
            <td > {{$porcentaje_pendientes}}%</td>
            <td > 
              <a href="/cobros/recuento/{{$desde}}/{{$hasta}}/3">Ver lista</a></td>
        </tr>
    </tbody>
    </table>  

    </div>
</div>
</div>

@endsection

@section('titulo')
    Cobros
@endsection