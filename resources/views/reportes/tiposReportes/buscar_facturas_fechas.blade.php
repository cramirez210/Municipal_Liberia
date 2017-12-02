
<div id="buscar_facturas_fechas" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h4 class="modal-title">Buscar facturas</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body row d-flex justify-content-center">
          <div class="col-md-6">
            <form class="form col-md-auto" method="POST" action="/reportes/facturas_fechas" target="_blank"> 
              {{ csrf_field() }}
              @include('layouts.filtrar_fechas')
              <button class="btn btn-success fa fa-check system-icons" type="submit"> Buscar</button>
              <button type="button" class="btn btn-danger fa fa-times system-icons" data-dismiss="modal"> Cerrar</button>
            </form>  
          </div>
      </div>
    </div>
  </div>
</div>