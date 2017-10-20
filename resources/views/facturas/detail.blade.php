@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

             @if(session('success'))
              <div class="card-block">
                <label class=" card-title alert alert-success" style="width: 100%;">{{ session('success') }}</label>
              </div>
              @endif 

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills ml-5">

                    <li class="nav-item">
                       <h5 class="text-primary">Detalle de factura</h5>
                    </li>

                </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">
<!--_________________________________Socio_______________________________________-->
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
                {{date('m-Y', strtotime($factura->created_at))}}
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
                                <a href="{{URL::previous()}}" class="btn btn-warning btn-md">
                                   Regresar
                                </a>
                            </div>
                        </div>
           </div>
        </div>
      </div>
   
@endsection
