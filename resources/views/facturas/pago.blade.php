@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

              <div class="card mx-auto" style="width: 75%; height: auto;">
                <div class="card-header text-center text-primary">
                  <b>Confirmar pago</b>
                  <ul class="nav nav-pills card-header-pills float-right">
                  <li class="nav-item">
                  <div class="col-md-2 mr-3">
                  <a href="{{URL::previous()}}" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
                      Regresar
                  </a>
             </div>
              </li>
              </ul>
                </div>

             <div id="prueba" class="card-block">
    <div class="container-fluid mt-4 w-100">
      <form class="form-horizontal" action="/facturas/liquidar/{{$socio->socio_id}}" method="POST">
                        {{ csrf_field() }}
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


                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <button id="confirmar" type="submit" class="btn btn-success btn-md fa fa-check system-icons">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                      </form>
           </div>
        </div>
      </div>
   
@endsection
