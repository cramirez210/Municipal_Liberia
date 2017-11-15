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
    var estado = $('#estado').val();
    var tipo_lista = $('#tipo_lista').val();

    switch(tipo_lista) {
   case "usuarios":
      var rol = $('#rol').val();

      $.get('/usuarios/filtrar/' +criterio + '/' + valor + '/' + estado + '/' + rol, function(result){
      $("#tabla_usuarios").html(result);
       });
      break;

   case "socios":
      $.get('/socios/filtrar/' +criterio + '/' + valor + '/' + estado , function(result){
      $("#tabla_socios").html(result);
       });
      break;

  case "facturas":
    $.get('/facturas/filtrar/' +criterio + '/' + valor + '/' + estado, function(result){
      $("#tabla_facturas").html(result);
       });
    break;

  case "cobros":
    $.get('/cobros/filtrar/' +criterio + '/' + valor + '/' + estado, function(result){
      $("#tabla_cobros").html(result);
       });
    break;

   default:
      alert("Hubo un problema, disculpe.");
}
    
  });
});