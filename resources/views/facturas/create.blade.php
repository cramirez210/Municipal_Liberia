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

              <div class="card" style="width: 100%; height: 520px;">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills ml-5">

                    <li class="nav-item">
                       <h5 class="text-primary">Registrar pago de factura</h5>
                    </li>

                </div>

              <div class="card-block">

                <div class="col-md-10  mt-5">

            <div class="panel panel-default">
            
                    <form class="form-horizontal" action="/facturas/pagar/{{$socio->socio_id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-left" style="background-color: ;
              width: 50%; margin-left: 10%; height: 330px">

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
                <a class="col-md-4" href="/facturas/{{$socio->socio_id}}/3">ver lista de pendientes</a>
              </div>
               
               <div class="col-md-6 mt-3">
                 <b>Monto total a pagar:</b>
                 {{$monto}} 
               </div>
               
               
              <div class="card-block">
            </div>
       </div>

            <div class="float-right " style="  width: 50%; height: 330px;  margin-right: -10%;">
              <h4 class="card-title col-md-7 mt-2">Información de pago</h4>
                      <div class="form-group">
                            <label class="col-md-7 mt-3 from-control-label" for="forma_pago">Número de meses a cancelar</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="meses_cancelados">
                                @if($facturas_pendientes >= 1)
                                <option value="1">1</option>
                                @endif
                                @if($facturas_pendientes >= 2)
                                <option value="2">2</option>
                                @endif
                                @if($facturas_pendientes == 3)
                                <option value="3">3</option>
                                @endif
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
                                <button type="submit" class="btn btn-outline-success btn-lg">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
              </div>         
           </div>
        </div>
      </div>
   
@endsection
