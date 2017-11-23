<!DOCTYPE html>
<html>
<head>
</head>
<body style="width:30%;" class="ml-2">
<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->
    
    @forelse($facturas_imprimir as $factura)
                       
       <h2 class="text-warning mb-5">Detalle: </h2>
       <b>Número de factura: </b>{{ $factura->id }} <br>
       <b>Socio: </b> {{ $factura->primer_nombre }} {{ $factura->segundo_nombre }} {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} <br>
       <b>Categoria:</b>{{ $factura->categoria }} <br>
       <b>Monto a pagar: </b>{{ $factura->monto }} colones. <br>
       <b>Periodo: </b>{{ date('m-Y', strtotime($factura->periodo)) }}

    <div style="page-break-before: always;"></div>
        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse

</body>
</html>