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
            
                    <form class="form-horizontal" action="/facturas/{{$socio->id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-none" style="background-color: ;
              width: 50%; margin-left: 10%; height: 330px">

<!--_________________________________Socio_______________________________________-->

              <fieldset disabled>
                      <div class="form-group">
                        <label for="socio_id" class="col-md-5 from-control-label">Número de socio
                        </label>
                          <div class="col-md-4 ml-5">
                            <input type="text" id="socio_id" class="form-control" value="{{$socio->id}}">
                           </div>
                       </div>
                  </fieldset>

                  <fieldset disabled>
                      <div class="form-group">
                        <label for="nombre_socio" class="col-md-5 from-control-label">Nombre de socio
                        </label>
                          <div class="col-md-8 ml-5">
                            <input type="text" id="nombre_socio" class="form-control" value="{{$persona->primer_nombre}} {{$persona->primer_apellido}} {{$persona->segundo_apellido}}">
                           </div>
                       </div>
                  </fieldset>

<!--_________________________________Factura_______________________________________-->

                        <fieldset disabled>
                            <div class="form-group">
                              <label for="monto" class="col-md-6 from-control-label">Mensualidades pendientes</label>
                               <div class="col-md-4 ml-5">
                                <input type="text" id="mensualidades_pendientes" class="form-control" value="2">
                            </div>
                            </div>
                          </fieldset>
            </div>

            <div class="float-right " style="  width: 50%; height: 330px;  margin-right: -10%; margin-top: -37%;">

                      <div class="form-group">
                            <label class="col-md-7 from-control-label" for="forma_pago">Número de meses a cancelar</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="meses_cancelados">
                                <option selected>Elegir...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                              </select>
                             </div>
                        </div>

                        <fieldset disabled>
                            <div class="form-group">
                              <label for="monto" class="col-md-5 from-control-label">Total a pagar</label>
                               <div class="col-md-4 ml-5">
                                <input type="text" name="monto" class="form-control" value="0">
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
