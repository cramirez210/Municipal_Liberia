@extends('layouts.app')

@section('content')

<br>
<div class="card text-center">
  <div class="card-header text-primary">
    Configuración
  </div>
  <div class="card-block">
    <div class="row mt-4">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-block">
        <h3 class="card-title">Roles...</h3>
        <p class="card-text">Los roles son una parte muy importante ya que definen los niveles de jerarquía y a su ves las diferentes actividades para un usuario del sistema.</p>
        <a href="/roles/index" class="btn btn-primary">Administrar Roles</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-block">
        <h3 class="card-title">Catálogo de Categorías...</h3>
        <p class="card-text">Las categorías son una parte importante para los socios ya que ellas definen el monto de facturación y su espacio correspondiente en el estadio.</p>
        <a href="/categoria/home" class="btn btn-primary">Administrar Categorías</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 mt-4">
    <div class="card">
      <div class="card-block">
        <h3 class="card-title">Estados...</h3>
        <p class="card-text">Los estados son una parte importante para todo el funcionamiento del sistema y NO DEBEN ser manipulados sin la devida autorización.</p>
        <a href="/estados/home" class="btn btn-primary">Administrar Estados</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-4">
    <div class="card">
      <div class="card-block">
        <h3 class="card-title">Descuentos</h3>
        <p class="card-text">Los descuentos son una parte importante para la facturación, ya que en estos se establecen los montos a rebajar en el pago de facturas según la cantidad de meses que cancele un socio.</p>
        <a href="/descuentos/create" class="btn btn-primary">Administrar descuentos</a>
      </div>
    </div>
  </div>
</div>


  </div>
  <div class="card-footer text-muted">
    Cualquier cambio en la configuración, debe ser consultado con el personal de soporte técnico..
  </div>
</div>



@endsection

@section('titulo')
Configuracion
@endsection