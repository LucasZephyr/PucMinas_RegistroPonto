$("#btnAtualizarSenha").click(function() {

    var formulario = document.getElementById("formAlterarSenha");
    var formData = new FormData(formulario);

    $.ajax({
        url: "ajax/alterarSenha.php",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        type: "POST",
        success: function(resp){

            if(resp.informacao === "SUCESSO"){

                Swal.fire({              
                    icon: "success",
                    title: 'Senha alterada com sucesso',
                    showConfirmButton: true
                });

            }else{

                Swal.fire({
                    icon: 'error',
                    title: 'Error ao alterar senha!',
                    showConfirmButton: true
                });

            }                

        },
        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'Erro na Requisação'
            });
        }              
    });


    return false;

    
});



$(document).ready(function() {
    $('#senha1, #senha2, #senha3').on('keyup', function() {
        var senha = $('#senha2').val();
        var senhaConfirmacao = $('#senha3').val();
        var regexMaiuscula = /[A-Z]/;
        var regexMinuscula = /[a-z]/;
        var regexNumero = /[0-9]/;
        var regexEspecial = /[.;\-_*+/]/; 
        
        var possuiMaiuscula = regexMaiuscula.test(senha);
        var possuiMinuscula = regexMinuscula.test(senha);
        var possuiNumero = regexNumero.test(senha);
        var possuiEspecial = regexEspecial.test(senha); 
        var possuiTamanhoCorreto = senha.length >= 10;
        var saoIguais = senha === senhaConfirmacao;
        
        var progresso = 0;
        if (possuiMaiuscula) progresso += 16;
        if (possuiMinuscula) progresso += 16;
        if (possuiNumero) progresso += 16;
        if (possuiEspecial) progresso += 16; 
        if (possuiTamanhoCorreto) progresso += 16;
        if (saoIguais) progresso += 20;

        var mensagem = '';
        if (!possuiMaiuscula) {
            mensagem += 'Falta pelo menos uma letra maiúscula.<br>';
        }
        if (!possuiMinuscula) {
            mensagem += 'Falta pelo menos uma letra minúscula.<br>';
        }
        if (!possuiNumero) {
            mensagem += 'Falta pelo menos um número.<br>';
        }
        if (!possuiEspecial) {
            mensagem += 'Falta pelo menos um caractere especial.<br>';
        }
        if (!possuiTamanhoCorreto) {
            mensagem += 'A senha deve ter pelo menos 10 caracteres.<br> ';
        }
        if (!saoIguais) {
            mensagem += 'As senhas não são iguais.<br>';
        }

        $('#msgSenhaInformativo').html(mensagem.trim());
        
        if (progresso <= 20) {
            $('#senhaProgressBar').removeClass().addClass('progress-bar bg-danger');
        } else if (progresso <= 40) {
            $('#senhaProgressBar').removeClass().addClass('progress-bar bg-warning');
        } else if (progresso <= 60) {
            $('#senhaProgressBar').removeClass().addClass('progress-bar bg-orange');
        } else if (progresso <= 80) {
            $('#senhaProgressBar').removeClass().addClass('progress-bar bg-info');
        } else {
            $('#senhaProgressBar').removeClass().addClass('progress-bar bg-success');
        }
        
        $('#nivelSenha').text('Progresso da senha: ' + progresso + '%');
        
        $('#senhaProgressBar').css('width', progresso + '%'); 
        
        if (progresso === 100) {
            $('#btnAtualizarSenha').prop('disabled', false);
            $('#msgSenha').text('');
        } else {
            $('#btnAtualizarSenha').prop('disabled', true);
        }
    });

    $('#verSenha1, #verSenha2, #verSenha3').on('click', function() {
        var campoSenha = $(this).closest('.input-group').find('input');
        var tipo = campoSenha.attr('type') === 'password' ? 'text' : 'password';
        campoSenha.attr('type', tipo);
    });
    
});