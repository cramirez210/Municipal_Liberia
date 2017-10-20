

@component('mail::message')
    Buenas, {{}} se ha añadido un nuevo socio a su cartera. 

<body>
    <img src="http://www.rockaxis.com.co/sites/default/files/node/novedades/imagen/123362.jpg">


    @component('mail::button', ['url' => 'https://www.paulmccartney.com/', 'color' => 'green'])
    Página Official de Paul
@endcomponentf

    @component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@component('mail::panel')
Tiquetes en linea
@endcomponent
</body>

@endcomponent