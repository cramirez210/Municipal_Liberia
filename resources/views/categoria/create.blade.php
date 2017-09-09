 
@extends('layouts.app')

@section('content')

 <div class="col-md-8 offset-md-2 mt-4">

 <h2 class="h3 float-right">Gestion de Categorias</h2>
 <br>
    <h2 class="h4">Incluir Categoria</h2>
 <div class="panel panel-default">
     
    <form class="form-inline" method="POST" action="/categoria/create">
                        {{ csrf_field() }}


    <!--_______________________________ Nombre Categoria ______________________________-->

<div class="form-group{{ $errors->has('categoria') ? ' has-danger' : '' }}">
    <label for="categoria" class="col-md-5 form-control-label">Nueva Categoria</label>

    <div class="col-md-3 ">
        <input id="categoria" placeholder="Ejemplo: Sol" type="text" class="form-control" name="categoria" value="{{ old('categoria') }}" required autofocus>

         @if ($errors->has('categoria'))
            <span class="form-control-feedback">
                <strong>{{ $errors->first('categoria') }}</strong>
            </span>
        @endif
    </div>
                           

</div>

 <!--_______________________________ Precio Categoria ______________________________-->

    <div class="form-group{{ $errors->has('precio_categoria') ? ' has-danger' : '' }}">
        <label for="precio_categoria" class="col-md-5 form-control-label">Precio Categoria</label>

     <div class="col-md-3 mt-2">
        <input id="precio_categoria" placeholder="Ejemplo: ₡5000" type="text" class="form-control" name="precio_categoria" value="{{ old('precio_categoria') }}" required autofocus>

        @if ($errors->has('precio_categoria'))
            <span class="form-control-feedback">
                <strong>{{ $errors->first('precio_categoria') }}</strong>
            </span>
        @endif
    </div>
                           

    </div>



    <!--_______________________________ Botón _____________________________-->

    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
               Registrar Categoria
            </button>
        </div>
    </div>



    </form>


 </div>
        
            

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
            <td class="info"> {{$categoria->precio_categoria}} </td>
            <td class="warning"> 
                 <a href="/archivos/{{$categoria->id}}/eliminar" class="btn btn-success btn-xs">
                     <span class="glyphicon glyphicon-remove-circle"></span>Actualizar</a>
            </td>
        </tr>

        @empty
        <div class="card-text text-muted">No hay Categorias Registradas</div>
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
Categorias de Socios 

@endsection