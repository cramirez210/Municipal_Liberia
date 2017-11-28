<div id="buscar_factura" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar Factura</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">

  <form method="GET" action="/reportes/unaFactura" target="_blank"> 
    {{ csrf_field() }}
    <center>
  <select class="custom-select mb-1" name="Criterio">
    <option selected value="1">Numero de Factura</option>
  </select>

  <label>
        <input type="text" class="form-control" placeholder="Ej: 523" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>
  
     
        <button class="btn btn-success mb-1 fa fa-search system-icons" type="submit">Buscar</button>

        </center>
  </form>  

</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>