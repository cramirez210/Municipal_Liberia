<div class="container mt-3" id="info_moroso">
   <div class="float-left col-md-6">

          <h4 class="card-title col-md-10 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$socio->socio_id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> <br>
                {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Categoría:</b> 
                {{$socio->categoria}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Teléfono:</b> 
                {{$socio->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$socio->email}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-12 mt-2">Información de pendientes</h4>

              <div class="col-md-15 mt-3">
                <b>Periodos pendientes:</b> 
                @forelse($pendientes as $pendiente)
                 <div class="col-md-10">
                  {{date('m-Y', strtotime($pendiente->periodo))}}
                 </div>
                @empty
                <div class="alert alert-warning col-md-10 mt-2">
                  <span class="text-warning "> 
                  <b>El socio no tiene facturas pendientes</b> </span>
                </div>
                @endforelse
              </div>

              @if(count($pendientes))
              <div class="col-md-15 mt-3">
                <b>Monto por periodo:</b> 
                {{$socio->precio_categoria}}
              </div>

             
              <div class="col-md-15 mt-3">
                <b>Monto total pendiente:</b> 
                {{$monto}}
              </div>
              @endif
</div>
</div>