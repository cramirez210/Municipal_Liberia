@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

             @if(session('success'))
              <div class="card-block">
                <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
              </div>
              @endif 

           </div>

              <div class="card" style="width: 100%; height: 530px;">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item">
                       <h5 class="text-primary">Detalle de factura</h5>
                    </li>
                  
                    <li class="nav-item">
                      <button type="submit" class="btn btn-outline-info" style="margin-left: 89%;">
                                                  Regresar
                                              </button>
                      </li>

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
                                <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ $factura->primer_nombre }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Primer Apellido  ______________________________-->


                     <div class="col-md-auto  form-group">

                            <label for="primer_apellido" class="col-md-8 form-control-label">Primer apellido</label>

                            <div class="col-md-auto ml-5 ">
                                <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ $factura->primer_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Segundo Apellido  ______________________________-->


                     <div class="col-md-auto form-group">
                            <label for="segundo_apellido" class="col-md-8 form-control-label">Segundo apellido</label>

                            <div class="col-md-auto ml-5">
                                <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ $factura->segundo_apellido }}" readonly>
                            </div>
                        </div>


<!--_______________________________ Cedula  ______________________________-->


                     <div class=" col-md-auto  form-group">
                            <label for="socio_id" class="col-md-4 form-control-label">N° de socio</label>

                            <div class="col-md-auto ml-5">
                                <input id="socio_id" type="text" class="form-control" name="socio_id" value="{{ $factura->socio_id }}" readonly>
                            </div>
                        </div>
</div>


<div class="col-md-5 float-right">

<!--_______________________________Correo Electrónico ____________________________-->


                        <div class="col-md-auto  form-group">
                            <label for="factura_id" class="col-md-8 from-control-label">N° de factura</label>

                            <div class="col-md-auto ml-5">
                                <input id="factura_id" type="text" class="form-control" name="factura_id" value="{{ $factura->id }}" readonly>

                            </div>
                        </div>

<!--_______________________________ Fecha de factura____________________________-->


                     <div  class=" col-md-auto   form-group">
                            <label for="created_at" class="col-md-8 form-control-label">Fecha de factura</label>

                            <div class="col-md-auto ml-5">

                                <input type="text" class="form-control" id="created_at" name="created_at" width="276" value="{{ $factura->created_at }}" readonly/>
                            </div>
                        </div>


<!--_______________________________ Número de telefono ____________________________-->

                     <div  class=" col-md-auto  form-group">
                            <label for="monto" class="col-md-8 form-control-label">Monto </label>

                            <div class="col-md-auto ml-5">
                                <input id="monto" type="text" class="form-control" name="monto" value="{{ $factura->monto }}" readonly>

                            </div>
                        </div>         

 <!--_______________________________ Dirección____________________________-->

            <div class="col-md-auto  form-group">
                            <label for="nombre_usuario" class="col-md-4 form-control-label">Cobrador</label>

                            <div class="col-md-auto ml-5">
                                <input style="height: 60px;" id="nombre_usuario" type="textarea" class="form-control" name="nombre_usuario" value="{{ $factura->nombre_usuario }}" readonly></input>

                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class=" mt-3 col-md-auto  form-group">
                            <label for="updated_at" class="col-md-8 form-control-label">Fecha de cobro</label>

                            <div class="col-md-auto ml-5">
                                <input id="updated_at" type="text" class="form-control"  name="updated_at" value="{{ $factura->updated_at }}" readonly>

                              
                            </div>
                        </div>

<!--________________________________ Nombre de usuario __________________________-->

                        <div class=" mt-3 col-md-auto  form-group">
                            <label for="forma_pago" class="col-md-8 form-control-label">Forma de pago</label>

                            <div class="col-md-auto ml-5">
                                <input id="forma_pago" type="text" class="form-control"  name="forma_pago" value="{{ $factura->forma_pago }}" readonly>
                            </div>
                        </div>
</div>


                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-success btn-lg" style="margin-left:100%;">
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
