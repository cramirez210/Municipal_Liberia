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
   <b>Recuento de cobros realizados del {{$fecha_inicio}} al {{$fecha_fin}}</b> 
  </div>

  <div class="card-block"> 
  <p>Del {{$fecha_inicio}} al {{$fecha_fin}} se realizaron {{$cobros_fecha}} cobros, de los cuales {{$cobros_pendientes}} están pendientes de pago por parte de los ejecutivos, mientras que los restantes {{$cobros_pagos}} ya fueron cancelados por los respectivos encargados.</p>
</div>

  <div class="card-block"> 
  <p><b>De lo anterior, deducimos que:</b></p>

  <div class="table-responsive mr-5">
        
    <table class="table table-hover">
        <thead>
            <tr>
            <th class="text-center">Cobros efectuados</th>
            <th class="text-center">Cobros cancelados</th>
            <th class="text-center">Porcentaje (%)</th>
            <th class="text-center">Cobros vigentes</th>
            <th class="text-center">Porcentaje (%)</th>
            </tr>
        </thead>
    <tbody>
                       
        <tr>
            <td class="info"> {{$cobros_fecha}} </td>
            <td class="info"> {{$cobros_pagos}}</td>
            <td class="info"> {{$porcentaje_pagos}}%</td>
            <td class="info"> {{$cobros_pendientes}}</td>
            <td class="info"> {{$porcentaje_pendientes}}%</td>
        </tr>
        <tr>
            <td class="info"> 
              <a href="/cobros/recuento/{{$fecha_inicio}}/{{$fecha_fin}}">Ver cobros efectuados</a> </td>
            <td class="info">
               <a href="/cobros/recuento/{{$fecha_inicio}}/{{$fecha_fin}}/4">Ver cobros cancelados</a> </td>
               <td></td>
            <td class="info"> 
              <a href="/cobros/recuento/{{$fecha_inicio}}/{{$fecha_fin}}/3">Ver cobros vigentes</a></td>
              <td></td>
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