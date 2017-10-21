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
                {{$socio->socio_id}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$socio->primer_nombre}} {{$socio->primer_apellido}} {{$socio->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Categoría:</b> 
                {{$socio->categoria}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de pendientes</h4>

              <div class="col-md-15 mt-3">
                <b>Periodos pendientes:</b> 
                @forelse($pendientes as $pendiente)
                 <div class="col-md-8">
                  {{date('m-Y', strtotime($pendiente->created_at))}}
                 </div>
                @empty
                <div class="alert alert-warning col-md-8 mt-2">
                  <span class="text-warning "> 
                  <b>El socio no tiene facturas pendientes</b> </span>
                </div>
                @endforelse
              </div>

              @if(count($pendientes))
              <div class="col-md-15 mt-3">
                <b>Monto por periodo:</b> 
                {{$socio->precio_categoria}}
              </div>

             
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
