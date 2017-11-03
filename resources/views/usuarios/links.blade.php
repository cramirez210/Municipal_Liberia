
                            <ul class="nav nav-pills nav-fill card-header-pills">
        <li class="nav-item dropdown mt-2" id="opciones">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/personas/editar/{{ $usuario->id }}">Actualizar</a>

            @if($usuario->estado_id == 2)
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuario/estado/{{ $usuario->id }}">Activar</a>
            @else
        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="/usuario/estado/{{ $usuario->id }}">Inactivar</a>
            @endif


         <div class="dropdown-divider"></div>
            <a class="dropdown-item text-info" href="/usuarios/socios/{{ $usuario->id }}">Ver socios relacionados</a>

        <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success" href="/usuarios/cobros/{{ $usuario->id }}">Ver cobros efectuados</a>
        </div>
    </li>

    </ul>