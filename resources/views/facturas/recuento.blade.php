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
    <b class="ml-5">Filtro de Busqueda</b> 
  </div>

  <div class="card-block">

  <form class="form col-md-6" method="POST" action="/facturas/recuento" style="margin-left: 29%;"> 
    {{ csrf_field() }}

     <label class="col-md-auto form-control-label"><h4>Desde</h4></label>

                            <div class="col-md-auto ml-3">
                              <div class="form-group">
                                <input placeholder="Ejemplo: 1997-09-06" type="text" class="form-control" id="desde" name="desde" />
                              </div>
                              
                            </div>
    <label class="col-md-auto form-control-label mt-3"><h4>Hasta</h4></label>

                            <div class="col-md-auto ml-3">
                              <div class="form-group">
                                <input placeholder="Ejemplo: 2010-09-06" type="text" class="form-control" id="hasta" name="hasta" />
                              </div>
                              
                            </div>

        <span class="col-md-3 ml-5 mt-5">
        <button class="btn btn-info d-inline-block ml-4 mt-3" type="submit">Buscar</button>
        <a href="/facturas/index" class="btn btn-warning d-inline-block mt-3 mr-5">Cancelar</a>
        </span>

        <script>
                    $('#desde').datepicker({ uiLibrary: 'bootstrap4',format: "yyyy-mm-dd",language: "es",iconsLibrary: 'fontawesome',});
                    $('#hasta').datepicker({ uiLibrary: 'bootstrap4',format: "yyyy-mm-dd",language: "es",iconsLibrary: 'fontawesome',});
                    </script>
  </form>  

  <center class="mt-3 ml-4">
    
  
  </center>

</div>
</div>


@endsection

@section('titulo')
    Facturación
@endsection