@extends('layouts.app')

@section('content')

@include('mensajes.alertas') 

    @if(count($errors))
<div> 
<br>
<span class="text-danger mt-4">
        @if($errors->has('desde'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('desde') }}</strong>
          </span>
        @endif
        <br>
        @if($errors->has('hasta'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('hasta') }}</strong>
          </span>
        @endif
    </span>
</div>
@endif

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>


  
 <div class="card-body">

    <center>

  <form class="form col-md-6" method="POST" action="/cobros/recuento"> 
    {{ csrf_field() }}

    @include('layouts.filtrar_fechas')
    
        <button class="btn btn-success fa fa-check system-icons" type="submit"> Buscar</button>
        <a href="/cobros/index" class="btn btn-danger fa fa-times system-icons "> Cancelar</a>

  </form>  
</center>
</div>



</div>


@endsection

@section('titulo')
    Cobros
@endsection