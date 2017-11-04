@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills ml-5">

                    <li class="nav-item">
                       <h5 class="text-primary">Registrar nueva factura</h5>
                    </li>
                </div>

              <div class="card-block">

                <div class="col-md-10  mt-5">
            
                    <form class="form-horizontal" action="/facturas/update/{{$factura->id}}" method="POST">
                        {{ csrf_field() }}

            <div class="float-left" style="background-color: ;
              width: 50%; margin-left: 10%; height: auto">

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
      
              <div class="card-block">
            </div>
       </div>


              <div class="float-right " style="width: 50%; height: auto;  margin-right: -10%;">

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
                 {{$factura->created_at}}
               </div>

               <div class="col-md-10 mt-3">
                 <b>Periodo:</b> 
                 {{$factura->periodo}}
               </div>

                <div class="form-group mt-3">
                            <label class="col-md-4 from-control-label" for="forma_pago">Forma de pago</label>
                             <div class="col-md-6 ml-5">
                              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="forma_pago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Depósito">Depósito</option>
                              </select>
                             </div>
                        </div>
              </div>


              <center class="form-group mt-3">
                <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-success btn-lg mt-5">
                                    Registrar
                                </button>
                            </div>
                        </div>
              </center>
                        
                    </form>
              </div>         
           </div>
        </div>
      </div>
   
@endsection
