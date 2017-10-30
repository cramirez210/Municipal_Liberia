@extends('layouts.app')

@section('content')

<div class="container ml-5">

    <div class="col-md-9 offset-md-2 mt-4">
        @if(session('success')) 
            <div class="card-block">
                <label class=" card-title alert alert-warning" style="width: 100%;">{{ session('success') }}</label>
            </div>
        @endif 
  </div>


<div class="card" style="width: 90%; height: 85%;">

  <div class="card-header">
    
    <ul class="nav nav-pills nav-fill card-header-pills">  
      <li class="nav-item">
        <label class="nav-link text-primary" href="#"><h3>Fotografía del socio</h3></label>
      </li>

</div>

  <div class="card-block">

    <div class="container-fluid mt-4 w-100">

       	<div> <!--No tocar-->
                                     
    <!--_________________________________Persona_______________________________________-->

     <div class="text-primary ">Socio: {{ $socio->persona->primer_nombre }} {{ $socio->persona->segundo_nombre }} {{ $socio->persona->primer_apellido }} {{ $socio->persona->segundo_apellido }}</div>
    <center><img class="img-thumbnail mt-2" src="{{ asset('storage/socios/'.$socio->urlImagen) }}"></center>
                

<!--_____________________________ Botones _________________________________-->
        <center class="form-group mt-3">
            <div class="row-fluid">

                <a href="{{ URL::previous() }}" class="btn btn-info">
                <span class="glyphicon glyphicon-remove-circle"></span>Regresar</a>

            </div>
        </center>


        </div>
    </div>

  </div>
</div>

@endsection

@section('titulo')

Mostrar socio 

@endsection