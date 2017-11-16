<div id="moroso" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar socio moroso</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div id="moroso_body" class="modal-body text-left">

  <div class="container">

  <select id="select" class="custom-select" name="Criterio">
    <option selected value="1">Numero de Socio</option>
    <option value="2">Cédula</option>
  </select>

  <label>
        <input id="valor" type="text" class="form-control" placeholder="Ejemplo: 506840523" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>
        <button id="buscar_moroso" class="btn btn-success mb-1">Buscar</button>
  </div>

  <div id="contenido" class="mt-5">
    @include('mensajes.alertas')
  </div>
</div>
                          <div class="modal-footer">
                            <button id="cerrar_moroso" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>