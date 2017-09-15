 
@extends('layouts.app')

@section('content')

<!--_______________________________ Tabla _____________________________-->
<div class="card text-center mt-4">

<div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <label class="nav-link text-primary" href="#">Listado de roles para Usuarios</label>
      </li>
    </ul>
</div>

<div class="col-md-8 offset-md-2 mt-4">
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover" >
        <thead>
            <tr>
            <th class="text-center">Nombre de rol</th>
            <th class="text-center">Descripción</th>
            </tr>
        </thead>
    <tbody>

         @forelse($roles as $rol)
                       
        <tr>
            <td class="info" > {{$rol->rol}} </td>
            <td class="info" > {{$rol->descripcion}} </td>
        </tr>

        

        @empty
        <div class="card-text text-warning">No existen roles registrados.</div>
        <br>
        @endforelse

    
    </tbody>

    </table>

     <div class="mt-2 mx-auto">
        @if(count($roles))

       {{ $roles->links('pagination::bootstrap-4') }}

        @endif 

    </div>   

        </div>
    </div>

 </div>

</div>


@endsection

@section('titulo')
Lista de roles
@endsection