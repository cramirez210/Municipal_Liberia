@extends('layouts.app')

@section('content')

        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header text-center">
                  <div class="card-tittle h4 text-primary">
                   <b>Reporte de cobros</b>  
                </div>
                </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">

      @include('cobros.reporte')

                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <a href="/cobros/index" class="btn btn-warning btn-md fa fa-exclamation-triangle system-icons">
                                    Regresar
                                </a>
                            </div>
                        </div>
           </div>
        </div>
      </div>
   
@endsection
