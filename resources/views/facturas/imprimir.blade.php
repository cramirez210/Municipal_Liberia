@extends('layouts.app')

@section('content')
<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->
<form method="POST" action="/facturas/imprimir/generar/cobro">
    {{ csrf_field() }}
<div class="print">
        <div class="py-4 d-flex justify-content-center ">
            <button id="confirmar" type="submit" class="btn btn-success btn-lg">Imprimir</button>
            <a href='{{URL::previous()}}' class="btn btn-warning btn-lg ml-2">Volver</a> 
        </div>
    </div>

    <div class="container">
        @forelse($facturas_imprimir as $factura)
        
        @include('reportes.tiposReportes.machoteFactura')
        
        <input type="hidden" name="{{$factura->id}}" value="{{$factura->id}}">
        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse
    </div>
</form>


@endsection