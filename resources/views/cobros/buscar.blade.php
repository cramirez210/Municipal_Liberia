<div id="buscar" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar usuario</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">

  <form class="form-inline ml-2" method="POST" action="/cobros/buscar/user"> 
    {{ csrf_field() }}

  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="Criterio">
    <option value="1">Cedula</option>
    <option selected value="2">Nombre de usuario</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
        <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>

        <button class="btn btn-success d-inline-block ml-1" type="submit">Buscar</button>

  </form>  
</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>