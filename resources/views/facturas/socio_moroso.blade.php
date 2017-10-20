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
                <div class="alert alert-warning">
       
                  <span class="card-text text-warning "> 
                  El socio no tiene facturas pendientes </span>
                </div>
                <br>
                @endforelse
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto por periodo:</b> 
                {{$socio->precio_categoria}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto total pendiente:</b> 
                {{$monto}}
              </div>
</div>
                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <a href="{{URL::previous()}}" class="btn btn-outline-success btn-lg">
                                   Regresar
                                </a>
                            </div>
                        </div>
           </div>
        </div>
      </div>
   
@endsection
