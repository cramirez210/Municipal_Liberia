<div id="links" class="float-right ml-5">
        <ul class="navbar-nav ml-5">
        <li class="nav-item dropdown ml-5">
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/personas/editar/{{ $usuario->id }}">Actualizar</a>
            
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuario/estado/{{ $usuario->id }}">
            @if($usuario->estado_id == 2)
            Activar
            @else
            Inactivar
            @endif
        </a>

         <div class="dropdown-divider"></div>
            <a class="dropdown-item text-info" href="/usuarios/socios/{{ $usuario->id }}">Ver socios relacionados</a>
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="/usuarios/transferir/{{ $usuario->id }}">Transferir socio</a>
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuarios/cobros/{{ $usuario->id }}">Ver cobros efectuados</a>
        </div>
    </li>

    </ul>    
</div>
