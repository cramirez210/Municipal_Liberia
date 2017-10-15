@extends('layouts.app')

@section('content')
 
	<!-- Errores del usuario -->
 <div class="card card-outline-danger text-center mt-5">
 <div class="card-header card-danger ">
 	<h4>Error 404</h4>
 </div>
  <div class="card-block">
    <blockquote class="card-blockquote">
      <p>Lo sentimos, no hemos podido encontrar lo que está buscando.</p>
      
    </blockquote>
     <a href="{{ URL::previous() }}" class="btn btn-primary">Regresar</a>
  </div>
</div>

@endsection

@section('titulo')
    Error 404
@endsection
