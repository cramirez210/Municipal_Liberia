

<div id="filtrar_socios" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title"> Buscar en
                              @if(isset($id))
                                  @if($id == 1) <b>socios activos</b> @endif
                                  @if($id == 2) <b>socios inactivos</b> @endif
                                  @if($id == 0) <b>todos los socios</b> @endif
                              @else <b>socios</b>
                              @endif
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
  <form method="GET" action="/socios/filtrar">
  <select class="custom-select mb-1" name="Criterio">
    <option selected value="0">Numero de Socio</option>
    <option value="1">Categoria</option>
    <option value="2">Cedula</option>
    <option value="3">Nombre</option>
    <option value="4">Ejecutivo</option>
    
  </select>

  <label>
        <input type="text" class="form-control" placeholder="Ejemplo: 243" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($id))
        <input name="estado" type="hidden" value="{{$id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif

  </label>
     <button type="submit" class="btn btn-success ml-2" >Buscar</button>
  </form>
  </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>