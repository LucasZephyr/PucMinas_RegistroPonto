$(document).ready(function() {

  var today = new Date();
  var minDate = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate()).toISOString().split('T')[0];
  $('#dataInicio').attr('min', minDate);

  $('#duracao').change(function() {
    if ($(this).val() != 30) {
      $('#perguntaAdicional').show();
      $('#perguntaAdicional').removeAttr('disabled');
      $('#adicionais').val('');

    } else {
      $('#perguntaAdicional').hide();
      $('#perguntaAdicional').attr('disabled', 'disabled');

    }
  });

});


btnFerias.onclick = () => {

    Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Espelo pelo processamento dos dados!',
        showConfirmButton: false
      });

    var formulario = document.getElementById("formFerias");
    var formData = new FormData(formulario);

    $.ajax({
        url: "ajax/inserirFerias.php",
        data: formData,
        cache: false,
        contentType: false,
        dataType: "json",
        processData: false,
        type: "POST",
        success: function(resp){
            Swal.close();

            if(resp.informacao == "SUCESSO"){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    html: 'Ferias registrada com sucesso.',
                    showConfirmButton: true
                });


            }

            if(resp.informacao == "ERROR"){
                Swal.fire({
                   icon: 'question',
                   title: 'Error ao tentar inserir ferias.',
                   text: resp.error,
                   showConfirmButton: true
                 });
           }  

        },
        error: function(){
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'erro no processamento!',
                showConfirmButton: true
            });

        }              
    });


}
