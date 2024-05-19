function atualizarRelogio() {
    var agora = new Date();
    var horas = agora.getHours();
    var minutos = agora.getMinutes();
    var segundos = agora.getSeconds();


    //se a hora for menor que 10 adiciono um zero a frente
    if (horas < 10) {
    horas = "0" + horas;
    }

    if (minutos < 10) {
    minutos = "0" + minutos;
    }

    if (segundos < 10) {
    segundos = "0" + segundos;
    }

    var horaAtual = horas + ":" + minutos + ":" + segundos;

    document.getElementById("relogio").innerHTML = horaAtual;
}

setInterval(atualizarRelogio, 1000); // chama a funcao a cada segundo




// ------------------------------------------------- //

$(function(){


    $('#dtNasc').mask('99/99/9999');
    $("#bntEsqueceuSenha").click(function() {
  
    // Captura os dados do formulário
    var formulario = document.getElementById("formSenha");
    // Instância o FormData passando como parâmetro o formulário
    var formData = new FormData(formulario);

        Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Solicitando Troca de Senha',
        showConfirmButton: false
        });


    setTimeout(function() {

        $.ajax({
            url: "ajax/protocoloEsqueciSenha.php",
            data: formData,
            cache: false,
            contentType: false,
            dataType: "json",
            processData: false,
            type: "POST",
            success: function(resp){


                if(resp.informacao === "SUCESSO"){

                Swal.fire({              
                    icon: "success",
                    title: resp.message,
                    showConfirmButton: true,
                    willClose: function() { //paramentro do sweet que faz uma acao quando o alert for fechado.
                        location.reload();
                        window.location.href = "index.php";
                    }
                });

                }else{

                Swal.fire({
                    icon: 'error',
                    title: resp.message,
                    showConfirmButton: true
                });

                }


            },
            error: function(){

                Swal.fire({
                    icon: 'error',
                    title: 'Oops..',
                    text: 'Erro na Troca da Senha'
                });

            }              
        });

    }, 2300);
    });




    $("#bntAlterarSenha").click(function() {
  
        // Captura os dados do formulário
        var formulario = document.getElementById("formSenha");
        // Instância o FormData passando como parâmetro o formulário
        var formData = new FormData(formulario);

        Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Solicitando Troca de Senha',
        showConfirmButton: false
        });


        setTimeout(function() {

          $.ajax({
              url: "teste0121.php",
              data: formData,
              cache: false,
              contentType: false,
              dataType: "json",
              processData: false,
              type: "POST",
              success: function(resp){


                  if(resp.informacao === "SUCESSO"){

                  Swal.fire({              
                      icon: "success",
                      title: resp.message,
                      showConfirmButton: true,
                      willClose: function() { //paramentro do sweet que faz uma acao quando o alert for fechado.
                          location.reload();
                          window.location.href = "index.php";
                      }
                  });

                  }else{

                  Swal.fire({
                      icon: 'error',
                      title: resp.message,
                      showConfirmButton: true,
                      willClose: function() { //paramentro do sweet que faz uma acao quando o alert for fechado.
                          location.reload();
                          //window.location.href = "index.php";
                      }
                  });

                  }


              },
              error: function(){

                  Swal.fire({
                      icon: 'error',
                      title: 'Oops..',
                      text: 'Erro na Troca da Senha'
                  });

              }              
          });

        }, 2300);
        });





    //clicar no olho e mostrar a senha
    $('#inputGroupPrependSenha01').click(function() {
      var senhaInput = $('#SENHA01');
      if (senhaInput.attr('type') === 'password') {
        senhaInput.attr('type', 'text');
        //$(this).text('Ocultar senha');
      } else {
        senhaInput.attr('type', 'password');
        //$(this).text('Mostrar senha');
      }
    });


    $('#inputGroupPrependSenha02').click(function() {
      var senhaInput = $('#SENHA02');
      if (senhaInput.attr('type') === 'password') {
        senhaInput.attr('type', 'text');
        //$(this).text('Ocultar senha');
      } else {
        senhaInput.attr('type', 'password');
        //$(this).text('Mostrar senha');
      }
    });






    {
    var $inputs = $('#formSenha input');
    var $button = $('#bntAlterarSenha');

    function verificarCampos() {
        var todosPreenchidos = true;
        let senha01 = $("#SENHA01").val();
        let senha02 = $("#SENHA02").val();

        let verificacao01 = /[a-zA-Z]/.test(senha01);
        let verificacao02 = /\d/.test(senha01);
        let verificacao03 = /[^a-zA-Z0-9]/.test(senha01);

        let verificacao04 = /[a-zA-Z]/.test(senha02);
        let verificacao05 = /\d/.test(senha02);
        let verificacao06 = /[^a-zA-Z0-9]/.test(senha02);

        $inputs.each(function() {
        if ($(this).val() === '') {
            todosPreenchidos = false;
            //return false;
        }

        if (!verificacao01 || !verificacao02 || !verificacao03 || !verificacao04 || !verificacao05 || !verificacao06) {
          $('#msg_senha_seguranca').text('A senha não atende aos critérios: Alfanuméricos e Caracteres Especiais OU As senha não são iguais. ').css({ color: 'red', fontWeight: 'bold' });
          todosPreenchidos = false;
        }else{
          $('#msg_senha_seguranca').text('').css({ color: '', fontWeight: '' });
        }

        
        if(senha01 === senha02){
            $('#msg_senha_seguranca').text('').css({ color: 'red', fontWeight: 'bold' });
        }else{
            $('#msg_senha_seguranca').text('A senha não atende aos critérios: Alfanuméricos e Caracteres Especiais OU As senha não são iguais. ').css({ color: 'red', fontWeight: 'bold' });
            todosPreenchidos = false;
        }


        });



        if (todosPreenchidos) {
        $button.prop('disabled', false);
        } else {
        $button.prop('disabled', true);
        }
    }



    $inputs.on('input', verificarCampos);
    }



    



});



