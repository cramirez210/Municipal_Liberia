@extends('layouts.app')

@section('content')

   <div class="row mt-4">

@if(session('success')) 

  <div class="card-block">
    <label class=" card-title alert alert-warning" style="width: 100%;">{{ session('success') }}</label>
  </div>

  @endif 

<div class="card" style="width: 100%; height: 800px;">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      

      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Informacion del Socio.</label>
      </li>

     <li class="nav-item dropdown " id="opciones" style="margin-left: 67%;">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/socios/show/edit/{{ $socio->id }}">Actualizar</a>

            @if($socio->estado_id == 2)
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/socios/estado/{{ $socio->id }}">Activar</a>
            @else
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="/socios/estado/{{ $socio->id }}">Inactivar</a>
            @endif
        </div>
    </li>

</div>

  <div class="card-block">




    <div class="col-md-10  mt-4">


       	<div class="panel panel-default">
             
   <!--_____________________________________ Formulario para mostrar ______________________________-->


                        
    <!--_________________________________Persona_______________________________________-->
    
    <div class="float-none" style=" width: 50%; margin-left: 10%; height: 600px"> 
  
    <!--_______________________________ Primer Nombre ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="primer_nombre" class="col-md-4 form-control-label">Primer nombre</label>

                <div class=" col-md-8 ml-5">
                    <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}"  readonly>

                </div>
            </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 

            <div  class="col-md-auto  form-group">
            <label for="segundo_nombre" class="col-md-8 form-control-label">Segundo nombre</label>

                <div class="col-md-8 ml-5 ">
                    <input id="segundo_nombre"  type="text" class="form-control" name="segundo_nombre" value="{{ $persona->segundo_nombre }}" readonly>

                </div>
            </div>


<!--_______________________________ Primer Apellido  ______________________________-->


            <div class="col-md-auto  form-group">
                <label for="primer_apellido" class="col-md-4 form-control-label">Primer apellido</label>

                <div class="col-md-8 ml-5 ">
                    <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ $persona->primer_apellido }}" readonly>
                </div>
            </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


            <div class="col-md-auto form-group">
                <label for="segundo_apellido" class="col-md-8 form-control-label">Segundo apellido</label>

                <div class="col-md-8 ml-5">
                    <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ $persona->segundo_apellido }}" readonly>
                </div>
            </div>


<!--_______________________________ Cedula  ______________________________-->


            <div class=" col-md-auto  form-group">
                <label for="cedula" class="col-md-4 form-control-label">Cédula</label>

                <div class="col-md-8 ml-5">
                    <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $persona->cedula }}" readonly>
                </div>
            </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


            <div  class=" col-md-auto   form-group">
                <label for="fecha_nacimiento" class="col-md-8 form-control-label">Fecha de nacimiento</label>

                <div class="col-md-8 ml-5">

                    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ $persona->fecha_nacimiento }}" readonly />

                </div>
            </div>

<!--_______________________________Correo Electrónico ____________________________-->


            <div class="col-md-auto  form-group">
                <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                <div class="col-md-8 ml-5">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email }}" readonly>
                </div>
            </div>




    </div>
  

<div class="float-right " style="  width: 50%; height: 600px;  margin-right: -10%; margin-top: -68%;">




<!--_______________________________ Número de telefono ____________________________-->

            <div  class=" col-md-auto  form-group">
                <label for="telefono" class="col-md-8 form-control-label">Número de telefono</label>

                <div class="col-md-8 ml-5">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}"  readonly>
                </div>
            </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group ">
                <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                <div class="col-md-8 ml-5">
                    <input id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $persona->direccion }}" readonly></input>
                </div>
            </div>


<!--________________________________ Atributos socio, Empresa __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                <label for="empresa" class="col-md-8 form-control-label">Empresa</label>

                <div class="col-md-8 ml-5">
                    <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $socio->empresa }}" readonly>
                </div>
            </div>

<!--________________________________ Atributos socio, Estado Civil __________________________-->

            <div class=" col-md-auto  form-group">
                <label for="estado_civil" class="col-md-8 form-control-label">Estado Civil</label>

                <div class="col-md-8 ml-5">
                   
                <div class="col-md-8 ml-5">
                    <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ $socio->estado_civil }}" readonly>
                </div>

                </div>
            </div>
<!--________________________________________ Categoria  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="categoria_id" class="col-md-8 form-control-label">Categoria Socio</label>

                <div class="col-md-8 ml-5">
                                
                    <div class="col-md-8 ml-5">
                    <input id="categoria_id" type="text" class="form-control" name="categoria_id" value="{{ $categoria->categoria }}" readonly>
                    
                </div>

                </div>
            </div>         

            <!--________________________________________ Precio Categoria  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="monto" class="col-md-8 form-control-label">Monto a pagar</label>

                <div class="col-md-8 ml-5">
                                
                    <div class="col-md-8 ml-5">
                    <input id="monto" type="text" class="form-control" name="monto" value="{{ $categoria->precio_categoria }}" readonly>
                    
                </div>

                </div>
            </div>           

</div>



<!--_____________________________ Botones _________________________________-->
        <div class="form-group mt-3">
            <div class="col-md-6">

                <a href="/socios/index" class="btn btn-info" style="margin-left:100%;">
                <span class="glyphicon glyphicon-remove-circle"></span>Regresar</a>

            </div>
        </div>


        </div>
    </div>

  </div>
</div>

@endsection

@section('titulo')

Mostrar socio 

@endsection