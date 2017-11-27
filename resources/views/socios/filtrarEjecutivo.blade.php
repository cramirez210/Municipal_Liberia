<div id="filtrar_users" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title"> Buscar en usuarios Ejecutivos
                            
                            </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
  <form method="GET" action="/usuarios/filtrar/ejecutivo">
  <select class="custom-select mb-1" name="Criterio">
    <option selected value="0">Cedula</option>
    <option value="1">Usuario</option>
    <option value="2">Nombre completo</option>
  </select>
  <label class=" ">
        <input type="text" class="form-control" placeholder="Ejemplo: 506840523" type="text" name="valor" value="{{ old('valor') }}" required autofocus> 
        @if(isset($estado_id))
        <input name="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif 

        @if(isset($rol_id))
        <input name="rol" type="hidden" value="{{$rol_id}}">
        @else
        <input name="rol" type="hidden" value="0">
        @endif 
       
  </label>
      <button type="submit" class="btn btn-success ml-2 fa fa-search system-icons" > Buscar</button>
  </form>
   </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>