@extends('layouts.app')

@section('content')
<div class="card text-center mt-5">
 <div class="card-header "  id="barra">
    <h4>Bienvenido(a) {{ Auth::user()->nombre_usuario}}</h4>
 </div>
  <div class="card-block">
    <blockquote class="card-blockquote">
      <p>Ha ingresado sesión.</p>
      
    </blockquote>
     <a href="/" class="btn btn-success fa fa-home system-icons"> Página Principal</a>
  </div>
</div>
@endsection

@section('titulo')
    Bienvenido(a)
@endsection