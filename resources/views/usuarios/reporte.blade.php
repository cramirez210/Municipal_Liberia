
        <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de usuario</h4>

               <div class="col-md-15 mt-3">
                <b>Nombre de usuario:</b> 
                {{$reporte['user']->nombre_usuario}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$reporte['user']->primer_nombre}} {{$reporte['user']->primer_apellido}} {{$reporte['user']->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Teléfono:</b> 
                {{$reporte['user']->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$reporte['user']->email}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de cobros</h4>

              <div class="col-md-15 mt-3">
                <b>Cobros realizados:</b> 
                 {{$reporte['total_cobros']}}
                 @if($reporte['total_cobros'] != 0)
                  <div>
                    <a href="/cobros/user/fechas/list/{{$reporte['user']->user_id}}/{{$desde}}/{{$hasta}}">Ver cobros realizados</a>
                  </div>
                  @endif
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto total recaudado:</b> 
                {{round($reporte['total_recaudado'], 0, PHP_ROUND_HALF_UP)}}
                @if($reporte['total_recaudado'] != 0)
                <div>
                    <a href="/cobros/user/fechas/list/{{$reporte['user']->user_id}}/{{$desde}}/{{$hasta}}/4">Ver cobros liquidados</a>
                  </div>
                @endif
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto pendiente de liquidar:</b> 
                {{round($reporte['monto_pendiente'], 0, PHP_ROUND_HALF_UP)}}
                @if($reporte['monto_pendiente'] != 0)
                <div>
                    <a href="/cobros/user/fechas/list/{{$reporte['user']->user_id}}/{{$desde}}/{{$hasta}}/3">Ver pendientes de liquidar</a>
                  </div>
                  @endif
              </div>
</div>
