@extends('layouts.app')

@section('content')

    <div class="row">


        <div class="col-md-8 offset-md-1 mt-5 container">
            <div class="panel panel-default">

                <div class="col-md-8" style="max-width: 50rem;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>

        <div class="card border-success  offset-md-1 mt-3" style="max-width: 50rem; max-height: 80rem;">

             <div class="card-header">Solicitud de cambio de contraseña</div>
  <div class="card-body ">

    <div class="container">
        
         <form class="form-horizontal mt-3" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger ">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Enviar correo de confirmación
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
  
  </div> 
    </div>



    </div>

@endsection

@section('titulo')

Cambio de contraseña

@endsection