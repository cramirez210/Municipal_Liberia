<div id="pagar_comision" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Pago de comisión</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">

            <div class="float-left col-md-6">

          <h4 class="card-title col-md-12 mt-2">Información de usuario</h4>

              <input type="hidden" id="user" value="{{$user->user_id}}">
              <div class="col-md-15 mt-3">
                <b>Usuario:</b> <br>
                {{$user->primer_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Teléfono:</b> 
                {{$user->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$user->email}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-12 mt-2">Información de pago</h4>

                <div class="col-md-15 mt-3">
                <b>Desde:</b> 
                {{$desde}}
                <input type="hidden" id="desde" value="{{$desde}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Hasta:</b> 
                {{$hasta}}
                <input type="hidden" id="hasta" value="{{$hasta}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto recaudado:</b> 
                {{$reporte['total_recaudado']}}
                <input type="hidden" id="monto" value="{{$reporte['total_recaudado']}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Porcentaje de comisión:</b> 
                <input type="text" class="form-control col-4 ml-4" placeholder="Ejemplo: 5" type="text" id="comision" name="comision" value="{{ old('comision') }}" required autofocus>
              </div>
</div>
  <button id="confirmar_comision" data-toggle="modal" data-target="#modal" class="btn btn-success mb-1 fa fa-check system-icons mt-3 ml-3">Continuar</button>
</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>