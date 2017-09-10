<div class="panel panel-default">
     
    <form class="form-inline" method="POST" action="/estados/create">
                        {{ csrf_field() }}

    <!--_______________________________ Nombre Estado ______________________________-->

<div class="form-group{{ $errors->has('estado') ? ' has-danger' : '' }}">
    <label for="estado" class="col-md-5 form-control-label">Nuevo Estado</label>

    <div class="col-md-3 ">
        <input id="estado" placeholder="Ejemplo: Activo" type="text" class="form-control" name="estado" value="{{ old('estado') }}" required autofocus>

         
    </div>
                           

</div>
    <!--_______________________________ Botón _____________________________-->

    <div class="float-right">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
               Registrar Estado
            </button>
        </div>
    </div>



    </form>




 <!--_______________________________ Validacion Campos _____________________________-->
        
        @if ($errors->has('estado'))
            <span class="form-control-feedback">
                <strong class="text-danger">{{ $errors->first('estado') }}</strong>
            </span>
        @endif  
        <br>
</div>