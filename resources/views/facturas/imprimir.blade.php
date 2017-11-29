@extends('layouts.app')

@section('content')
<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->
    <div class="print">
    <div class="py-4 d-flex justify-content-center ">
    <a href='javascript:window.print(); void 0;' class="btn btn-success btn-lg">Imprimir</a>
    <a href='{{URL::previous()}}' class="btn btn-warning btn-lg ml-2">Volver</a> 
</div>
    </div>

    <div class="container">
        @forelse($facturas_imprimir as $factura)
        
        @include('reportes.tiposReportes.machoteFactura')
        
        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse
    </div>

@endsection