@extends('layouts.app')

@section('content')


	@if(session('success')) 

		<span class="text-success mt-4">
				
				<h2>{{ session('success') }}</h2>

		</span>

	@endif	

	<!-- Si la sesión tiene algo guardado, muestrelo -->


<h1 class="mt-5"> En Mantenimiento </h1>
<h3 class="card-text text-muted"> Josué, Jafet, Carlos </h1>

@endsection







@section('titulo')
    ASMLG | Municipal Liberia
@endsection