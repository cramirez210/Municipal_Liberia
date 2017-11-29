<div class="card text-center">
  <div class="card-header">
    <p><b>Factura</b></p>
  </div>
  <div class="card-block">

   <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$factura->socio_id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Categoría:</b> 
                {{$factura->categoria}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Forma de pago:</b> 
                {{$factura->forma_pago}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Cobrador:</b> 
                {{$factura->nombre_usuario}}
              </div>

	</div> 

	<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de factura</h4>

              <div class="col-md-15 mt-3">
                <b>Número de factura:</b> 
                {{$factura->id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Monto:</b> 
                {{$factura->monto}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Periodo:</b> 
                {{$factura->periodo}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Fecha de pago:</b> 
                {{$factura->created_at}}
              </div>
	</div>

  </div>

  <div class="card-footer text-muted">
    <p class="text-footer"> Municipal Liberia <span class="print">© Copyright - UCR</span></p>
  </div>

</div>
<div style="page-break-before: always;"></div>
