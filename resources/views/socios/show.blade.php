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
             
   <!--_____________________________________ Formulario para mostrar ______________________________-->

<form class="form-horizontal" method="POST" action="/socios/create">
                        
    {{ csrf_field() }}

    <!--_________________________________Persona_______________________________________-->
    
    <div class="float-none" style=" width: 50%; margin-left: 10%; height: 600px"> 
  
    <!--_______________________________ Primer Nombre ______________________________-->

            <div  class=" col-md-auto form-group">
            <label for="primer_nombre" class="col-md-4 form-control-label">Primer nombre</label>

                <div class=" col-md-8 ml-5">
                    <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{  }}"  readonly>

                </div>
            </div>

<!--_______________________________ Segundo Nombre ______________________________-->
 

            <div  class="col-md-auto  form-group">
            <label for="segundo_nombre" class="col-md-8 form-control-label">Segundo nombre</label>

                <div class="col-md-8 ml-5 ">
                    <input id="segundo_nombre"  type="text" class="form-control" name="segundo_nombre" value="{{  }}" readonly>

                </div>
            </div>


<!--_______________________________ Primer Apellido  ______________________________-->


            <div class="col-md-auto  form-group">
                <label for="primer_apellido" class="col-md-4 form-control-label">Primer apellido</label>

                <div class="col-md-8 ml-5 ">
                    <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ }}" readonly>
                </div>
            </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


            <div class="col-md-auto form-group">
                <label for="segundo_apellido" class="col-md-8 form-control-label">Segundo apellido</label>

                <div class="col-md-8 ml-5">
                    <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{  }}" readonly>
                </div>
            </div>


<!--_______________________________ Cedula  ______________________________-->


            <div class=" col-md-auto  form-group">
                <label for="cedula" class="col-md-4 form-control-label">Cédula</label>

                <div class="col-md-8 ml-5">
                    <input id="cedula" type="text" class="form-control" name="cedula" value="{{  }}" readonly>
                </div>
            </div>


<!--_______________________________ Fecha de nacimiento____________________________-->


            <div  class=" col-md-auto   form-group">
                <label for="fecha_nacimiento" class="col-md-8 form-control-label">Fecha de nacimiento</label>

                <div class="col-md-8 ml-5">

                    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" width="276" value="{{ }}" readonly />

                </div>
            </div>

<!--_______________________________Correo Electrónico ____________________________-->


            <div class="col-md-auto  form-group">
                <label for="email" class="col-md-8 from-control-label">Correo electrónico</label>

                <div class="col-md-8 ml-5">
                    <input id="email" type="email" class="form-control" name="email" value="{{ }}" readonly>
                </div>
            </div>




    </div>
  

<div class="float-right " style="  width: 50%; height: 600px;  margin-right: -10%; margin-top: -68%;">




<!--_______________________________ Número de telefono ____________________________-->

            <div  class=" col-md-auto  form-group">
                <label for="telefono" class="col-md-8 form-control-label">Número de telefono</label>

                <div class="col-md-8 ml-5">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ }}"  readonly>
                </div>
            </div>         


 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group ">
                <label for="direccion" class="col-md-4 form-control-label">Dirección</label>

                <div class="col-md-8 ml-5">
                    <textarea id="direccion" type="textarea" class="form-control" name="direccion" value="{{ }}" readonly></textarea>
                </div>
            </div>


<!--________________________________ Atributos socio, Empresa __________________________-->

            <div class=" col-md-auto  form-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                <label for="empresa" class="col-md-8 form-control-label">Empresa</label>

                <div class="col-md-8 ml-5">
                    <input id="empresa" type="text" class="form-control" name="empresa" value="{{ }}" readonly>
                </div>
            </div>

<!--________________________________ Atributos socio, Estado Civil __________________________-->

            <div class=" col-md-auto  form-group">
                <label for="estado_civil" class="col-md-8 form-control-label">Estado Civil</label>

                <div class="col-md-8 ml-5">
                   
                <div class="col-md-8 ml-5">
                    <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ }}" readonly>
                </div>

                </div>
            </div>
<!--________________________________________ Categoria  _________________________-->
            <div class=" col-md-auto  form-group">
                <label for="categoria_id" class="col-md-8 form-control-label">Categoria Socio</label>

                <div class="col-md-8 ml-5">
                                
                    <div class="col-md-8 ml-5">
                    <input id="categoria_id" type="text" class="form-control" name="categoria_id" value="{{ }}" readonly>
                    
                </div>

                </div>
            </div>            

</div>

<!--_____________________________ Botones _________________________________-->
        <div class="form-group mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success" style="margin-left:100%;">
                                    Registrar
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

Mostrar socio 

@endsection