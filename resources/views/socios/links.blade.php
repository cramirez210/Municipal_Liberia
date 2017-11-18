<div id="links" class="float-right ml-5">
      <ul class="navbar-nav ml-5">  

     <li class="nav-item dropdown ml-5" id="opciones">
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Acción</a>
        
        <div class="dropdown-menu">
            <a class="dropdown-item text-warning" href="/socios/show/edit/{{ $socio->id }}">Actualizar</a>

        <div class="dropdown-divider"></div>
             @if($socio->estado_id == 2)
            <a class="dropdown-item text-success" href="/socios/estado/{{ $socio->id }}">Activar</a>
            @else
            <a class="dropdown-item text-danger" href="/socios/estado/{{ $socio->id }}">Inactivar</a>
            @endif
        </div>
    </li>
  </ul>
</div>