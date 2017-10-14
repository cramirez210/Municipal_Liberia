<div>
  <label class="col-md-auto form-control-label"><h4>Desde</h4></label>

                            <div class="col-md-auto ml-3">
                              <div class="form-group">
                                <input placeholder="Ejemplo: 1997-09-06" type="text" class="form-control" id="desde" name="desde" />
                              </div>
                              
                            </div>
    <label class="col-md-auto form-control-label mt-3"><h4>Hasta</h4></label>

                            <div class="col-md-auto ml-3">
                              <div class="form-group">
                                <input placeholder="Ejemplo: 2010-09-06" type="text" class="form-control" id="hasta" name="hasta" />
                              </div>
                              
                            </div>

        <script>
                    $('#desde').datepicker({ uiLibrary: 'bootstrap4',format: "yyyy-mm-dd",language: "es",iconsLibrary: 'fontawesome',});
                    $('#hasta').datepicker({ uiLibrary: 'bootstrap4',format: "yyyy-mm-dd",language: "es",iconsLibrary: 'fontawesome',});
                    </script>
</div>
     
