@extends('layouts.app')

@section('content')

<div class="col-md-8 offset-md-2">

@include('mensajes.alertas')

</div>
<br>
<div class="card text-center">
  <div class="card-header text-primary">
    Menu de Reportes
  </div>
  <div class="card-block">
    <div class="row py-4">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-block">
        <div class="py-3">
            <i class="fa fa-user-o iconos" aria-hidden="true"></i>                          
        </div>
        <h3 class="card-title"><b>Usuarios</b></h3>
        <p class="card-text">Reportes de usuarios por su condicion y tipo.</p>
        <div class="py-3">
          <a href="#" class="list-group-item" target="_blank" data-toggle="modal" data-target="#buscar_usuario">Socios de un usuario ejecutivo</a>
          @include('reportes.tiposReportes.buscar_usuario')
          <ul class="list-group-item">
            <li class="list-unstyled dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reporte de:</a>
              <div class="dropdown-menu">
               <a class="dropdown-item" href="/reportes/allUser" target="_blank">Todos los usuarios</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/estadoUser/1" target="_blank">Usuarios activos</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/estadoUser/2" target="_blank">Usuarios inactivos</a>
               </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-block">
        <div class="py-3">
            <i class="fa fa-users iconos" aria-hidden="true"></i>                          
        </div>
        <h3 class="card-title"><b>Socios</b></h3>
        <p class="card-text">Reportes de socios por condicion y categoria.</p>
        <div class="py-3">
          <ul class="list-group-item">
            <li class="list-unstyled dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reporte de:</a>
              <div class="dropdown-menu">
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Todos los socios</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Socios activos</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Socios inactivos</a>
               </div>
            </li>
          </ul>
          <a href="#" class="list-group-item" target="_blank">Morocidad</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 mt-4">
    <div class="card">
      <div class="card-block">
        <div class="py-3">
            <i class="fa fa-file-text-o iconos" aria-hidden="true"></i>                          
        </div>
        <h3 class="card-title"><b>Facturas</b></h3>
        <p class="card-text">Reportes asociados a la facturacion del sistema.</p>
        <div class="py-3">
          <a href="/usuarios/showCreate" class="list-group-item" target="_blank">Factura en especifico</a>
          <ul class="list-group-item">
            <li class="list-unstyled dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reporte de:</a>
              <div class="dropdown-menu">
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Facturas mes expesifico</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Facturas pendientes</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Facturas en...</a>
               </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-4">
    <div class="card">
      <div class="card-block">
        <div class="py-3">
            <i class="fa fa-money iconos" aria-hidden="true"></i>                          
        </div>
        <h3 class="card-title"><b>Liquidacion de Cobros</b></h3>
        <p class="card-text">Reportes sobre la liquidacion de cobros de los usuarios ejecutivos.</p>
        <div class="py-3">
          <ul class="list-group-item">
            <li class="list-unstyled dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reporte de:</a>
              <div class="dropdown-menu">
               <a class="dropdown-item" href="/reportes/reporte" target="_blank">Todos los </a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank"> activos</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="/reportes/reporte" target="_blank"> inactivos</a>
               </div>
            </li>
          </ul>
          <a href="#" class="list-group-item" target="_blank">Morocidad</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="row d-flex justify-content-center">
    <a href="/" class="btn btn-warning">Regresar a inicio</a>
  </div>
  
  </div>
  <div class="card-footer text-muted">
    Todo reporte esta sujeto a una fecha espesifica.
  </div>
</div>



@endsection

@section('titulo')
Modulo Reportes
@endsection