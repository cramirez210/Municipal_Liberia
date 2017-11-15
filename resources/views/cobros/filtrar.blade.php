
  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">Periodo</option>
    <option value="2">Fecha cobro</option>
    <option value="3">Usuario</option>
    <option value="4">Nombre completo</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($estado_id))
        <input id="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input id="estado" type="hidden" value="0">
        @endif

        <input id="tipo_lista" type="hidden" value="cobros">
        <button id="filtrar" type="button" class="btn btn-success ml-2" >Buscar</button>
  </label>

  