
<div id="buscar_comisiones_fechas" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar comisiones</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
  <form class="form col-md-6" method="POST" action="/reportes/comisiones/fechas" target="_blank"> 
    {{ csrf_field() }}


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