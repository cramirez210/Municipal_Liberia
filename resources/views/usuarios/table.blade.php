<div class="table-responsive">
        
    <table id="table" class="table table-hover" >
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
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No se encontraon socios</span>

        </div>
        <br>
        @endforelse
        @endif 
    
    </tbody>

    </table>
 
@include('modal')
</div>

