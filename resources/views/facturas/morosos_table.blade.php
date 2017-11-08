
 <div class="table-responsive mr-5">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Nombre completo</th>
            <th class="text-center">Facturas pendientes</th>
            <th class="text-center">Email</th>
            <th class="text-center">Teléfono</th>
            </tr>
        </thead>
    <tbody>

         @forelse($morosos as $moroso)
                       
        <tr>
            <td class="info"> {{ $moroso->primer_nombre }} {{ $moroso->primer_apellido }} {{ $moroso->segundo_apellido }} </td>
            <td class="info"> <a href="/facturas/pendientes/{{$moroso->id}}/3">{{ $factura->ObtenerPorSocioEstado($moroso->id, 3)->count() }}</a>  </td>
            <td class="info"> {{ $moroso->email }} </td>
            <td class="info"> {{ $moroso->telefono }} </td>
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