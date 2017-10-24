
@component('mail::message')
   
    # Hola! {{ $persona->primer_nombre }} {{ $persona->segundo_nombre }} {{ $persona->primer_apellido }} {{ $persona->segundo_apellido }} se ha añadido un nuevo socio a su cartera. 


<body>


     <img src="http://www.monstruolocura.com/saprissa/wp-content/uploads/2015/06/Municipal-Liberia-Logo1.png" style="width: 110px; height: 115px; margin-left: 40%;"> 

<!--    <img src=" {{ asset('/storage/socios/default.png') }}"> -->


    <h2>Datos del socio: </h2>
    <p>Nombre: {{ $request->primer_nombre }} {{ $request->segundo_nombre }} {{ $request->primer_apellido }} {{ $request->segundo_apellido }} </p>
    <p>Cédula: {{ $request->cedula }} </p>
    <p>Correo: {{ $request->email }} </p>
    <p>Telefono: {{ $request->telefono }} </p>
    <p>Categoria: {{ $request->categoria_id }} </p>


    @component('mail::button', ['url' => 'http://municipalliberia.com/', 'color' => 'green'])
     Municipal Liberia
    @endcomponent

</body>

@endcomponent