
@include('usuarios.links')
<hr>
      <!--_________________________________Persona_______________________________________-->
        <div class="d-inline-block col-md-5">
    <!--_______________________________ Primer Nombre ______________________________-->

<input id="id" type="hidden" class="form-control" name="id" value="{{ $usuario->id }}">

                           <div  class=" col-md-auto form-group">
                            <label for="primer_nombre" class=" form-control-label">Primer nombre</label>

                            <div class=" col-md-auto ml-lg-5 ml-xl-5">
                                <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $usuario->primer_nombre }}" readonly>
                            </div>
                        </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 
 @if($usuario->segundo_nombre !== null)
            <div  class="col-md-auto  form-group">
            <label for="segundo_nombre" class=" form-control-label">Segundo nombre</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="segundo_nombre"  type="text" class="form-control" name="segundo_nombre" value="{{ $usuario->segundo_nombre }}" readonly>

                </div>
            </div>
            @endif


<!--_______________________________ Primer Apellido  ______________________________-->


                     <div class="col-md-auto  form-group">

                            <label for="primer_apellido" class="form-control-label">Primer apellido</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ $usuario->primer_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


                     <div class="col-md-auto form-group">
                            <label for="segundo_apellido" class=" form-control-label">Segundo apellido</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ $usuario->segundo_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Cedula  ______________________________-->


                     <div class=" col-md-auto  form-group">
                            <label for="cedula" class=" form-control-label">Cédula</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $usuario->cedula }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


                     <div  class=" col-md-auto   form-group">
                            <label for="fecha_nacimiento" class="form-control-label">Fecha de nacimiento</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">

                                <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ $usuario->fecha_nacimiento }}" readonly/>
 
                      
                            </div>
                        </div>
</div>


<div class="col-md-5 float-right">

<!--_______________________________Correo Electrónico ____________________________-->


                        <div class="col-md-auto  form-group">
                            <label for="email" class="from-control-label">Correo electrónico</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" readonly>

                            </div>
                        </div>


<!--_______________________________ Número de telefono ____________________________-->

                     <div  class=" col-md-auto  form-group">
                            <label for="telefono" class="form-control-label">Número de telefono </label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}" readonly>

                            </div>
                        </div>         

 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group">
                            <label for="direccion" class="form-control-label">Dirección</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input style="height: 60px;" id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $usuario->direccion }}" readonly></input>

                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class=" mt-3 col-md-auto  form-group">
                            <label for="nombre_usuario" class="form-control-label">Nombre de usuario</label>

                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                                <input id="nombre_usuario" type="text" class="form-control"  name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" readonly>

                              
                            </div>
                        </div>

<!--________________________________________ Roles  _________________________-->
                     <div class=" col-md-auto  form-group">
                            <label for="rol" class="form-control-label">Rol</label>
                            
                            <div class="col-md-auto ml-lg-5 ml-xl-5">
                            <input id="rol" type="text" class="form-control"  name="rol" value="{{ $usuario->rol }}" readonly>
                            
                            </div>
                        </div>
</div>     

