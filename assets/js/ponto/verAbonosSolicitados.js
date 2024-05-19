function verDetalhesAbono(botao){

	let dataDia = botao.getAttribute('data-dia');
	let dataId = botao.getAttribute('data-idAbono');

	let dados = {
		"dia": dataDia,
		"id_abono": dataId
	}

	$.ajax({
        url: "ajax/verDatelhesAbonoSolicitacao.php",
        data: dados,              
        cache: false,    
        dataType: "html",
        type: "POST",
        success: function(resp){
            
			$("#conteudoModalAbono").html(resp);
              
        },
        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'erro no processamento!',
                showConfirmButton: true
            });
        }              
    });
	
}