
 <div class="table-responsive mr-5">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">Socio</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>

         @forelse($facturas as $factura)
                       
        <tr>
            <td class="info"> {{ $factura->id }} </td>
            <td class="info"> {{ $factura->primer_nombre }} </td>
            <td class="info"> {{ $factura->primer_apellido }} {{ $factura->segundo_apellido }} </td>
            <td class="info"> {{ $factura->categoria }} </td>
            <td class="info"> {{ $factura->monto }} </td>
            <td class="info"> {{ $factura->created_at }} </td>
            <td class="info"> {{ $factura->estado }} </td>
            <td class="warning"> 
              @if($factura->estado_id == 3)
              <a href="/facturas/edit/{{$factura->id}}" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Cobrar</a>
              @else
              <a href="/facturas/show/id/{{$factura->id}}" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Detalle</a>
              @endif
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