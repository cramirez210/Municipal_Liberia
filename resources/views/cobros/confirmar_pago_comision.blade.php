
  <form id="confirmar_pago_comision" method="POST" action="/comisiones/pagar"> 
    {{ csrf_field() }}

            <div class="float-left col-md-6">

          <h4 class="card-title col-md-12 mt-2">Información de usuario</h4>

              <input type="hidden" name="user" value="{{$user->user_id}}">
              <div class="col-md-15 mt-3">
                <b>Usuario:</b> <br>
                {{$user->primer_nombre}} {{$user->primer_apellido}} {{$user->segundo_apellido}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Teléfono:</b> 
                {{$user->telefono}}
              </div>

              <div class="col-md-15 mt-3">
                <b>Email:</b> 
                {{$user->email}}
              </div>
</div>


<div class="col-md-6 float-right">

                  <h4 class="card-title col-md-12 mt-2">Información de pago</h4>

                <div class="col-md-15 mt-3">
                <b>Desde:</b> 
                {{$desde}}
                <input type="hidden" name="desde" value="{{$desde}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Hasta:</b> 
                {{$hasta}}
                <input type="hidden" name="hasta" value="{{$hasta}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto recaudado:</b> 
                {{$monto_recaudado}}
                <input type="hidden" name="monto_recaudado" value="{{$monto_recaudado}}">
              </div>

              <div class="col-md-15 mt-3">
                <b>Monto de comisión:</b> 
                {{$monto_comision}}
                <input type="hidden" name="monto_comision" value="{{$monto_comision}}">
              </div>
</div>
  <button id="confirmar" type="submit" class="btn btn-success mb-1 fa fa-check system-icons mt-3 ml-3 print">Confirmar</button>

  <script src="/js/jquery.js"></script>
  </form>  

