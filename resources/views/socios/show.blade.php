@extends('layouts.app')

@section('content')

<div class="container ml-5">

    <div class="col-md-9 offset-md-2 mt-4">
        @if(session('success')) 
            <div class="card-block">
                <label class=" card-title alert alert-warning" style="width: 100%;">{{ session('success') }}</label>
            </div>
        @endif 
  </div>


<div class="card" style="width: 90%; height: 85%;">

  <div class="card-header">
    
    <ul class="nav nav-pills nav-fill card-header-pills">  
      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Informacion del Socio.</label>
      </li>

     <li class="nav-item dropdown mt-2" id="opciones">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/socios/show/edit/{{ $socio->id }}">Actualizar</a>

            @if($socio->estado_id == 2)
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/socios/estado/{{ $socio->id }}">Activar</a>
            @else
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="/socios/estado/{{ $socio->id }}">Inactivar</a>
            @endif

            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-info" href="/socios/index">Regresar</a>
        </div>
    </li>

</div>

  <div class="card-block">

    <div class="container-fluid mt-4 w-100">

       	<div> <!--No tocar-->
                                     
    <!--_________________________________Persona_______________________________________-->
    
    <div class="d-inline-block col-md-5"> 


        <!--________________________________________Imagen__________________________________-->

          <div  class=" col-md-auto form-group">
            <label for="imagen" class="col-md-8 rm-control-label">Fotografía de socio</label>

                <div class=" col-md-auto ml-5">
                      <a href="/socios/showImagen/{{ $socio->id }}"> <img width="100px" class="img-thumbnail" src="/storage/{{ $socio->urlImagen }}"> </a>
                </div>
            </div>
      
          <!--_______________________________ Numero de socio ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="numeroSocio" class="col-md-8 rm-control-label">Número de socio</label>

                <div class=" col-md-auto ml-5">
                    <input id="numeroSocio" type="text" class="form-control" name="primer_nombre" value="{{ $persona->id }}"  readonly>

                </div>
            </div>
  
    <!--_______________________________ Primer Nombre ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="primer_nombre" class="col-md-8 rm-control-label">Primer nombre</label>

                <div class=" col-md-auto ml-5">
                    <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $persona->primer_nombre }}"  readonly>

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


            <div class="col-md-auto form-group">
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

<!--_______________________________ Cedula  ______________________________-->

<!-- 
            <div class=" col-md-auto  form-group">
                <label for="ejecutivo" class="col-md-4 form-control-label">Ejecutivo a cargo</label>

                <div class="col-md-auto ml-5">
                    <input id="ejecutivo" type="text" class="form-control" name="ejecutivo" value="{{ $persona->ejecutivo }}" readonly>
                </div>
            </div>

 -->

    </div>
  

<div class="col-md-5 float-right ">

<!--_______________________________ Fecha de nacimiento____________________________-->


            <div  class=" col-md-auto   form-group">
                <label for="fecha_nacimiento" class="col-md-8 form-control-label">Fecha de nacimiento</label>

                <div class="col-md-auto ml-5">

                    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"  value="{{ $persona->fecha_nacimiento }}" readonly />

                </div>
            </div>

<!--_______________________________Correo Electrónico ____________________________-->


            <div class="col-md-auto  form-group">
                <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                <div class="col-md-auto ml-5">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email }}" readonly>
                </div>
            </div>

<!--_______________________________ Número de telefono ____________________________-->

            <div  class=" col-md-auto  form-group">
                <label for="telefono" class="col-md-8 form-control-label">Número de telefono</label>

                <div class="col-md-auto ml-5">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $persona->telefono }}"  readonly>
                </div>
            </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group ">
                <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                <div class="col-md-auto ml-5">
                    <input id="direccion" type="textarea" class="form-control" name="direccion" value="{{ $persona->direccion }}" readonly></input>
                </div>
            </div>


<!--________________________________ Atributos socio, Empresa __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                <label for="empresa" class="col-md-8 form-control-label">Empresa</label>

                <div class="col-md-auto ml-5">
                    <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $socio->empresa }}" readonly>
                </div>
            </div>

<!--________________________________ Atributos socio, Estado Civil __________________________-->

            <div class=" col-md-auto  form-group">
                <label for="estado_civil" class="col-md-8 form-control-label">Estado Civil</label>
                   
                <div class="col-md-auto ml-5">
                    <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ $socio->estado_civil }}" readonly>
                </div>

        
            </div>
<!--________________________________________ Categoria  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="categoria_id" class="col-md-8 form-control-label">Categoria Socio</label>
                                
                    <div class="col-md-auto ml-5">
                    <input id="categoria_id" type="text" class="form-control" name="categoria_id" value="{{ $categoria->categoria }}" readonly>
                    
                </div>

             
            </div>         

            <!--________________________________________ Monto Pagar  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="monto" class="col-md-8 form-control-label">Monto a pagar</label>

                   
                    <div class="col-md-auto ml-5">
                    <input id="monto" type="text" class="form-control" name="monto" value="{{ $categoria->precio_categoria }}" readonly>
                    
                </div>

            </div>  

            <!--________________________________________ Estado  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="monto" class="col-md-8 form-control-label">Estado</label>
   
                    <div class="col-md-auto ml-5">
                    <input id="monto" type="text" class="form-control" name="monto" value="{{ $estado->estado }}" readonly>
                    
                </div>

            </div>         

</div>



<!--_____________________________ Botones _________________________________-->
        <center class="form-group mt-3">
            <div class="row-fluid">

                <a href="/socios/index" class="btn btn-info">
                <span class="glyphicon glyphicon-remove-circle"></span>Regresar</a>

            </div>
        </center>


        </div>
    </div>

  </div>
</div>

@endsection

@section('titulo')

Mostrar socio 

@endsection