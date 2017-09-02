 
@extends('layouts.app')

@section('content')



<div class="row mb-5">


        <div class="col-md-8 offset-md-2 mt-4">

        <h2>Registrar nueva persona</h2>
        <br>

            <div class="panel panel-default">
        
                    <form class="form-horizontal" method="POST" action="{{ url('/registro_personas') }}">
                        {{ csrf_field() }}


<!--_______________________________ Primer Nombre ______________________________-->

                           <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="primer_nombre" class="col-md-4 form-control-label">Primer nombre</label>

                            <div class="col-md-6">
                                <input id="primer_nombre" placeholder="Ejemplo: Carlos" type="text" class="form-control" name="primer_nombre" value="{{ old('primer_nombre') }}" required autofocus>

                                @if ($errors->has('primer_nombre'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('primer_nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--_______________________________ Segundo Nombre ______________________________-->


                      <div class="form-group{{ $errors->has('segundo_nombre') ? ' has-danger' : '' }}">
                            <label for="segundo_nombre" class="col-md-4 form-control-label">Segundo nombre</label>

                            <div class="col-md-6">
                                <input id="segundo_nombre" placeholder="Ejemplo: Andrés, opcional*" type="text" class="form-control" name="segundo_nombre" value="{{ old('segundo_nombre') }}">

                                @if ($errors->has('segundo_nombre'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('segundo_nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!--_______________________________ Primer Apellido  ______________________________-->


                     <div class="form-group{{ $errors->has('primer_apellido') ? ' has-danger' : '' }}">
                            <label for="primer_apellido" class="col-md-4 form-control-label">Primer apellido</label>

                            <div class="col-md-6">
                                <input id="primer_apellido" type="text" class="form-control" placeholder="Ejemplo: Ramírez" name="primer_apellido" value="{{ old('primer_apellido') }}" required autofocus>

                                @if ($errors->has('primer_apellido'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('primer_apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


                     <div class="form-group{{ $errors->has('segundo_apellido') ? ' has-danger' : '' }}">
                            <label for="segundo_apellido" class="col-md-4 form-control-label">Segundo apellido</label>

                            <div class="col-md-6">
                                <input id="segundo_apellido" placeholder="Ejemplo: Zúñiga" type="text" class="form-control" name="segundo_apellido" value="{{ old('segundo_apellido') }}" required autofocus>

                                @if ($errors->has('segundo_apellido'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('segundo_apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!--_______________________________ Cedula  ______________________________-->


                     <div class="form-group{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                            <label for="cedula" class="col-md-4 form-control-label">Cédula</label>

                            <div class="col-md-6">
                                <input id="cedula" placeholder="Ejemplo: 101110111" type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" required autofocus>

                                @if ($errors->has('cedula'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


                     <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-danger' : '' }}">
                            <label for="fecha_nacimiento" class="col-md-4 form-control-label">Fecha de nacimiento</label>

                            <div class="col-md-6">

                                <input type="date" id="fecha_nacimiento" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autofocus>


                                @if ($errors->has('fecha_nacimiento'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--_______________________________Correo Electrónico ____________________________-->


                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-md-4 from-control-label">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Ejemplo: carlos@hotmail.com" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="from-control-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<!--_______________________________ Número de telefono ____________________________-->


                     <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                            <label for="telefono" class="col-md-4 form-control-label">Número de telefono </label>

                            <div class="col-md-6">
                                <input id="telefono" placeholder="Ejemplo: 87654321"type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required autofocus>

                                @if ($errors->has('telefono'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                            <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                            <div class="col-md-6">
                                <textarea id="direccion" type="textarea" placeholder="Ejemplo: Guanacaste, Liberia, del parque central 300m sur ..." class="form-control" name="direccion" value="{{ old('direccion') }}" required autofocus></textarea>

                                @if ($errors->has('direccion'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<!--_______________________________ Botón _____________________________-->


                <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Registrar persona
                                </button>
                            </div>
                        </div>



                    </form>

            </div>
        </div>

    </div>


@endsection

@section('titulo')
Nueva persona 

@endsection