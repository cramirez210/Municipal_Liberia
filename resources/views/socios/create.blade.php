@extends('layouts.app')

@section('content')

   <div class="container ml-4">

    <div class="col-md-9 offset-md-2 mt-4">

 @if(session('success')) 

  <div class="card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  

    </div>


<div class="card mt-4" style="width: 90%; height: 85%;">
  <div class="card-header">
    <ul class="nav nav-pills nav-fill card-header-pills">
      

      <li class="nav-item">
        <label class="nav-link text-primary" href="#"><h5>Registrar nuevo socio</h5></label>
      </li>

</div>

  <div class="card-block">

             <!--_______________________________ Formulario ______________________________-->

             @include('socios.formulario')

  </div>
</div>

@endsection

@section('titulo')

Socios 

@endsection