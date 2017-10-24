
  <select id="select" class="custom-select mb-2 mb-sm-0" name="Criterio">
    <option selected value="1">N° de factura</option>
    <option value="2">Fecha factura</option>
    <option value="3">Fecha cobro</option>
  </select>

  <label class="custom-control custom-checkbox mb-2 mb-sm-0" style="margin-left: -1.8%;">
        <input id="valor" type="text" class="form-control" placeholder="Buscar" type="text" name="valor" value="{{ old('valor') }}" onkeyup="filtrar()" required autofocus>
  </label>

  