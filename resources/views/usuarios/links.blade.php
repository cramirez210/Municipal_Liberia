
        <ul class="navbar-nav">
        <li class="nav-item dropdown mt-2">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
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
            <a class="dropdown-item text-success" href="/usuarios/cobros/{{ $usuario->id }}">Ver cobros efectuados</a>
        </div>
    </li>

    </ul>