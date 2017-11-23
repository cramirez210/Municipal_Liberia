 $(document).ready(function(){

$('.imprimir').on('click', function(){
    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/imprimir/factura/'+id, function(result){
    
       var ventimp=window.open(' ','popimpr');
        ventimp.document.write(result);
        ventimp.document.close();
        ventimp.print();
        ventimp.close(); 
       });
    
  });

$('#buscar_moroso').on('click', function(){
    var criterio = $('#select').val();
    var valor = $('#valor').val();

  $.get('/facturas/socios/morosos/consultar/' + criterio + "/" + valor, function(result){

    $('#socio_moroso').html(result);
       });
    
  });

$('#buscar_ejec_moroso').on('click', function(){
    var criterio = $('#select_ejec').val();
    var valor = $('#valor_ejec').val();

  $.get('/cobros/usuarios/morosos/consultar/' + criterio + "/" + valor, function(result){

    $('#ejecutivo_moroso').html(result);
       });
    
  });

$('.modal').on('hidden.bs.modal', function(){
    $('#socio_moroso').html("");
    $('#ejecutivo_moroso').html("");
});

  $('.detail-factura').on('click', function(){

    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/facturas/show/id/' + id, function(result){

         $("#modal_tittle").text("Detalle de factura");
         $("#modal_content").html(result);
       });
  });

  $('.detail-cobro').on('click', function(){

    var factura_id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/cobros/show/' + factura_id, function(result){

         $("#modal_tittle").text("Detalle de cobro");
         $("#modal_content").html(result);
       });
  });

  $('.detail-user').on('click', function(){

    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/personas/mostrar/' + id, function(result){

         $("#modal_tittle").text("Detalle de usuario");
         $.get('/usuarios/get/links/' + id, function(links){

         $("#modal_tittle").append(links);
       });
         $("#modal_content").html(result);
       });
  });

  $('.detail-socio').on('click', function(){

    var id = $(this).parents("tr").find("td").eq(0).text();

    $.get('/socios/show/' + id, function(result){

         $("#modal_tittle").text("Detalle de socio");
         $.get('/socios/get/links/' + id, function(links){

         $("#modal_tittle").append(links);
       });
         $("#modal_content").html(result);
       });
  });
});