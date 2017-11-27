<div id="buscar_usuario" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">

  <form method="GET" action="/reportes/sociosbyUser" target="_blank"> 
    {{ csrf_field() }}
    <center>
  <select class="custom-select mb-1" name="Criterio">
    <option selected value="2">Nombre de Usuario Ejecutivo</option>
    <option value="1">Cedula de Usuario Ejecutivo</option>
  </select>

  <label>
        <input type="text" class="form-control" placeholder="Ej: 506840523 o Admin" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
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