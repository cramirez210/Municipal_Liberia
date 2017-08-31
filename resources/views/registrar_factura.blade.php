@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
            <div class="panel panel-default">
            
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <fieldset disabled>
                            <div class="form-group">
                              <label for="nombre" class="col-md-4 from-control-label">Nombre de socio</label>
                              <div class="col-md-6">
                              <input type="text" id="nombre" class="form-control" placeholder="Jafet Chevez">
                              </div>
                            </div>
                          </fieldset>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="col-md-4 from-control-label">Meses a pagar</label>

                            <div class="col-md-12">
                               <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Enero
                                  </label>
                                </div>
                                <div class="form-check form-check-inline disabled">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" disabled> Febrero
                                  </label>
                                </div>
                                <div class="form-check form-check-inline disabled">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled> Marzo
                                  </label>
                                 </div> 
                            </div> 
                        </div>

                        <fieldset disabled>
                            <div class="form-group">
                              <label for="monto" class="col-md-4 from-control-label">Total a pagar</label>
                              <div class="col-md-6">
                              <input type="text" id="monto" class="form-control" placeholder="0">
                              </div>
                            </div>
                          </fieldset>

                          <div class="form-group">
                        <label class="col-md-4 from-control-label" for="forma_pago">Forma de pago</label>
                         <div class="col-md-6">
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
                            <label for="transaccion_bancaria" class="col-md-4 form-control-label">Transacción bancaria</label>

                            <div class="col-md-6">
                                <input id="transaccion_bancaria" type="text" class="form-control" name="transaccion_bancaria" value="{{ old('transaccion_bancaria') }}" required autofocus>

                                @if ($errors->has('transaccion_bancaria'))
                                    <span class="form-control-feedback">
                                        <strong>{{ $errors->first('transaccion_bancaria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                                <input class="btn btn-default" type="reset" value="Limpiar">
                            </div>
                        </div>
                    </form>
        </div>
    </div>
@endsection
