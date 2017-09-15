@extends('layouts.app')

@section('content')

   <div class="row">

    <div class="col-md-9 offset-md-2 mt-4">

 @if(session('success')) 

  <div class="card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  

    </div>



<div class="card" style="width: 100%; height: 800px;">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      

      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Registrar nuevo socio.</label>
      </li>

     
     
   <li class="nav-item">
      <button type="submit" href="/" class="btn btn-outline-info" style="margin-left: 89%;">Regresar</button>
   </li>

</div>

  <div class="card-block">




    <div class="col-md-10  mt-4">


       	<div class="panel panel-default">
             
             <!--_______________________________ Formulario ______________________________-->

             @include('socios.formulario')


        </div>
    </div>

  </div>
</div>

@endsection

@section('titulo')

Socios 

@endsection