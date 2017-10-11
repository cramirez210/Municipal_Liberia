 function imprSelec($factura){

        var ficha=document.getElementById($factura);
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
    }

  function filtrarFacturas() {
  var select, valor, input, filter, table, tr, td, i;
  select = document.getElementById("select");
  valor = select.options[select.selectedIndex].value;
  input = document.getElementById("valor");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[valor];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}