{ //usando varivael let dentro do bloco

    let form = document.querySelector('#gestorFormCoordenadorID');
    let botao = document.querySelector('#btnCadastrar');

    form.addEventListener('input', () => {
    let inputs = form.querySelectorAll('input');
    let isEveryFieldFilled = Array.from(inputs).every(input => input.value !== '');

    botao.disabled = !isEveryFieldFilled;
    });

}


{
 
btnCadastrar.onclick = () => {

    Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Espelo pelo processamento dos dados!',
        showConfirmButton: false
      });


    // Captura os dados do formulário
    var formulario = document.getElementById("gestorFormCoordenadorID");
    // Instância o FormData passando como parâmetro o formulário
    var formData = new FormData(formulario);

    $.ajax({
        url: "ajax/criaUsuario.php",
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
                    html: 'Dados Inseridos com Sucesso! <br> Usuario e Senha: MATRICULA',
                    showConfirmButton: true
                });


            }

            if(resp.informacao == "ERROR"){
                Swal.fire({
                   icon: 'question',
                   title: 'Verificar Dados',
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

}