function imprSelec($factura){

        var ficha=document.getElementById($factura);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
    }

function seleccionar_todo(){
   for (i=0;i<document.form_liquidar_cobro.elements.length;i++)
      if(document.form_liquidar_cobro.elements[i].type == "checkbox")
         document.form_liquidar_cobro.elements[i].checked=1
} 

function deseleccionar_todo(){
   for (i=0;i<document.form_liquidar_cobro.elements.length;i++)
      if(document.form_liquidar_cobro.elements[i].type == "checkbox")
         document.form_liquidar_cobro.elements[i].checked=0
} 
/*  function filtrar() {
  var select, valor_select, input, filter, table, tr, td, i;
  select = document.getElementById("select");
  valor_select = select.options[select.selectedIndex].value;
  input = document.getElementById("valor");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[valor_select];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}*/