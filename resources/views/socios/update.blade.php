@extends('layouts.app')

@section('content')

   <div class="row">

    <div class="col-md-9 offset-md-2 mt-4">

 @if(session('success')) 

  <div class="card-block">
    <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif  

    </div>



<div class="card" style="width: 100%; height: 800px;">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      

      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Registrar nuevo socio.</label>
      </li>

     
     
   <li class="nav-item">
      <button type="submit" href="/" class="btn btn-outline-info" style="margin-left: 89%;">Regresar</button>
   </li>

</div>

  <div class="card-block">




    <div class="col-md-10  mt-4">


       	<div class="panel panel-default">
             
             <!--_______________________________ Formulario ______________________________-->

             
<form class="form-horizontal" method="POST" action="/socios/create">
                        
    {{ csrf_field() }}

    <!--_________________________________Persona_______________________________________-->
    
    <div class="float-none" style=" width: 50%; margin-left: 10%; height: 600px"> 
  
    <!--_______________________________ Primer Nombre ______________________________-->

            <div  class=" col-md-auto form-group @if($errors->has('primer_nombre')) has-danger @endif">
            <label for="primer_nombre" class="col-md-4 form-control-label">Primer nombre</label>

                <div class=" col-md-8 ml-5">
                    <input id="primer_nombre" placeholder="Ejemplo: Carlos" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}" required autofocus>

                    @if($errors->has('primer_nombre'))
                        <span class="form-control-feedback">
                             <strong>{{ $errors->first('primer_nombre') }}</strong>
                        </span>
                    @endif
                        
                </div>
            </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 

            <div  class="col-md-auto  form-group{{ $errors->has('segundo_nombre') ? ' has-danger' : '' }}">
            <label for="segundo_nombre" class="col-md-8 form-control-label">Segundo nombre</label>

                <div class="col-md-8 ml-5 ">
                    <input id="segundo_nombre" placeholder="Ejemplo: Andrés, opcional*" type="text" class="form-control" name="segundo_nombre" value="{{ $persona->segundo_nombre }}">

                    @if ($errors->has('segundo_nombre'))
                        <span class="form-control-feedback">
                            <strong>{{ $errors->first('segundo_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


<!--_______________________________ Primer Apellido  ______________________________-->


            <div class="col-md-auto  form-group{{ $errors->has('primer_apellido') ? ' has-danger' : '' }}">
                <label for="primer_apellido" class="col-md-4 form-control-label">Primer apellido</label>

                <div class="col-md-8 ml-5 ">
                    <input id="primer_apellido" type="text" class="form-control" placeholder="Ejemplo: Ramírez" name="primer_apellido" value="{{ $persona->primer_apellido }}" required autofocus>

                        @if ($errors->has('primer_apellido'))
                            <span class="form-control-feedback">
                                <strong>{{ $errors->first('primer_apellido') }}</strong>
                            </span>
                        @endif
                </div>
            </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


            <div class="col-md-auto form-group{{ $errors->has('segundo_apellido') ? ' has-danger' : '' }}">
                <label for="segundo_apellido" class="col-md-8 form-control-label">Segundo apellido</label>

                <div class="col-md-8 ml-5">
                    <input id="segundo_apellido" placeholder="Ejemplo: Zúñiga" type="text" class="form-control" name="segundo_apellido" value="{{ $persona->segundo_apellido }}" required autofocus>

                    @if ($errors->has('segundo_apellido'))
                        <span class="form-control-feedback">
                            <strong>{{ $errors->first('segundo_apellido') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


<!--_______________________________ Cedula  ______________________________-->


            <div class=" col-md-auto  form-group{{ $errors->has('cedula') ? ' has-danger' : '' }}">
                <label for="cedula" class="col-md-4 form-control-label">Cédula</label>

                <div class="col-md-8 ml-5">
                    <input id="cedula" placeholder="Ejemplo: 101110111" type="text" class="form-control" name="cedula" value="{{ $persona->cedula }}" required autofocus>

                        @if ($errors->has('cedula'))
                            <span class="form-control-feedback">
                                <strong>{{ $errors->first('cedula') }}</strong>
                            </span>
                        @endif
                </div>
            </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


            <div  class=" col-md-auto   form-group{{ $errors->has('fecha_nacimiento') ? ' has-danger' : '' }}">
                <label for="fecha_nacimiento" class="col-md-8 form-control-label">Fecha de nacimiento</label>

                <div class="col-md-8 ml-5">

                    <input placeholder="2017-09-06" type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ $persona->fecha_nacimiento }}" />
                    <script>
                    $('#fecha_nacimiento').datepicker({ uiLibrary: 'bootstrap4',format: "yyyy-mm-dd",language: "es",iconsLibrary: 'fontawesome',});
                    </script>
                 
   
                        @if ($errors->has('fecha_nacimiento'))
                            <span class="form-control-feedback">
                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

<!--_______________________________Correo Electrónico ____________________________-->


            <div class="col-md-auto  form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                <div class="col-md-8 ml-5">
                    <input id="email" type="email" placeholder="Ejemplo: carlos@hotmail.com" class="form-control" name="email" value="{{ $persona->email }}" required>

                        @if ($errors->has('email'))
                            <span class="from-control-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

    </div>
  

<div class="float-right " style="  width: 50%; height: 600px;  margin-right: -10%; margin-top: -68%;">




<!--_______________________________ Número de telefono ____________________________-->

            <div  class=" col-md-auto  form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                <label for="telefono" class="col-md-8 form-control-label">Número de telefono </label>

                <div class="col-md-8 ml-5">
                    <input id="telefono" placeholder="Ejemplo: 87654321"type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}" required autofocus>

                    @if ($errors->has('telefono'))
                        <span class="form-control-feedback">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>
            </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class=col-md-auto  form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                <div class="col-md-8 ml-5">
                    <textarea id="direccion" type="textarea" placeholder="Ejemplo: Guanacaste, Liberia, del parque central 300m sur ..." class="form-control" name="direccion" value="{{ persona->direccion }}" required autofocus></textarea>

                        @if ($errors->has('direccion'))
                            <span class="form-control-feedback">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                </div>
            </div>


<!--________________________________ Atributos socio, Empresa __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                <label for="empresa" class="col-md-8 form-control-label">Empresa</label>

                <div class="col-md-8 ml-5">
                    <input id="empresa" type="text" class="form-control" placeholder="Ejemplo: Banco Nacional" name="empresa" value="{{ socio->empresa }}" required autofocus>

                        @if ($errors->has('empresa'))
                            <span class="form-control-feedback">
                                <strong>{{ $errors->first('empresa') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

<!--________________________________ Atributos socio, Estado Civil __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('estado_civil') ? ' has-danger' : '' }}">
                <label for="estado_civil" class="col-md-8 form-control-label">Estado Civil</label>

                <div class="col-md-8 ml-5">
                   
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="estadoCivilOption" name="estado_civil">
                      
                        @if( {{socio->estado_civil }} == 'Solteros')
                        <option selected>Solteros</option>
                        <option>Casados</option>

                        @else

                        <option>Solteros</option>
                        <option selected>Casados</option>

                        @endif
                    </select>

                </div>
            </div>

<!--________________________________________ Categoria  _________________________-->
            <div class=" col-md-auto  form-group{{ $errors->has('categoria_id') ? ' has-danger' : '' }}">
                <label for="categoria_id" class="col-md-8 form-control-label">Categoria Socio</label>

                <div class="col-md-8 ml-5">
                                
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoriaOption" name="categoria_id">
                        
                    <option selected>{{ $socio->categoria }}</option>

                    @forelse($categorias as $categoria)

                        <option>{{ $categoria->categoria }}</option>
                
                    @endforelse

                    </select>

                </div>
            </div>            

</div>

<!--_____________________________ Botones _________________________________-->
        <div class="form-group mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success" style="margin-left:100%;">
                                    Actualizar
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

Actualizar socio

@endsection