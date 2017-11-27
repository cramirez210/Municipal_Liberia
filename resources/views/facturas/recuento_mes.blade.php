@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    <b>Recuento de facturación del {{date('m-Y', strtotime($desde))}} al {{date('m-Y', strtotime($hasta))}}</b>
      <div class="col-md-2 ml-3 float-right">
        <a href="/facturas/recuento" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
            Regresar
        </a>
   </div>
  </div>

  <div class="card-block"> 
  <p>Del {{date('m-Y', strtotime($desde))}} al {{date('m-Y', strtotime($hasta))}} se emitieron {{$facturas_fecha}} facturas, de las cuales {{$facturas_pendientes}} están pendientes de pago, mientras que las restantes {{$facturas_pagas}} ya fueron canceladas por los respectivos socios.</p>
</div>

  <div class="card-block"> 
  <p><b>De lo anterior, deducimos que:</b></p>

  <div class="table-responsive mr-5">
        
    <table class="table table-hover">
        <thead>
            <tr>
            <th class="text-center">Facturas</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Porcentaje (%)</th>
            <th class="text-center">Opción</th>
            </tr>
        </thead>
    <tbody>
        
        <tr>
            <td ><b>Emitidas</b> </td>
            <td > {{$facturas_fecha}}</td>
            <td > {{$monto_recaudado + $monto_sin_liquidar}}</td>
            <td > 100.00%</td>
            <td>
              <a href="/facturas/recuento/{{$desde}}/{{$hasta}}">Ver lista</a> </td>
        </tr>               
        <tr>
            <td ><b>Cobradas</b> </td>
            <td > {{$facturas_pagas}}</td>
            <td > {{$monto_recaudado}}</td>
            <td > {{$porcentaje_pagas}}%</td>
            <td >
               <a href="/facturas/recuento/{{$desde}}/{{$hasta}}/4">Ver lista</a> </td>
        </tr>
        <tr>
            <td > <b>Pendientes</b> </td>
            <td > {{$facturas_pendientes}}</td>
            <td > {{$monto_sin_liquidar}}</td>
            <td > {{$porcentaje_pendientes}}%</td>
            <td > 
              <a href="/facturas/recuento/{{$desde}}/{{$hasta}}/3">Ver lista</a></td>
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