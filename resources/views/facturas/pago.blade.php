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
                <div class="card-header text-center text-primary">
                  <b>Pago de factura</b>
                  <a href="/facturas/index" class="float-right mr-5">Cancelar</a>
                </div>

             <div class="card-block">
    <div class="container-fluid mt-4 w-100">
      <form class="form-horizontal" action="/facturas/pagar/{{$socio->socio_id}}" method="POST">
                        {{ csrf_field() }}
        <div class="float-left col-md-5">

          <h4 class="card-title col-md-8 mt-2">Información de socio</h4>

               <div class="col-md-15 mt-3">
                <b>Número de socio:</b> 
                {{$socio->socio_id}}
                <input type="hidden" name="socio_id" value="{{$socio->socio_id}}">
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

                  <h4 class="card-title col-md-8 mt-2">Información de factura</h4>

              <div class="col-md-15 mt-3">
                <b>Número de meses a pagar:</b> 
                {{$var['meses_cancelados']}}
                <input type="hidden" name="meses_cancelados" value="{{$var['meses_cancelados']}}">
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Monto total:</b> 
                {{$var['monto']}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Fecha de pago:</b> 
                {{$var['fecha_pago']}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Forma de pago:</b> 
                {{$var['forma_pago']}}
                <input type="hidden" name="forma_pago" value="{{$var['forma_pago']}}">
              </div>
              
              <div class="col-md-15 mt-3">
                <b>Cobrador:</b> 
                {{$var['nombre_usuario']}}
              </div>
</div>


                        <div class="form-group">
                            <div class="col-md-6 mt-4 ml-3 float-right">
                                <button type="submit" class="btn btn-outline-success btn-lg">
                                    Confirmar
                                </button>
                            </div>
                        </div>
                      </form>
           </div>
        </div>
      </div>
   
@endsection
