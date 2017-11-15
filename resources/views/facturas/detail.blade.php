
<!--_________________________________Socio_______________________________________-->
        <div class="float-left col-md-6">

          <h4 class="card-title col-md-10 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$factura->socio_id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> <br>
                {{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Categoría:</b> 
                {{$factura->categoria}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Teléfono:</b> <br>
                {{$factura->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$factura->email}}
              </div>
</div>

<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-12 mt-2">Información de factura</h4>

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
                {{date('m-Y', strtotime($factura->periodo))}}
              </div>

              @if($factura->estado_id == 4)
              <div class="col-md-15 mt-3">
                <b>Fecha de pago:</b> 
                {{date('d-m-Y', strtotime($factura->fecha_pago))}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Forma de pago:</b> 
                {{$factura->forma_pago}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Cobrador:</b> 
                {{$factura->nombre_usuario}}
              </div>
              @else
              <div class="col-md-15 mt-3">
                <b>Estado:</b> 
                {{$factura->estado}}
              </div>
              @endif
</div>


                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                              @if($factura->estado_id == 3)
                                <a href="/facturas/pagar/{{$factura->id}}" class="btn btn-primary btn-md">
                                   Pagar
                                </a>
                              @endif
                            </div>
                        </div>
