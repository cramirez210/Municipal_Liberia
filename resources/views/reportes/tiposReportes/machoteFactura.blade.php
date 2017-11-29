<div class="card text-center">
  <div class="card-header">
    <p><b>Factura</b></p>
  </div>
  <div class="card-block">

   <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$socio->socio_id}}
                <input type="hidden" name="socio_id" value="{{$socio->socio_id}}">
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Categoría:</b> 
                {{$socio->categoria}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Forma de pago:</b> 
                {{$var['forma_pago']}}
                <input type="hidden" name="forma_pago" value="{{$var['forma_pago']}}">
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Cobrador:</b> 
                {{$var['nombre_usuario']}}
              </div>

	</div> 

	<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de factura</h4>

              <div class="col-md-15 mt-3">
                <b>Número de meses a pagar:</b> 
                {{$var['meses_cancelados']}}
                <input type="hidden" name="meses_cancelados" value="{{$var['meses_cancelados']}}">
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Monto total:</b> 
                {{$var['monto']}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Pago hasta:</b> 
                {{date('m-Y', strtotime($var['pago_hasta']))}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Pendientes:</b> 
              @forelse($periodos_pendientes as $periodo)
                <div class="col-md-15 mt-3">
                  {{date('m-Y', strtotime($periodo->periodo))}}
                </div> 
              @empty
             
              <div class="col-md-15 mt-3">
                  El socio queda sin facturas pendientes
                </div>
              @endforelse
              </div>

              <div class="col-md-15 mt-3">
                <b>Fecha de pago:</b> 
                {{$var['fecha_pago']}}
              </div>
	</div>

  </div>

  <div class="card-footer text-muted">
    <p class="text-footer"> Municipal Liberia <span class="print">© Copyright - UCR</span></p>
  </div>

</div>
<div style="page-break-before: always;"></div>
