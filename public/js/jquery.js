 $(document).ready(function(){

$('#gj').on('click', function(){

    $.get('/imprimir/factura/'+id, function(result){
    
       var ventimp=window.open(' ','popimpr');
        ventimp.document.write(result);
        ventimp.document.close();
        ventimp.print();
        ventimp.close(); 
       });
    
  });

$("input:checkbox").on('click', function(){

    var monto_liquidar = 0;
   
   $('.check:checked').each(

    function() {
      monto_liquidar = monto_liquidar + parseFloat($(this).parents("tr").find("td").eq(4).text());
    }
);
    var monto =  Math.floor(monto_liquidar);
    $('#monto_liquidar').html(monto);
});

    var monto_liquidar = 0;
   
   $('.check:checked').each(

    function() {
      monto_liquidar = monto_liquidar + parseFloat($(this).parents("tr").find("td").eq(4).text());
    }
);
    var monto =  Math.floor(monto_liquidar);
    $('#monto_liquidar').html(monto);

$('#confirmar').on('click', function(){

        var ficha=document.documentElement;
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close(); 
    
  });

$('#buscar_moroso').on('click', function(){
    var criterio = $('#select').val();
    var valor = $('#valor').val();

  $.get('/facturas/socios/morosos/consultar/' + criterio + "/" + valor, function(result){

    $('#socio_moroso').html(result);
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

  $('#confirmar_comision').on('click', function(){
    var user = $('#user').val();
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
    var monto = $('#monto').val();
    var comision = $('#comision').val();


    $("#pagar_comision").modal('toggle');

    if($('#comision').val().length <= 0){

         $("#modal_tittle").text("Mensaje");
         $("#modal_content").html("<div class='alert alert-warning text-warning'>"+
          "<b>Por favor llene el campo porcentaje de comision</b></div>");
         $('#modal').on('hidden.bs.modal', function(){
    $("#pagar_comision").modal('toggle');
});
    }else if(isNaN($('#comision').val())){

      $("#modal_tittle").text("Mensaje");
         $("#modal_content").html("<div class='alert alert-warning text-warning'>"+
          "<b>El campo porcentaje de comisión solo acepta números</b></div>");
          $('#modal').on('hidden.bs.modal', function(){
    $("#pagar_comision").modal('toggle');
});
    }else{

      $.get("/comisiones/usuario/"+ user +"/"+ desde +"/"+ hasta +"/"+ monto +"/"+ comision, 
      function(result){
         
         $("#modal_tittle").text("Confirmar pago de comisión");
         $("#modal_content").html(result);
    });
    }


    
  });
});