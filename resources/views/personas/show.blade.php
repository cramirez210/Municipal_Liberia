@extends('layouts.app')

@section('content')
<!--El container no se necesita por que ya se implementó-->

<div class="container ml-4">

<div class="col-md-9 offset-md-2 mt-4">
        @if(session('success')) 
            <div class="card-block">
                <label class=" card-title alert alert-warning" style="width: 100%;">{{ session('success') }}</label>
            </div>
        @endif 
  </div>


<div class="card mt-5" style="width: 90%; height: 85%;">
  <div class="card-header">
    <ul class="nav nav-pills nav-fill card-header-pills">
        <li class="nav-item">
            <h5 class="text-primary">  Usuario {{ $usuario->nombre_usuario }}</h5>
        </li>
        <li class="nav-item dropdown mt-2" id="opciones">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/personas/editar/{{ $usuario->id }}">Actualizar</a>

            @if($usuario->estado_id == 2)
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuario/estado/{{ $usuario->id }}">Activar</a>
            @else
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="/usuario/estado/{{ $usuario->id }}">Inactivar</a>
            @endif


         <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuarios/socios/{{ $usuario->id }}">Ver socios relacionados</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-info" href="/usuarios/home">Regresar</a>
        </div>
    </li>

    </ul>
  </div>
  
<div class="card-block">
    <div class="container-fluid mt-4 w-100">
        <div> <!-- No tocar-->
             
<!--_________________________________Persona_______________________________________-->
        <div class="d-inline-block col-md-5">
    <!--_______________________________ Primer Nombre ______________________________-->

                           <div  class=" col-md-auto form-group">
                            <label for="primer_nombre" class="col-md-8 form-control-label">Primer nombre</label>

                            <div class=" col-md-auto ml-5">
                                <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}" readonly>
                            </div>
                        </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 
 @if($persona->segundo_nombre !== null)
            <div  class="col-md-auto  form-group">
            <label for="segundo_nombre" class="col-md-8 form-control-label">Segundo nombre</label>

                <div class="col-md-auto ml-5 ">
                    <input id="segundo_nombre"  type="text" class="form-control" name="segundo_nombre" value="{{ $persona->segundo_nombre }}" readonly>

                </div>
            </div>
            @endif


<!--_______________________________ Primer Apellido  ______________________________-->


                     <div class="col-md-auto  form-group">

                            <label for="primer_apellido" class="col-md-8 form-control-label">Primer apellido</label>

                            <div class="col-md-auto ml-5 ">
                                <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ $persona->primer_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


                     <div class="col-md-auto form-group">
                            <label for="segundo_apellido" class="col-md-8 form-control-label">Segundo apellido</label>

                            <div class="col-md-auto ml-5">
                                <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ $persona->segundo_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Cedula  ______________________________-->


                     <div class=" col-md-auto  form-group">
                            <label for="cedula" class="col-md-4 form-control-label">Cédula</label>

                            <div class="col-md-auto ml-5">
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $persona->cedula }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


                     <div  class=" col-md-auto   form-group">
                            <label for="fecha_nacimiento" class="col-md-8 form-control-label">Fecha de nacimiento</label>

                            <div class="col-md-auto ml-5">

                                <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ $persona->fecha_nacimiento }}" readonly/>
 
                      
                            </div>
                        </div>
</div>


<div class="col-md-5 float-right">

<!--_______________________________Correo Electrónico ____________________________-->


                        <div class="col-md-auto  form-group">
                            <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                            <div class="col-md-auto ml-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email }}" readonly>

                            </div>
                        </div>


<!--_______________________________ Número de telefono ____________________________-->

                     <div  class=" col-md-auto  form-group">
                            <label for="telefono" class="col-md-8 form-control-label">Número de telefono </label>

                            <div class="col-md-auto ml-5">
                                <input id="telefono"type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}" readonly>

                            </div>
                        </div>         

 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group">
                            <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                            <div class="col-md-auto ml-5">
                                <input style="height: 60px;" id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $persona->direccion }}" readonly></input>

                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class=" mt-3 col-md-auto  form-group">
                            <label for="nombre_usuario" class="col-md-8 form-control-label">Nombre de usuario</label>

                            <div class="col-md-auto ml-5">
                                <input id="nombre_usuario" type="text" class="form-control"  name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" readonly>

                              
                            </div>
                        </div>

<!--________________________________________ Roles  _________________________-->
                     <div class=" col-md-auto  form-group">
                            <label for="rol" class="col-md-8 form-control-label">Rol</label>
                            
                            <div class="col-md-auto ml-5">
                            <input id="rol" type="text" class="form-control"  name="rol" value="{{ $role->rol }}" readonly>
                            
                            </div>
                        </div>


</div>


<!--_____________________________ Botones _________________________________-->
                        <center class="form-group mt-3">
                            <div class="row-fluid">
                                <a href="/usuarios/home" class="btn btn-info btn-lg">
                     <span class="glyphicon glyphicon-remove-circle"></span>Regresar</a>

                            </div>
                        </Center>      
        </div>

        </div>    
    </div>

</div>









@endsection
