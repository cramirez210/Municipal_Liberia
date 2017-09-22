@extends('layouts.app')

@section('content')
<!--El container no se necesita por que ya se implementó-->

    <div class="row">



<div class="card mt-5" style="width: 100%; height: 800px;">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      

      <li class="nav-item">
         <h5 class="text-primary">  Usuario {{ $usuario->nombre_usuario }}</h5>
      </li>

 
  </div>
  <div class="card-block">




        <div class="col-md-10  mt-5">


            <div class="panel panel-default">
             
                   


<!--_________________________________Persona_______________________________________-->
    

<div class="float-none" style="background-color: ; 
  width: 50%; margin-left: 10%; height: 600px">
    
    <!--_______________________________ Primer Nombre ______________________________-->

                           <div  class=" col-md-auto form-group">
                            <label for="primer_nombre" class="col-md-4 form-control-label">Primer nombre</label>

                            <div class=" col-md-8 ml-5">
                                <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}" readonly>
                            </div>
                        </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 

                      <div  class="col-md-auto  form-group">

                            <label for="segundo_nombre" class="col-md-8 form-control-label">Segundo nombre</label>

                            <div class="col-md-8 ml-5 ">
                                <input id="segundo_nombre" placeholder="No posee" type="text" class="form-control" name="segundo_nombre" value="{{ $persona->segundo_nombre }}" readonly>
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

                                <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ $persona->fecha_nacimiento }}" readonly/>
 
                      
                            </div>
                        </div>
</div>


<div class="float-right " style="  width: 50%; height: 600px;  margin-right: -10%; margin-top: -68%;">

<!--_______________________________Correo Electrónico ____________________________-->


                        <div class="col-md-auto  form-group">
                            <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                            <div class="col-md-8 ml-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email }}" readonly>

                            </div>
                        </div>


<!--_______________________________ Número de telefono ____________________________-->

                     <div  class=" col-md-auto  form-group">
                            <label for="telefono" class="col-md-8 form-control-label">Número de telefono </label>

                            <div class="col-md-8 ml-5">
                                <input id="telefono"type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}" readonly>

                            </div>
                        </div>         

 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group">
                            <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                            <div class="col-md-8 ml-5">
                                <input style="height: 60px;" id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $persona->direccion }}" readonly></input>

                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class=" mt-3 col-md-auto  form-group">
                            <label for="nombre_usuario" class="col-md-8 form-control-label">Nombre de usuario</label>

                            <div class="col-md-8 ml-5">
                                <input id="nombre_usuario" type="text" class="form-control"  name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" readonly>

                              
                            </div>
                        </div>

<!--________________________________________ Roles  _________________________-->
                     <div class=" col-md-auto  form-group">
                            <label for="rol" class="col-md-8 form-control-label">Rol</label>
                            
                            <div class="col-md-8 ml-5">
                            <input id="rol" type="text" class="form-control"  name="rol" value="{{ $role->rol }}" readonly>
                            
                            </div>
                        </div>


</div>


<!--_____________________________ Botones _________________________________-->
                        <div class="form-group">
                            <div class="col-md-6 ">
                                <a href="/usuarios/home" class="btn btn-outline-primary btn-lg"  style="margin-left:100%;">
                     <span class="glyphicon glyphicon-remove-circle"></span>Regresar</a>

                            </div>
                        </div>      
        </div>
    </div>


  </div>
</div>









@endsection
