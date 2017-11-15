
 <div class="table-responsive mr-5">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">N° factura</th>
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
            <td class="info"> {{ $factura->categoria }} </td>
            <td class="info"> {{ $factura->monto }} </td>
            <td class="info"> {{ date('m-Y', strtotime($factura->periodo)) }} </td>
            <td class="info"> {{ $factura->estado }} </td>
            <td class="warning">
              <button type="button" class="btn btn-info btn-sm detail-factura" data-toggle="modal" data-target="#modal">Detalle</button> 
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

    @include('modal')  
    
    <script src="/js/jquery.js"></script>
    </div>