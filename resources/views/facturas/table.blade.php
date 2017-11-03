
 <div class="table-responsive mr-5">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">N° socio</th>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Periodo</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info"> {{ $factura->id }} </td>
            <td class="info"> {{ $factura->socio_id }} </td>
            <td class="info"> {{ $factura->primer_nombre }} {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </td>
            <td class="info"> {{ $factura->categoria }} </td>
            <td class="info"> {{ $factura->monto }} </td>
            <td class="info"> {{ date('m-Y', strtotime($factura->created_at)) }} </td>
            <td class="info"> {{ $factura->estado }} </td>
            <td class="warning">
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$factura->id}}">Detalle</button>

                    <div id="{{$factura->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detalle de factura</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
                            @include('facturas.detail')
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>

                      </div>
                    </div>
            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron facturas </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    </div>