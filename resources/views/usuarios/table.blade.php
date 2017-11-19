<div class="table-responsive ml-4">
        
    <table WIDTH="100%" class="table table-hover" >
        <thead>
            <tr>
            <th class="text-center w-10">ID</th>
            <th class="text-center w-20">Usuario</th>
            <th class="text-center w-30">Nombre completo</th>
            <th class="text-center w-20">Cédula</th>
            <th class="text-center w-10">Rol</th>
            <th class="text-center w-10">Opciones</th>
            </tr>
        </thead>
    <tbody>

        @if($usuarios !== null)
         @forelse($usuarios as $usuario)
                       
        <tr>
            <td class="info" > {{$usuario->user_id}} </td>
            <td class="info" > {{$usuario->nombre_usuario}} </td>
            <td class="info" > {{$usuario->primer_nombre}} {{$usuario->primer_apellido}} {{$usuario->segundo_apellido}} </td>
            <td class="info" > {{$usuario->cedula}} </td>
            <td class="info" >  {{$usuario->rol}} </td>
            <td class="info"> 
                 <button type="button" class="btn btn-info btn-sm detail-user" data-toggle="modal" data-target="#modal">Detalle</button>
            </td>
        </tr>
        @empty
        <div class="card-text text-warning">No existen usuarios registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($usuarios))

       {{ $usuarios->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

    @endif
@include('modal')
</div>

