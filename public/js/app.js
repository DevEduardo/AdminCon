$(document).ready(function(){

  function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split(','),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join(',');
  }

  $('.delete').click(function(e){
    e.preventDefault();
    $('#ModalDanger').modal('show');
  });

  $('#month').change(function(){
    var href = $('#_gastos').attr('href');
    var newHref = href + '/' + $(this).val();
    $('#_gastos').attr('href', newHref);
  });

  $('#monthCobro').change(function(){
    var href = $('#_cobro').attr('href');
    var newHref = href + '/' + $(this).val();
    $('#_cobro').attr('href', newHref);
  });

  $('#year').change(function(){
    var href = $('#_cuotas').attr('href');
    var newHref = href + '/' + $(this).val();
    $('#_cuotas').attr('href', newHref);
  });

  $('#monthFactura').change(function(){
    var href = $('#_facturas').attr('href');
    var newHref = href + '/' + $(this).val();
    $('#_facturas').attr('href', newHref);
  });

  $('#_salon').click(function(){
    var id = $(this).data('id');
    $('#salonIput').val(id);
    $('#salonModal').modal('show');
  });


  $('#_gastos').click(function(){
    location.reload();
  });

  $('#_cobros').click(function(){
    location.reload();
  });

  $('#_cuotas').click(function(){
    location.reload();
  });

  function round(num, decimales = 2) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0) //con 0 decimales
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
  }

  $('[data-toggle="tooltip"]').tooltip();

  $('.pagos').datepicker({
    dateFormat: 'm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
  });

  $('.date').datepicker().datepicker("setDate", new Date());;
  $('.date2').datepicker();

  $('#recentPayments').click(function(e){
    e.preventDefault();
    $('#paymentsModal').modal('show');
  });  

  $('#finance').click(function(){
    if ($(this).prop('checked')) {
      $('#_finance').show();
    }else {
      $('#_finance').hide();
    }
  });

  $('#expenses').click(function(){
    if ($(this).prop('checked')) {
      $('#_finance').show();
      $('#_bil').hide();
    }
  });

  $('#bil').click(function(){
    if ($(this).prop('checked')) {
      $('#_bil').show();
      $('#_finance').hide();
    }
  });

  $('#estimate').change(function(){

    if ($(this).val() == 8 || $(this).val() == 1 || $(this).val() == 2) {
      $('#_manual').show();
    }else{
      $('#_manual').hide();
    }
  });

  $('#createAgencies').click(function(e){
    e.preventDefault();
    $('#_shapePayments').hide();
    $('#createAgency').show();
  });
  $('#cancel').click(function(e){
    e.preventDefault();
    $('#_shapePayments').show();
    $('#createAgency').hide();
  });

  $('.expense').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#_expense-' + id).show();
    $('#expense-' + id).hide();
  });

  $('.closee').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#_expense-' + id).hide();
    $('#expense-' + id).show();
  });

  $('.submint').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $('#form-' + id).submit();
    $('#_expense-' + id).hide();
    $('#expense-' + id).show();
  });

  $('#month').change(function(e){
    e.preventDefault();
    $('#formMes').submit();
  });

  $('#submintExpense').change(function(e){
    e.preventDefault();
    $('#formGastos').submit();
  });

  var count = 0;
  var total = 0;
  var iva   = 0;

  $('#number').on('keyup', function(){
        var value = $(this).val();
        $.ajax({
          type: 'GET',
          url: '/search/invoice/'+ value,
          data: {value:value},
          success: function(data){
            if (data == 200) {
              $('#success').html('* El numero de factura esta disponible');
              $('#danger').html('');
              $('#submintFac').removeAttr('disabled');
            }else{
              $('#danger').html('* El numero de factura ya esta en uso');
              $('#success').html('');
              $('#submintFac').attr('disabled','on');
            }
          }
        });
    }).keyup();

  $('#total').maskMoney({thousands:'.', decimal:',', allowZero:true});
  $('#submintAgregar').click(function(){
    var td0 = $('#quantity').val();
    var td1 = $('#concept').val();
    var td2 = $('#total').val();
    count += 1;
    capa = document.getElementById("_data");
    var tr = document.createElement("tr");
    var td = '';
    td += '<td> '+td0 + '</td>';
    td += '<td> '+td1 + '</td>';
    td += '<td> Bs '+td2+ '</td>';
    tr.innerHTML = td;
    capa.appendChild(tr);

    var capa2 = document.getElementById("inputHidden");
    var div = document.createElement("div");
    div.innerHTML= '<input type="hidden" value="'+td0+'" name="quantity[]" /><input type="hidden" value="'+td1+'" name="concept[]" /><input type="hidden" value="'+td2+'" name="stotal[]" />';
    capa2.appendChild(div);
     var num = td2.replace('.','');
    total += parseInt(num);
    iva = total * 0.12;

    var capa3 = document.getElementById('sGeneral');
    capa3.innerHTML =number_format(total,2);

    var capa4 = document.getElementById('tIva');
    capa4.innerHTML = number_format(iva,2);

    var capa5 = document.getElementById('tGeneral');
    var toalIva = 0;
    toalIva = total + iva;
    capa5.innerHTML = number_format(toalIva,2);

    $('#numberInput').val(count);
    $('#_total').val(round(total));
    $('#_iva').val(round(iva));

    $('#quantity').val('');
    $('#concept').val('');
    $('#total').val('');

  });
