@extends('layouts.app')

@section('content')


	@if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

  @endif  

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

  <div class="card-block">

  <form class="form col-md-6" method="POST" action="/cobros/recuento" style="margin-left: 29%;"> 
    {{ csrf_field() }}

    @include('layouts.filtrar_fechas')
    
        <span class="col-md-3 ml-5 mt-5">
        <button class="btn btn-info d-inline-block ml-4 mt-3" type="submit">Buscar</button>
        <a href="/cobros/index" class="btn btn-warning d-inline-block mt-3 mr-5">Cancelar</a>
        </span>
  </form>  

</div>
</div>


@endsection

@section('titulo')
    Cobros
@endsection