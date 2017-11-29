
@component('mail::message')
   
    # Hola! {{ $persona->primer_nombre }} {{ $persona->primer_apellido }}, se ha generado un nuevo cobro a su afiliación con el Municipal Liberia

<body>


     <img src="http://www.monstruolocura.com/saprissa/wp-content/uploads/2015/06/Municipal-Liberia-Logo1.png" style="width: 110px; height: 115px; margin-left: 40%;"> 

<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->

    <br>
    <h2>Detalle: </h2>
    <p>Número de factura: {{ $factura->id }}  </p>
    <p>A nombre de: {{ $persona->primer_nombre }} {{ $persona->segundo_nombre }} {{ $persona->primer_apellido }} {{ $persona->segundo_apellido }} </p>
    <p>Monto total a pagar: {{ $factura->monto }} colones.</p>
    <p>Periodo de facturación: {{ $periodo }}  </p>
    <p>Categoria actual: {{ $categoria->categoria }} </p>


    @component('mail::button', ['url' => 'http://municipalliberia.com/', 'color' => 'green'])
     Municipal Liberia
    @endcomponent

    <p>Este mensaje se envió automáticamente, por favor no responder. Más información al número de teléfono: +(506) 4700-5179</p>
</body>

@endcomponent

