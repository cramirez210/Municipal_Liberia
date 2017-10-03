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
    Recuento de facturación del mes {{$mes}} del año {{$anio}}
  </div>

  <div class="card-block"> 
  <p>En el mes {{$mes}} del año {{$anio}} se emitieron {{$facturas_fecha}} facturas, de las cuales {{$facturas_pendientes}} están pendientes de pago, mientras que las restantes {{$facturas_pagas}} ya fueron canceladas por los respectivos socios.</p>
</div>

 <div class="list-group mt-5">
  <a href="#" class="list-group-item active">
    Ir a:
  </a>
  <a href="/facturas/recuento/{{$mes}}/{{$anio}}" class="list-group-item">Facturas emitidas el mes {{$mes}} del año {{$anio}}</a>
  <a href="/facturas/recuento/{{$mes}}/{{$anio}}/3" class="list-group-item">Facturas pendientes del mes {{$mes}} del año {{$anio}}</a>
  <a href="/facturas/recuento/{{$mes}}/{{$anio}}/4" class="list-group-item">Facturas pagadas del mes {{$mes}} del año {{$anio}}</a>
</div>
</div>

@endsection

@section('titulo')
    Facturación
@endsection