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
        @if($errors->has('mes'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('mes') }}</strong>
          </span>
        @endif
        <br>
        @if($errors->has('año'))
          <span class="form-control-feedback">
            <strong>{{ $errors->first('año') }}</strong>
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

  <form class="form-inline" method="POST" action="/facturas/recuento" style="margin-left: 29%;"> 
    {{ csrf_field() }}

     <label for="mes" class="col-md-auto form-control-label"><h4>Mes y año</h4></label>

                            <div class="col-md-auto ml-3">
                              <input placeholder="Mes" type="date" class="form-control" name="mes"  />
/
                              <input placeholder="Año" type="date" class="form-control" name="año"  />
                            </div>

        <span class="input-group-btn">
        <button class="btn btn-info" type="submit">Buscar</button>
        </span>

  </label>
  </form>  

  <center class="mt-3 ml-4">
    
  <a href="/facturas/index" class="mr-5">Cancelar</a>
  </center>

</div>
</div>


@endsection

@section('titulo')
    Facturación
@endsection