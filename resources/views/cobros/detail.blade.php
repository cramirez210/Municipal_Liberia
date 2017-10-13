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
                       <h5 class="text-primary">Detalle de cobro</h5>
                    </li>

                </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">
<!--_________________________________Socio_______________________________________-->
        <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de usuario</h4>

               <div class="col-md-15 mt-3">
                <b>Nombre de usuario:</b> 
                {{$cobro->nombre_usuario}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Cédula:</b> 
                {{$cobro->cedula}}
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Nombre completo:</b> 
                {{$cobro->primer_nombre}} {{$cobro->primer_apellido}} {{$cobro->segundo_apellido}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-8 mt-2">Información de cobro</h4>

              <div class="col-md-15 mt-3">
                <b>Fecha de factura:</b> 
                {{$cobro->fecha_factura}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Fecha de cobro:</b> 
                {{$cobro->created_at}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto:</b> 
                {{$cobro->monto}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Estado:</b> 
                {{$cobro->estado}}
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
