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
                       <h5 class="text-primary">Registrar nueva factura</h5>
                    </li>
                  
                    <li class="nav-item">
                      <button type="submit" class="btn btn-outline-info" style="margin-left: 89%;">
                                                  Regresar
                                              </button>
                      </li>

                </div>

              <div class="card-block">

                <div class="col-md-10  mt-5">

            <div class="panel panel-default">
            
                    <form class="form-horizontal" action="/facturas/update/{{$factura->id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-none" style="background-color: ;
              width: 50%; margin-left: 10%; height: 330px">


              <fieldset disabled>
                      <div class="form-group">
                        <label for="factura_id" class="col-md-5 from-control-label">Número de factura
                        </label>
                          <div class="col-md-4 ml-5">
                            <input type="text" id="factura_id" class="form-control" value="{{$factura->id}}">
                           </div>
                       </div>
                  </fieldset>

                  <fieldset disabled>
                      <div class="form-group">
                        <label for="socio_id" class="col-md-5 from-control-label">Número de socio
                        </label>
                          <div class="col-md-4 ml-5">
                            <input type="text" id="socio_id" class="form-control" value="{{$factura->socio_id}}">
                           </div>
                       </div>
                  </fieldset>

                  <fieldset disabled>
                      <div class="form-group">
                        <label for="meses_cancelados" class="col-md-8 from-control-label">Número de meses a cancelar
                        </label>
                          <div class="col-md-4 ml-5">
                            <input type="text" id="meses_cancelados" name="meses_cancelados" class="form-control" value="1">
                           </div>
                       </div>
                  </fieldset>
            </div>

            <div class="float-right " style="  width: 50%; height: 330px;  margin-right: -10%; margin-top: -37%;">

              <fieldset disabled>
                      <div class="form-group">
                        <label for="created_at" class="col-md-6 from-control-label">Fecha y hora de factura
                        </label>
                          <div class="col-md-8 ml-5">
                            <input type="text" id="created_at" class="form-control" value="{{$factura->created_at}}">
                           </div>
                       </div>
                  </fieldset>

                  <fieldset disabled>
                      <div class="form-group">
                        <label for="nombre_socio" class="col-md-5 from-control-label">Nombre de socio
                        </label>
                          <div class="col-md-8 ml-5">
                            <input type="text" id="nombre_socio" class="form-control" value="{{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}">
                           </div>
                       </div>
                  </fieldset>

                      <div class="form-group">
                            <label class="col-md-4 from-control-label" for="forma_pago">Forma de pago</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="forma_pago">
                                <option selected>Elegir...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                              </select>
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
