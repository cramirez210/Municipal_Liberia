@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header text-center">
                     <div class="card-title text-primary">
                       <b>Detalle de cobros realizados</b>
                </div>
              </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">
<!--_________________________________Socio_______________________________________-->
        <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$user->user_id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$user->primer_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Telefono:</b> 
                {{$user->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$user->email}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de pendientes</h4>

              <div class="col-md-15 mt-3">
                <b>Pendientes de liquidar:</b> 
                @if($pendientes)
                  {{$pendientes}}
                @else
                <div class="alert alert-warning col-md-8 mt-2">
                  <span class="text-warning "> 
                  <b>El usuario no tiene cobros pendientes de liquidar</b> </span>
                </div>
                @endif
              </div>

              @if($pendientes)
              <div class="col-md-15 mt-3">
                <b>Monto total pendiente:</b> 
                {{$monto}}
              </div>
              @endif
</div>
                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <a href="{{URL::previous()}}" class="btn btn-warning btn-md">
                                   Regresar
                                </a>
                            </div>
                        </div>
           </div>
        </div>
      </div>
   
@endsection
