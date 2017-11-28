
 <div class="table-responsive mr-5">
        
    <table id="table" class="table table-hover text-center">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
            <th class="text-center">N° socio</th>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Monto</th>
            <th class="text-center">Periodo</th>
            <th class="text-center">Fecha de factura</th>
            <th class="text-center">Estado</th>
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
            <td class="info"> {{ date('m-Y', strtotime($factura->periodo)) }} </td>
            <td class="info"> {{ date('d-m-Y', strtotime($factura->created_at)) }} </td>
            <td class="info"> {{ $factura->estado }} </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraron datos. </span>

        </div>
        <br>
        @endforelse

    </tbody>
    </table>
    </div>