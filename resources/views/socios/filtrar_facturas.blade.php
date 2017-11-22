<div id="filtrar_facturas_socio" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title"> Buscar en
                              @if(isset($estado_id))
                                  @if($estado_id == 3) <b>facturas pendientes</b> @endif
                                  @if($estado_id == 4) <b>facturas pagadas</b> @endif
                                  @if($estado_id == 0) <b>todas las facturas</b> @endif
                              @else <b>todas las facturas</b>
                              @endif
                              de {{$socio->primer_nombre}} {{$socio->primer_apellido}}
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
    <form method="GET" action="/socio/facturas/filtrar">
      <select class="custom-select mb-2 mb-sm-0" name="Criterio">
        <option selected value="0">N° de factura</option>
        <option value="4">Periodo</option>
      </select>

      <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
            <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
            @if(isset($estado_id))
            <input name="estado" type="hidden" value="{{$estado_id}}">
            @else
            <input name="estado" type="hidden" value="0">
            @endif

            <input name="socio_id" type="hidden" value="{{$socio->socio_id}}">
            <button type="submit" class="btn btn-success ml-2" >Buscar</button>
      </label>
    </form>
    </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>