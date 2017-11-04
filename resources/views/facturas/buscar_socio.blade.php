@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

  @if(count($errors))
<div>
<br>
<span class="text-danger mt-4">
        @if($errors->has('valor'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('valor') }}</strong>
          </span>
        @endif
        <br>
        @if($errors->has('Criterio'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('Criterio') }}</strong>
          </span>
        @endif
    </span>
</div>
@endif 

	<!-- Si la sesión tiene algo guardado, muestrelo -->
<div class="card text-center mt-4">
  <div class="card-header text-primary">
    <div class="card-tittle">
      <b>Buscar socio</b>
    </div> 
  </div>

  <div class="card-block">

  <form method="GET" action="/facturas/create" > 
    {{ csrf_field() }}

  <select class="custom-select mb-1" name="Criterio">
    <option selected value="1">Numero de Socio</option>
    <option value="2">Cédula</option>
  </select>

  <label>
        <input type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>
  
     
        <button class="btn btn-success mb-1" type="submit">Buscar</button>
        <a href="/facturas/index" class="btn btn-danger mb-1">Cancelar</a>
        
       
  </form>  
</div>
</div>



@endsection

@section('titulo')
    Facturación
@endsection