1
  $('#submintFactura').click(function(){
    $('#factura').submit();
  });

  $('#_Share').change(function(e){
    e.preventDefault();
    var option = $(this).val();
    if (option == 1) {
      $('#extra').show();
      $('#expenseTable').hide();
    }else{
      $('#extra').hide();
      $('#expenseTable').show();
    }
  });

  $('#SubmintClear').click(function(){
      $('#extra').hide();
      $('#expenseTable').show();
      var checkbox = $('.checkClear');
      var checkbox1 = $('.apply');
      for (var i = 0; i < checkbox.length; i++) { checkbox[i].checked=false;}
      for (var i = 0; i < checkbox1.length; i++) {checkbox1[i].checked=false;}
  });

  $('#closeExtra').click(function(e){
    e.preventDefault();
      $('#extra').hide();
      $('#expenseTable').show();
      var checkbox = $('.checkClear');
      var checkbox1 = $('.apply');
      for (var i = 0; i < checkbox.length; i++) { checkbox[i].checked=false;}
      for (var i = 0; i < checkbox1.length; i++) {checkbox1[i].checked=false;}
  });

  $('#MarkAll').click(function() {
  var checkbox = $('.apply');
    for (var i = 0; i < checkbox.length; i++) {
      checkbox[i].checked=true;
    }
  });

  $('#uncheck').click(function() {
    var checkbox = $('.apply');
      for (var i = 0; i < checkbox.length; i++) {
        checkbox[i].checked=false;
      }
  });

  $('.check').click(function(){
      var sum =0;
      var total=0;
      $('.check').each(function(indice,elemento){
        if (elemento.checked==true) {
          sum = sum + parseFloat(elemento.value);

        }else if(elemento.checked==false){
          total = (total - parseFloat(elemento.value))*(-1);
        }
        total = sum;
      });
      $('#monto').html(round(total));
      $('#amount').val(round(total));
    });

  //Payment Methods
  $('#wayToPay').change(function(e){
    e.preventDefault();
    var option = $(this).val();
    if (option == '') {
      $('._transfer').hide();
      $('._check').hide();
    }else if (option == 0 || option == 1) {
      $('._transfer').show();
      $('._check').hide();
      $('._card').hide();
    }else if(option == 2){
      $('._check').show();
      $('._transfer').hide();
      $('._card').hide();
    }else if(option == 3){
      $('._card').show();
      $('._transfer').hide();
      $('._check').hide();
    }
    else if(option == 4){
      $('._card').hide();
      $('._transfer').hide();
      $('._check').hide();
    }
  });



  $('#funds').click(function(){
    $.ajax({
      type: 'GET',
      url: 'calcular/fondos',
      success: function(data){
        location.reload();
      }
    });
  });

  $('#cuotas').click(function(e){
    e.preventDefault();
    $.ajax({
      type:'GET',
      url: 'calcular',
      success: function(data){
          console.log(data);
          var tabla = '<table class="table">';
          tabla += '<thead class="teal white-text">';
          tabla += '<tr>';
          tabla += '<th>Inmueble</th><th>Propietario</th><th>Cuota</th>';
          tabla += '</tr>';
          tabla += '</thead>';
          tabla += '<tbody>';
          tr = '';

          for (i = 0; i < data.length; i++){
              tr += '<tr>';
              tr += '<td>'+data[i].numebreProperty+'</td><td>'+ data[i].owner +'</td><td id="cantidad"> Bs. '+ number_format(data[i].amount,2) +'</td>';
              tr += '</tr>';
          }

          tabla += tr;
          tabla += '</tbody></table>';

          $('#cuotasGeneradas').html( tabla );
          $('#cuotasModal').modal('show');
      }
    });
  });


  $('.deleteAgency').click(function(e){
    e.preventDefault();
    var c = confirm('Realmente desea eliminar el registro');
    if (c) {
      var id = $(this).data('id');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: 'DELETE',
        url: 'agencias/' + id,
        success: function(data){
          location.reload();
        }
      });
    }
    
  }); 

  $('.deleteExpense').click(function(e){
    e.preventDefault();
    var c = confirm('Al eliminarlo Debera realizar nuevamente el calculo de fondos.\n \nRealmente desea eliminar el registro.');
    if (c) {
      var id = $(this).data('id');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: 'DELETE',
        url: 'gastos/' + id,
        success: function(data){
          location.reload();
        }
      });
    }
    
  }); 

  $('.deleteBill').click(function(e){
    e.preventDefault();
    var c = confirm('Al eliminarlo Debera realizar nuevamente el calculo de fondos.\n \nRealmente desea eliminar el registro.');
    if (c) {
      var id = $(this).data('id');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: 'DELETE',
        url: 'cuentas/' + id,
        success: function(data){
          location.reload();
        }
      });
    }
    
  });

  $('.item').click(function(){
    var id = $(this).data('id');
    $('#condominium-' + id).submit();
  });

  $('#_cuotasCerrar').click(function(e){
    e.preventDefault();
    location.reload();
  });

  $('#businessName').change(function(e){
    e.preventDefault();
    var id = $(this).val(); 
      $.ajax({
        type: 'GET',
        url: 'getData/' + id,
        success: function(data){
          $('#document').val(data.document);
          $('#phone').val(data.phone);
          $('#document').focus();
          $('#phone').focus();
        }
      });
    
  }); 

  $('#calculation').change(function(){
    if ($(this).val() == 1) {
      $('#_amount').show();
    }else{
      $('#_amount').hide();
    }
  });

});

