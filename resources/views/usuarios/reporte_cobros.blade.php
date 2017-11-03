@extends('layouts.app')

@section('content')

        <div class="col-md-8 offset-md-2 mt-5">

@include('mensajes.alertas')

           </div>

              <div class="card" style="width: 100%; height: auto;">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills ml-5">

                    <li class="nav-item">
                       <h5 class="text-primary">Reporte cobros</h5>
                    </li>

                </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">

      @include('cobros.reporte')

                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <a href="/usuarios/home" class="btn btn-warning btn-md">
                                   Regresar
                                </a>
                            </div>
                        </div>
           </div>
        </div>
      </div>
   
@endsection
