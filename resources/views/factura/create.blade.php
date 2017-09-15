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
            
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

            <div class="float-none" style="background-color: ;
              width: 50%; margin-left: 10%; height: 330px">

<!--_________________________________Socio_______________________________________-->

              <fieldset disabled>
                      <div class="form-group">
                        <label for="numero_socio" class="col-md-5 from-control-label">Número de socio
                        </label>
                          <div class="col-md-4 ml-5">
                            <input type="text" id="numero_socio" class="form-control" placeholder="100">
                           </div>
                       </div>
                  </fieldset>

                  <fieldset disabled>
                      <div class="form-group">
                        <label for="nombre_socio" class="col-md-5 from-control-label">Nombre de socio
                        </label>
                          <div class="col-md-8 ml-5">
                            <input type="text" id="nombre_socio" class="form-control" placeholder="Jafet Chevez Orias">
                           </div>
                       </div>
                  </fieldset>

<!--_________________________________Factura_______________________________________-->

                        <fieldset disabled>
                            <div class="form-group">
                              <label for="monto" class="col-md-5 from-control-label">Meses pendientes</label>
                               <div class="col-md-8 ml-5">
                                <textarea id="meses_pendientes" type="textarea" placeholder="Enero, Febrero, Marzo." class="form-control" name="meses_pendientes" value="{{ old('meses_pendientes') }}" required autofocus></textarea>
                            </div>
                            </div>
                          </fieldset>
            </div>

            <div class="float-right " style="  width: 50%; height: 330px;  margin-right: -10%; margin-top: -37%;">

              <div class="form-group{{ $errors->has('meses_pagar') ? ' has-danger' : '' }}">
                            <label class="col-md-7 from-control-label">Número de meses a cancelar</label>

                            <div class="col-md-4 ml-5">
                                <input id="meses_pagar" type="text" class="form-control" name="meses_pagar" value="{{ old('meses_pagar') }}" required autofocus>

                                @if ($errors->has('meses_pagar'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('meses_pagar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <div class="form-group">
                            <label class="col-md-4 from-control-label" for="forma_pago">Forma de pago</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="forma_pago">
                                <option selected>Elegir...</option>
                                <option value="1">Conectividad</option>
                                <option value="2">Efectivo</option>
                                <option value="3">Depósito</option>
                                <option value="4">Datáfono</option>
                              </select>
                             </div>
                        </div>

                        <div class="form-group{{ $errors->has('transaccion_bancaria') ? ' has-danger' : '' }}">
                            <label for="transaccion_bancaria" class="col-md-5 form-control-label">Transacción bancaria</label>

                            <div class="col-md-6 ml-5">
                                <input id="transaccion_bancaria" type="text" class="form-control" name="transaccion_bancaria" value="{{ old('transaccion_bancaria') }}" required autofocus>

                                @if ($errors->has('transaccion_bancaria'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('transaccion_bancaria') }}</strong>
                                    </span>
                                @endif
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
