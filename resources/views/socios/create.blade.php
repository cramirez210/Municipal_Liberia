@extends('layouts.app')

@section('content')

<div class="container ml-4 pb-5">

  <div class="card mt-4" style="width: 90%; height: 85%;">

    <div class="card-header">
      <ul class="nav nav-pills nav-fill card-header-pills">
        <li class="nav-item">
          <label class="nav-link text-primary" href="#"><h5>Registrar nuevo socio</h5></label>
        </li>
      </ul>
    </div>

  <div class="card-block">
     <!--_______________________________ Formulario ______________________________-->
    @include('socios.formulario')
  </div>
  
</div>
</div>

@endsection

@section('titulo')

Nuevo Socio 

@endsection