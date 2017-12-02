@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

  <div class="card mt-4">
  <div class="card-header text-center text-primary">
    <div class="card-title h3"><b>Morosidad de un usuario</b></div>

          <div class="col-md-4 float-right mr-5">
        <a href="/facturas/index" class="btn btn-warning btn-xs mb-2 fa fa-exclamation-triangle system-icons">
            Regresar
        </a>
   </div>
  </div>

  <div class="card-block">

           <div class="float-left col-md-6">

          <h4 class="card-title col-md-12 mt-2">Información de usuario</h4>

               <div class="col-md-15 mt-3">
                <b>Nombre de usuario:</b> 
                {{$user->nombre_usuario}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> <br>
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

                  <h4 class="card-title col-md-12 mt-2">Información de pendientes</h4>

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
</div>
</div>
@endsection
