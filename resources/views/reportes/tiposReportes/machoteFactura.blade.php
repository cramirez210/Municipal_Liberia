<div class="row d-flex align-items-center">
  <div class="col-1 d-flex justify-content-center">
    <img class="reporte-imagen-factura" src="{{ asset('storage/img/logo.png') }}" alt="Logo Municipal Liberia">
  </div>
  <div class="col-6">
    <p class="p-factura-titulo"><b>Asociación Deportiva Municipal Liberia</b></p>
    <p class="p-factura"><small>Cédula jurídica: 3-002-051581</small></p>
    <p class="p-factura"><small>Liberia, Guanacaste</small></p>
    <p class="p-factura-titulo-infe"><b>EXCLUSIVO PARA SOCIOS</b></p> 
  </div>
  <div class="col-3">
    <div class="row">
      <div class="col-12">
       <input class="text-danger text-center round" type="text" value="Nº {{$factura->id}}" readonly>
      </div>
      <div class="col-12">
        <input class="text-center sdisabled round" type="text" value="{{$hora}}" readonly>
      </div>
    </div>
  </div>
</div>

<div class="row tabla-tamaño tabla-imprimir pt-2">
 <table class="table table-bordered table-sm">

  <tbody>
    <tr>
      <td colspan="2">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-3 ml-5 texto-imprimir">
                <p class="pt-2"><b>RESIVIMOS DE:</b></p>
              </div>
              <div class="col-5">
                <p class="pt-2">{{$factura->primer_nombre}} {{$factura->primer_apellido}} {{$factura->segundo_apellido}}</p>
              </div>
              <div class="col-3">
                <p class="pt-2"><b>N° SOCIO:  </b>{{$factura->socio_id}}</p>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-3 ml-5 texto-imprimir">
                <p><b>LA SUMA DE:</b></p>
              </div>
              <div class="col-6">
                <input class="text-center sdisabled round" type="text" value="₡ {{$factura->monto}}" readonly>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-4 ml-5 texto-imprimir">
                <p class="pt-2"><b>CATEGORIA:</b></p>
              </div>
              <div class="col-4">
                <p class="pt-2"><u>{{$factura->categoria}}</u></p>
              </div>
            </div>
          </div>
        </div>
      </td>
      <td>
        <div class="row">
          <div class="col-5">
            <p class="pt-2"><b>PERIODO:</b></p>
          </div>
          <div class="col-7">
            <p class="pt-2"> {{date('m-Y', strtotime($factura->periodo))}}</p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="row">
          <div class="col-11 ml-5 texto-imprimir">
            <p class="pt-2 pr-0"><b>CONCEPTO DE:&emsp;&nbsp;</b><b class="texto-peque text-justify">Pago de mensualidad al A.D.M Liberia</b></p>
          </div>
        </div>
      </td>
      <td>
        <div class="row">
          <div class="col-12">
            <p class="pt-2"><b>GENERADO: </b>&nbsp;{{$factura->nombre_usuario}}</p>
          </div>
        </div>
      </td>
    </tr>
    @if($factura->forma_pago !="")
    <tr>
      <td colspan="2">
        <div class="row d-flex justify-content-center">
          <div class="col-3 ml-5">
            <p class="pt-2"><b>FORMA DE PAGO:</b></p>
          </div>
          <div class="col-3">
            <p class="pt-2"><u>{{$factura->forma_pago}}</u></p>
          </div>
        </div>
      </td>
    </tr>
    @endif
  </tbody>
</table> 
</div>

<style type="text/css" media="print">
  @page{
   margin: 0;
}
</style>