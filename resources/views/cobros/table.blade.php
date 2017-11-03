
 <div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Usuario</th>
            <th class="text-center">N° de factura</th>
            <th class="text-center">Periodo</th>
            <th class="text-center">Fecha cobro</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($cobros as $cobro)
                       
        <tr>
            <td class="info"> {{ $cobro->primer_nombre }} {{ $cobro->primer_apellido }} {{ $cobro->segundo_apellido }} </td>
            <td class="info"> {{ $cobro->factura_id }} </td>
            <td class="info"> {{ date('m-Y', strtotime($cobro->fecha_factura)) }} </td>
            <td class="info"> {{ date('d-m-Y', strtotime($cobro->created_at)) }} </td>
            <td class="info"> {{ $cobro->monto }} </td>
            <td class="info"> {{ $cobro->estado }} </td>
            <td class="warning"> 
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$cobro->id}}">Detalle</button>

                    <div id="{{$cobro->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Detalle de cobro</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body text-left">
                            @include('cobros.detail')
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
       
        <span class="card-text text-warning "> No hay cobros registrados </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>  

    </div>