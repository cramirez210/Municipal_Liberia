<div class="card">
  <div class="card-header text-center">
    <p class="text-primary"><b>Factura</b></p>
  </div>
  <div class="card-block">

   <div class="float-left col-md-6">
          <div class="row d-flex justify-content-center">
            <h4 class="card-title py-3">Información de socio</h4>
          </div>
          
          <div class="row">

            <div class="col-4 ml-5">
              <p class="mt-3"><b>Número de socio:</b></p>
              <p class="mt-3"><b>Nombre completo:</b></p>
              <p class="mt-3"><b>Categoría:</b></p>
              @if($factura->forma_pago !="")
              <p class="mt-3"><b>Forma de pago:</b></p>
              @endif
              <p class="mt-3"><b>Cobrador:</b></p>
            </div>

            <div class="col-6">
              <p class="mt-3">{{$factura->socio_id}}</p>
              <p class="mt-3">{{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}</p>
              <p class="mt-3">{{$factura->categoria}}</p>
              <p class="mt-3">{{$factura->forma_pago}}</p>
              <p class="mt-3">{{$factura->nombre_usuario}}</p>
            </div>
          </div>
	</div> 

	<div class="col-md-6 float-right">
        <div class="row d-flex justify-content-center">
           <h4 class="card-title py-3 mr-5">Información de factura</h4>
        </div>
        
        <div class="row">
          <div class="col-4 ml-4">
            <p class="mt-3"><b>Número de factura:</b></p>
            <p class="mt-3"><b>Monto:</b></p>
            <p class="mt-3"><b>Periodo:</b></p>
            <p class="mt-3"><b>Fecha de pago:</b></p> 
          </div>
          <div class="col-6">
            <p class="mt-3">{{$factura->id}}</p>
            <p class="mt-3">{{$factura->monto}}</p>
            <p class="mt-3">{{$factura->periodo}}</p>
            <p class="mt-3">{{$factura->created_at}}</p>
          </div>
        </div>           
	</div>

  </div>

  <div class="card-footer text-muted text-center">
    <p class="text-footer"> Municipal Liberia <span class="print">© Copyright - UCR</span></p>
  </div>

</div>
<div style="page-break-before: always;"></div>
