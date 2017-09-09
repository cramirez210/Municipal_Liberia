 
@extends('layouts.app')

@section('content')

 <div class="col-md-8 offset-md-2 mt-4">

 <h2 class="h3 float-right">Gestion de Categorias</h2>
 <br>
    <h2 class="h4 text-primary">Incluir Categoria</h2>
 <div class="panel panel-default">
     
    <form class="form-inline" method="POST" action="/categoria/create">
                        {{ csrf_field() }}


@include('categoria.formulario')
<!--_______________________________ Tabla _____________________________-->
<br>
<div class="row">

 <div class="table-responsive">
        
    <table class="table table-hover ">
        <thead>
            <tr>
            <th>Categoria</th>
            <th>Precio Categoria</th>
            <th>Opciones</th>
            </tr>
        </thead>
    <tbody>

         @forelse($categorias as $categoria)
                       
        <tr>
            <td class="info"> {{$categoria->categoria}} </td>
            <td class="info"> ₡{{$categoria->precio_categoria}} </td>
            <td class="warning"> 
                 <a href="/categoria/{{$categoria->id}}" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="card-text text-warning">No hay Categorias Registradas</div>
        <br>
        @endforelse

       

    </tbody>
    </table>

     <div class="mt-2 mx-auto">
        @if(count($categorias))

       {{ $categorias->links('pagination::bootstrap-4') }}

        @endif 
    </div>   

        </div>
    </div>

</div>


@endsection

@section('titulo')
Categorias Socios 

@endsection