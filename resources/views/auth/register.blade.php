@extends('layouts.app')

@section('content')
<!--El container no se necesita por que ya se implementó-->

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
            <div class="panel panel-default">
             
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


<!--______________________________ Usuario _________________________________-->


    <div class="form-group{{ $errors->has('cedula_persona') ? ' has-danger' : '' }}">
                            <label for="cedula_persona" class="col-md-4 form-control-label">Cédula de la persona</label>

                            <div class="col-md-6">

                              <input id="cedula_persona" type="text" class="form-control" name="id_persona" value="{{ old('cedula_persona') }}" required autofocus>

                                @if ($errors->has('cedula_persona'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('cedula_persona') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class="form-group{{ $errors->has('nombre_usuario') ? ' has-danger' : '' }}">
                            <label for="nombre_usuario" class="col-md-4 form-control-label">Nombre de usuario</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required autofocus>

                                @if ($errors->has('nombre_usuario'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('nombre_usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--________________________________________ Contraseñas _________________________-->
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-md-4 form-control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 form-control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


<!--_____________________________ Botones _________________________________-->
                        <div class="form-group">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>

@endsection
