                             
    <!--_________________________________Persona_______________________________________-->
    
    <div class="d-inline-block col-md-5"> 


        <!--________________________________________Imagen__________________________________-->

          <div  class=" col-md-auto form-group">
            <label for="imagen" class="rm-control-label">Fotografía de socio</label>

            <div class=" col-md-auto ml-lg-5 ml-xl-5">
                <a href="/socios/showImagen/{{ $socio->id }}"> <img width="100px" class="img-thumbnail" src="{{ asset('storage/socios/'.$socio->urlImagen) }}"> </a>
            </div>
          </div>
      
          <!--_______________________________ Numero de socio ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="numeroSocio" class="rm-control-label">Número de socio</label>

                <div class=" col-md-auto ml-lg-5 ml-xl-5">
                    <input id="numeroSocio" type="text" class="form-control" name="primer_nombre" value="{{ $socio->id }}"  readonly>

                </div>
            </div>
  
    <!--_______________________________ Primer Nombre ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="primer_nombre" class=" rm-control-label">Primer nombre</label>

                <div class=" col-md-auto ml-lg-5 ml-xl-5">
                    <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}"  readonly>

                </div>
            </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 
            @if($persona->segundo_nombre !== null)
            <div  class="col-md-auto  form-group">
            <label for="segundo_nombre" class="form-control-label">Segundo nombre</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="segundo_nombre"  type="text" class="form-control" name="segundo_nombre" value="{{ $persona->segundo_nombre }}" readonly>

                </div>
            </div>
            @endif

<!--_______________________________ Primer Apellido  ______________________________-->


            <div class="col-md-auto form-group">
                <label for="primer_apellido" class="form-control-label">Primer apellido</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ $persona->primer_apellido }}" readonly>
                </div>
            </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


            <div class="col-md-auto form-group">
                <label for="segundo_apellido" class="form-control-label">Segundo apellido</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ $persona->segundo_apellido }}" readonly>
                </div>
            </div>


<!--_______________________________ Cedula  ______________________________-->


            <div class=" col-md-auto  form-group">
                <label for="cedula" class=" form-control-label">Cédula</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $persona->cedula }}" readonly>
                </div>
            </div>

    </div>
  

<div class="col-md-5 float-right ">

<!--_______________________________ Fecha de nacimiento____________________________-->


            <div  class=" col-md-auto   form-group">
                <label for="fecha_nacimiento" class="form-control-label">Fecha de nacimiento</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">


                         <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" value="{{ $persona->fecha_nacimiento }}" readonly />


                </div>
            </div>

<!--_______________________________Correo Electrónico ____________________________-->


            <div class="col-md-auto  form-group">
                <label for="email" class="from-control-label">Correo electrónico</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email }}" readonly>
                </div>
            </div>

<!--_______________________________ Número de telefono ____________________________-->

            <div  class=" col-md-auto  form-group">
                <label for="telefono" class="form-control-label">Número de telefono</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}"  readonly>
                </div>
            </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group ">
                <label for="direccion" class=" form-control-label">Dirección</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $persona->direccion }}" readonly></input>
                </div>
            </div>


<!--________________________________ Atributos socio, Empresa __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                <label for="empresa" class="ml-lg-5 ml-xl-5 form-control-label">Empresa</label>

                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $socio->empresa }}" readonly>
                </div>
            </div>

<!--________________________________ Atributos socio, Estado Civil __________________________-->

            <div class=" col-md-auto  form-group">
                <label for="estado_civil" class="form-control-label">Estado Civil</label>
                   
                <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ $socio->estado_civil }}" readonly>
                </div>

        
            </div>
<!--________________________________________ Categoria  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="categoria_id" class=" form-control-label">Categoria Socio</label>
                                
                    <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="categoria_id" type="text" class="form-control" name="categoria_id" value="{{ $categoria->categoria }}" readonly>
                    
                </div>

             
            </div>         

            <!--________________________________________ Monto Pagar  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="monto" class=" form-control-label">Monto a pagar</label>

                   
                    <div class="col-md-auto ml-lg-5 ml-xl-5">
                    <input id="monto" type="text" class="form-control" name="monto" value="{{ $categoria->precio_categoria }}" readonly>
                    
                </div>

            </div>       

</div>
