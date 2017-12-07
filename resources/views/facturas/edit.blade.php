@extends('layouts.app')

@section('content')


@include('mensajes.alertas')

              <div class="card">
                <div class="card-header text-center">
                  <div class="card-tittle text-primary"><b>Editar la factura</b></div>
                </div>

              <div class="card-block">

                <div class="col-md-12">
            
                    <form class="form-horizontal" action="/facturas/update/{{$factura->id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-left col-md-6">

<!--_________________________________Socio_______________________________________-->
               <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-10 mt-4">
                <b>Número de socio:</b> 
                {{$factura->socio_id}}
              </div>
              
              <div class="col-md-10 mt-3">
                <b>Nombre completo:</b> 
                {{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}
              </div>

              <div class="col-md-10 mt-3">
                <b>Categoría:</b> 
                {{$factura->categoria}}
              </div>
       </div>


              <div class="float-right col-md-6">

                <h4 class="card-title col-md-8 mt-2">Información de factura</h4>

                <div class="col-md-10 mt-3">
                <b>Número de factura:</b> 
                {{$factura->id}}
              </div>

              <div class="col-md-10 mt-3">
                 <b>Monto a pagar:</b> 
                 {{$factura->monto}}
               </div>
               
               <div class="col-md-10 mt-3">
                 <b>Fecha:</b> 
                 {{date('d-m-Y', strtotime($factura->created_at))}}
               </div>

               <div class="col-md-10 mt-3">
                 <b>Periodo:</b> 
                 {{date('m-Y', strtotime($factura->periodo))}}
               </div>

               @if(isset($editar))
                  <div class="form-group mt-3">
                            <label class="col-md-4 from-control-label" for="estado"><b>Estado</b></label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="estado">
                                <option value="4">Pago</option>
                                <option selected value="5">Cancelado</option>
                              </select>
                             </div>
                    </div>
                    <input type="hidden" name="tipo" value="edit">
                @else
                <input type="hidden" name="estado" value="4">
                <input type="hidden" name="tipo" value="pago">
                @endif

                <div class="form-group mt-3">
                            <label class="col-md-4 from-control-label" for="forma_pago"><b>Forma de pago</b> </label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="forma_pago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                              </select>
                             </div>
                </div>
              </div>    


               <div class="form-group ml-lg-5">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-success btn-md mt-3">
                                    Registrar
                                </button>
                                <a href="{{URL::previous()}}" class="btn btn-warning btn-md mt-3">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </form>
              </div>         
           </div>
        </div>
   
@endsection
