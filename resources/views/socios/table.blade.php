

 <div class="table-responsive">
        
    <table id="table" class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Carnet</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Ejecutivo</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Opcion</th>
            </tr>
        </thead>
    <tbody>
        
        @if($socios != null)
         @forelse($socios as $socio)
                       
        <tr>
            <td class="info text-center"> {{ $socio->id }} </td>
            <td class="info text-center"> {{ $socio->primer_nombre }} </td>
            <td class="info text-center"> {{ $socio->primer_apellido }} {{ $socio->segundo_apellido }} </td>
            <td class="info text-center"> {{ $socio->categoria }} </td>
            <td class="info text-center"> {{ $socio->nombre_usuario }} </td>
            <td class="info text-center"> {{ $socio->estado }} </td>
            <td class="warning text-center"> 
              
              <a href="/socios/show/{{ $socio->id }}" class="btn btn-success">
                  <span class="glyphicon glyphicon-remove-circle"></span>Detalle</a>

            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay Datos Registradas </span>

        </div>
        <br>
        @endforelse

        @endif
    </tbody>
    </table>  

    </div>