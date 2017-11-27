@extends('layouts.app')

@section('content')

@include('mensajes.alertas')

@include('mensajes.errors')
	<!-- Si la sesión tiene algo guardado, muestrelo -->
<div class="row d-flex justify-content-center py-3">
    <h1 class="text-center"><b>Modulos de Facturación</b></h1>
</div>

<div class="row">
  <!-- Modulo1 -->
            <div class="col-sm-12 col-md-6 pt-sm-3 pt-md-3">
                <div class="card text-center fondo-cards">
                    <div class="card-block">
                      <div class="py-3">
                          <i class="fa fa-file-text-o iconos" aria-hidden="true"></i>                          
                      </div>
                      <h1 class="py-3">Facturas</h1>
                      <p class="card-text lead">Seccion de historial, morocidad y facturación de los socios.</p>
                      <div class="row">
                        <div class="col-12">
                           <h3 class="py-3">Navegacion</h3>
                           <div>
                            <a href="/facturas/imprimir" class="list-group-item">Imrpimir facturas</a>
                             <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar_socio">Pago de facturas</a>
                              @include('facturas.buscar_socio')
                             <ul class="list-group-item">
                                <li class="list-unstyled dropdown">
                                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/facturas/list">Todas las facturas</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/facturas/list/3">Facturas pendientes</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/facturas/list/4">Facturas canceladas</a>
                                  </div>
                                </li>
                              </ul>
                             <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar">Buscar facturas de un socio específico</a>
                              @include('facturas.buscar')
                             <a href="/facturas/recuento" class="list-group-item">Reporte de facturación</a>
                             <ul class="list-group-item">
                              <li class="list-unstyled dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Morosidad</a>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="/facturas/morosos">Todos los socios</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moroso">Un socio</a>
                                </div>
                              </li>
                             </ul>
                              @include('facturas.buscar_moroso')
                           </div>
                        </div>
                      </div>
                    </div>
                    <a class="card-footer btn bg-warning text-white" href="/facturas/index">Facturación</a>
                  </div>
            </div><!-- Modulo1 -->

              <!-- Modulo2 -->
            <div class="col-sm-12 col-md-6 pt-sm-3 pt-md-3">
                <div class="card text-center fondo-cards">
                    <div class="card-block">
                      <div class="py-3">
                          <i class="fa fa-money iconos" aria-hidden="true"></i>                          
                      </div>
                      <h1 class="py-3">Liquidacion de Cobros</h1>
                      <p class="card-text lead">Seccion de historial, moricidad y liquidacion de los usuarios ejecutivos.</p>
                      <div class="row">
                        <div class="col-12">
                          <h3 class="py-3">Navegacion</h3>
                          <div>
                            <a class="list-group-item" href="#" data-toggle="modal" data-target="#buscar_liquidar">Liquidación de cobros de un ejecutivo</a>
                            @include('cobros.buscar_liquidar')
                            <ul class="list-group-item">
                              <li class="list-unstyled dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Listar</a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="/cobros/list">Todos los cobros</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="/cobros/list/3">Cobros pendientes</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="/cobros/list/4">Cobros liquidados</a>
                                  </div>
                              </li>
                            </ul>
                            <a href="#" class="list-group-item" data-toggle="modal" data-target="#buscar_ejec">Buscar cobros de un ejecutivo específico</a>
                            @include('cobros.buscar')
                            <a href="/cobros/recuento" class="list-group-item">Reporte de cobros</a>
                            <ul class="list-group-item">
                              <li class="list-unstyled dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Morosidad</a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="/cobros/morosos">Todos los ejecutivos</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#buscar_ejemoroso">Un ejecutivo</a>
                                  </div>
                              </li>
                            </ul>
                          @include('cobros.buscar_moroso')
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="card-footer btn bg-warning text-white" href="/facturas/index">Facturación</a>
                  </div>
            </div><!-- Modulo2 -->
</div>

@endsection

@section('titulo')
    Modulo de Facturación
@endsection