 $(document).ready(function(){

  $('.detail-factura').on('click', function(){

    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/facturas/show/id/' + id, function(result){

         $("#modal_tittle").text("Detalle de factura");
         $("#modal_content").html(result);
       });
  });

  $('.detail-cobro').on('click', function(){

    var factura_id = $(this).parents("tr").find("td").eq(2).text();

    $.get('/cobros/show/' + factura_id, function(result){

         $("#modal_tittle").text("Detalle de cobro");
         $("#modal_content").html(result);
       });
  });

  $('.detail-user').on('click', function(){

    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/personas/mostrar/' + id, function(result){

         $("#modal_tittle").text("Detalle de usuario");
         $("#modal_content").html(result);
       });
  });

  $('#filtrar').on('click', function(){

    var criterio = $('#select').val();
    var valor = $('#valor').val();

    $.get('/facturas/filtrar/' +criterio + '/' + valor, function(result){

      $("#tabla_facturas").empty();
      $("#tabla_facturas").html(result);
       });
  });
    
});