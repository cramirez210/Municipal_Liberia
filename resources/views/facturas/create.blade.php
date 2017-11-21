@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header text-center text-primary">
                  <b>Pago de factura</b> 
                 
                </div>

              <div class="card-block">

                <div class="col-md-10  mt-5">

            <div class="panel panel-default">
            
                    <form class="container-fluid mt-4 w-100 ml-md-5" action="/facturas/confirmar/{{$socio->socio_id}}" method="POST">
                        {{ csrf_field() }}

                        <div class="ml-md-5">

            <div class=" col-md-6 float-left  "  >

<!--_________________________________Socio_______________________________________-->
               <h4 class="card-title col-md-12 mt-2">Información de socio</h4>

                 <div  class=" col-md-auto">
                    <label for="nombre" class="form-control-label"> <b>Número de socio:</b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                      {{$socio->socio_id}}
                    </div>
                  </div>

                  <div  class=" col-md-auto">
                    <label for="nombre" class="form-control-label"><b>Nombre completo:</b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                      {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}}
                    </div>
                  </div>

                  <div  class=" col-md-auto">
                    <label for="categoria" class="form-control-label"> <b>Categoría:</b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                     {{$socio->categoria}}
                    </div>
                  </div>

                   <div  class=" col-md-auto">
                    <label for="mensualidades" class="form-control-label">  <b>Mensualidades pendientes:</b>  </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                      {{$facturas_pendientes}}
                        @if($facturas_pendientes)
                          <a class="col-md-4" href="/facturas/pendientes/{{$socio->socio_id}}/3">ver lista de pendientes</a>
                        @endif
                          <input type="hidden" name="pendientes" value="{{$facturas_pendientes}}">
                    </div>

                  </div>
                  @if($facturas_pendientes)
                   <div  class=" col-md-auto">
                    <label for="totalapagar" class="form-control-label"> <b>Monto total a pagar:</b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                     {{$monto}} 
                    </div>
                  </div>
                   @endif
       </div>

            <div class="col-md-6 float-right ">
              <h4 class="card-title col-md-12 mt-2">Información de pago</h4>

                   <div  class=" col-md-auto">
                    <label for="nombre" class="form-control-label" for="forma_pago"> <b>Número de meses a cancelar: </b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
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

                  <div  class=" col-md-auto">
                    <label for="nombre" class="form-control-label" for="forma_pago" ><b>Forma de pago</b> </label>
                    <div class="col-md-auto  ml-lg-5 ml-xl-5">
                       <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="forma_pago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                              </select>
                    </div>
                  </div>  
                 
              </div>

                     <!--    <div class="form-group ">
                            <div class="col-md-6 mt-5">
                                <button type="submit" class="btn btn-success btn-md">
                                    Continuar
                                </button>

                                 <a href="/facturas/pagar/buscar" class="btn btn-danger btn-md float-right mr-5">Cancelar</a>
                            </div>
                        </div> -->


            <div>
              
              <button type="submit" class="btn btn-success btn-xs mt-4 ml-3" style="color: white;">
                Registrar
            </button>

              <a href="/facturas/index" class="btn btn-danger btn-xs mt-4 ml-3">
              <span class="glyphicon glyphicon-remove-circle"></span>Cancelar</a>
            </div>

             
       
     

            </div>


         
                    </form>
              </div>         
           </div>
        </div>
      </div>
    </div>
   
@endsection
