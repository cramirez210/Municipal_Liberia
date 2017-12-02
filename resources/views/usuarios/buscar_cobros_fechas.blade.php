
<div id="buscar_cobros_fechas" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar cobros</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
  <form class="form col-md-12" method="POST" action="/cobros/user/fechas"> 
    {{ csrf_field() }}

<div class="mb-4">
  <select id="select_ejec" class="custom-select" name="Criterio">
    <option value="1">Cedula</option>
    <option selected value="2">Nombre de usuario</option>
  </select>

  <label class="custom-control mb-2 mr-sm-2 mb-sm-0">
        <input id="valor_ejec" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
  </label>
</div>



    @include('layouts.filtrar_fechas')
    
        <button class="btn btn-success fa fa-check system-icons" type="submit"> Buscar</button>

  </form>  
   </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>