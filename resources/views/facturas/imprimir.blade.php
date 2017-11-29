<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reportes Sistema</title>
    <link rel="shortcut icon" href="{{ asset('storage/img/logo-title.ico') }}"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css"/>
</head>
<body class="ml-2 text-center">
<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->
    <div class="print">
    <div class="py-4 d-flex justify-content-center ">
    <a href='javascript:window.print(); void 0;' class="btn btn-success btn-lg">Imprimir</a> 
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


            <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/jquery.js"></script>
</body>
</html>