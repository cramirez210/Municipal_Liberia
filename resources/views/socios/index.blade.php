@extends('layouts.app')

@section('content')


    @if(session('success')) 
    <br>
    <span class="text-success mt-4">
        
        <label class="alert alert-success">{{ session('success') }}</label>

    </span>

    @endif  
<!--_______________________________ Tabla _____________________________-->
<div class="card text-center mt-4"> 
<div class="col-md-8 offset-md-2 mt-4">

<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th class="text-center">Cedula</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Categoria</th>
            <th class="text-center">Ejecutivo</th>
            <th class="text-center">Estado</th>
            </tr>
        </thead>
    <tbody>

         @forelse($socios as $socio)
                       
        <tr>
            <td class="info"> {{$socio->$persona->cedula}} </td>
            <td class="info"> {{$socio->$persona->primer_nombre}} </td>
            <td class="info"> {{$socio->$persona->primer_apellido}} </td>
            <td class="info"> {{$socio->$categoria->categoria}} </td>
            <td class="info"> {{$socio->$usuario->nombre_usuario}} </td>
            <td class="warning"> 
                 <a href="/estados/{{$socio->id}}" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>{{$socio->$estado->estado}}</a>
            </td>
        </tr>

        @empty
        <div class="alert alert-warning">
       
        <span class="card-text text-warning "> No hay Datos Registradas </span>

        </div>
        <br>
        @endforelse

       

    </tbody>
    </table>

     <div class="mt-2 mx-auto">
        @if(count($socios))

       {{ $socios->links('pagination::bootstrap-4') }}

        @endif 
    </div>   

        </div>
    </div>

 </div>

</div>

@endsection

@section('titulo')

Socios

@endsection