@extends('layouts.app')

@section('content')


	@if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

  @endif  

	<!-- Si la sesión tiene algo guardado, muestrelo -->

<div class="card text-center mt-4">
  <div class="card-header text-primary">
    Filtro de Busqueda
  </div>

  <div class="card-block">

  <form class="form-inline" method="POST" action="/cobros/recuento/buscar" style="margin-left: 29%;"> 
    {{ csrf_field() }}

     <label for="mes" class="col-md-auto form-control-label"><h4>Mes y año</h4></label>

                            <div class="col-md-auto ml-3">
                              <input placeholder="Mes" type="date" class="form-control" name="mes"  />
/
                              <input placeholder="Año" type="date" class="form-control" name="anio"  />
                            </div>

        <span class="input-group-btn">
        <button class="btn btn-info" type="submit">Buscar</button>
        </span>

  </label>
  </form>  

</div>
</div>


@endsection

@section('titulo')
    Facturación
@endsection