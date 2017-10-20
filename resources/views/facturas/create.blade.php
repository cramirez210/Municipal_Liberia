@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header text-center text-primary">
                  <b>Pago de factura</b> 
                  <a href="/facturas/pagar/buscar" class="btn btn-warning btn-md float-right mr-5">Regresar</a>
                </div>

              <div class="card-block">

                <div class="col-md-10  mt-5">

            <div class="panel panel-default">
            
                    <form class="form-horizontal" action="/facturas/confirmar/{{$socio->socio_id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-left" style="background-color: ;
              width: 50%; margin-left: 10%; height: 320px">

<!--_________________________________Socio_______________________________________-->
               <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-5 mt-4">
                <b>Número de socio:</b> 
                {{$socio->socio_id}}
              </div>
              
              <div class="col-md-5 mt-3">
                <b>Nombre completo:</b> 
                {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}}
              </div>

              <div class="col-md-5 mt-3">
                <b>Categoría:</b> 
                {{$socio->categoria}}
              </div>

              <div class="col-md-7 mt-3">
                <b>Mensualidades pendientes:</b> 
                {{$facturas_pendientes}}
                @if($facturas_pendientes)
                <a class="col-md-4" href="/facturas/pendientes/{{$socio->socio_id}}/3">ver lista de pendientes</a>
                @endif
                <input type="hidden" name="pendientes" value="{{$facturas_pendientes}}">
              </div>
               
               @if($facturas_pendientes)
               <div class="col-md-6 mt-3">
                 <b>Monto total a pagar:</b>
                 {{$monto}} 
               </div>
               @endif
               
               
              <div class="card-block">
            </div>
       </div>

            <div class="float-right " style="  width: 50%; height: auto;  margin-right: -10%;">
              <h4 class="card-title col-md-7 mt-2">Información de pago</h4>
                      <div class="form-group">
                            <label class="col-md-7 mt-3 from-control-label" for="forma_pago">Número de meses a cancelar</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="meses_cancelados">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                              </select>
                             </div>
                        </div>

                      <div class="form-group">
                            <label class="col-md-4 mt-3 from-control-label" for="forma_pago">Forma de pago</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="forma_pago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                              </select>
                             </div>
                        </div>
              </div>


                        <div class="form-group">
                            <div class="col-md-6 float-right">
                                <button type="submit" class="btn btn-success btn-md">
                                    Continuar
                                </button>
                            </div>
                        </div>
                    </form>
              </div>         
           </div>
        </div>
      </div>
   
@endsection
