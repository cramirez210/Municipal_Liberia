<!DOCTYPE html>
<html>
<head>
        <link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/css/bootstrap.css"> 
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="/css/index.css">
        <link rel="stylesheet" href="/css/style.css"/>
</head>
<body style="width:25%;" class="ml-3">
<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->
    <br>
    <h2 class="mb-5">Detalle: </h2>
    <p>Número de factura: {{ $factura->id }}  </p>
    <p>Socio: {{ $factura->primer_nombre }} {{ $factura->segundo_nombre }} {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </p>
    <p>Monto total a pagar: {{ $factura->monto }} colones.</p>
    <p>Periodo de facturación: {{ date('m-Y', strtotime($factura->periodo)) }}  </p>
    <p>Categoria actual: {{ $factura->categoria }} </p>
</body>
</html>