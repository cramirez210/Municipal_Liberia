
  <select class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="0">N° de factura</option>
    <option value="1">N° de socio</option>
    <option value="2">Nombre</option>
    <option value="3">Categoría</option>
    <option value="4">Periodo</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" required autofocus>
        @if(isset($estado_id))
        <input name="estado" type="hidden" value="{{$estado_id}}">
        @else
        <input name="estado" type="hidden" value="0">
        @endif
        
        <button type="submit" class="btn btn-success ml-2" >Buscar</button>
  </label>

  