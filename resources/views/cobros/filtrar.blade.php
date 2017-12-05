<div id="filtrar_cobros" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title"> Buscar en
                              @if(isset($estado_id))
                                  @if($estado_id == 3) <b>cobros pendientes de liquidar</b> @endif
                                  @if($estado_id == 4) <b>cobros liquidados</b> @endif
                                  @if($estado_id == 0) <b>todos los cobros</b> @endif
                              @else <b>todos los cobros</b>
                              @endif
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
                              <form method="GET" action="/cobros/filtrar">
  <select class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Periodo</option>
    <option value="2">Fecha cobro</option>
    <option value="3">Usuario</option>
    <option value="4">Nombre completo</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($estado_id))
        <input name="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif

        <button type="submit" class="btn btn-success ml-2 fa fa-search system-icons" > Buscar</button>
  </label>
  </form>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>