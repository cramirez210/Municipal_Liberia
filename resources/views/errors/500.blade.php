@extends('layouts.app')

@section('content')
 
	<!-- Errores del usuario -->
 <div class="card card-outline-danger text-center mt-5">
 <div class="card-header card-danger ">
 	<h4>Error 500</h4>
 </div>
  <div class="card-block">
    <blockquote class="card-blockquote">
      <p>Lo sentimos, estamos temporalmente fuera de servicio.</p>
      
    </blockquote>
     <a href="{{ URL::previous() }}" class="btn btn-warning">Regresar</a>
  </div>
</div>

@endsection

@section('titulo')
    Error 404
@endsection
