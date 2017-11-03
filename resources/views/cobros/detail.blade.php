
              <div class="card" style="width: 100%; height: auto;">

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">
<!--_________________________________Socio_______________________________________-->
        <div class="float-left col-md-6">

          <h4 class="card-title col-md-12 mt-2">Información de usuario</h4>

               <div class="col-md-15 mt-3">
                <b>Nombre de usuario:</b> 
                {{$cobro->nombre_usuario}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Cédula:</b> 
                {{$cobro->cedula}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> <br>
                {{$cobro->primer_nombre}} {{$cobro->primer_apellido}} {{$cobro->segundo_apellido}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-12 mt-2">Información de cobro</h4>

              <div class="col-md-15 mt-3">
                <b>Periodo:</b> 
                {{date('m-Y', strtotime($cobro->fecha_factura))}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Fecha de cobro:</b> 
                {{date('d-m-Y', strtotime($cobro->created_at))}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto:</b> 
                {{$cobro->monto}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Estado:</b> 
                {{$cobro->estado}}
              </div>
</div>
           </div>
        </div>
      </div>
