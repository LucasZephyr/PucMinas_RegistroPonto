function aprovar(botao){

	let dataId = botao.getAttribute('data-idAbono');

	let dados = {
		"id_abono": dataId,
    "aprovar": "true"
	}

	$.ajax({
        url: "ajax/aprovarAbono.php",
        data: dados,              
        cache: false,    
        dataType: "json",
        type: "POST",
        success: function(resp){
            
            if(resp.informacao == "SUCESSO"){
                Swal.fire({
                  title: 'SUCESSO',
                  text: 'Abono Aprovado!',
                  icon: 'success'
                });

                $("#card"+dataId).remove();
      
              }else{
      
                Swal.fire({
                  title: resp.informacao,
                  text: resp.text,
                  icon: 'error'
                });
      
              }
              
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



function reprovar(botao){

	let dataId = botao.getAttribute('data-idAbono');

	let dados = {
		"id_abono": dataId,
        "reprovar": "true"
	}

	$.ajax({
        url: "ajax/reprovarAbono.php",
        data: dados,              
        cache: false,    
        dataType: "json",
        type: "POST",
        success: function(resp){

            if(resp.informacao == "SUCESSO"){
                Swal.fire({
                  title: 'SUCESSO',
                  text: 'Abono Reprovado!',
                  icon: 'success'
                });

                $("#card"+dataId).remove();
      
              }else{
      
                Swal.fire({
                  title: resp.informacao,
                  text: resp.text,
                  icon: 'error'
                });
      
              }
            
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

function verDetalhesAbono(botao){

	let dataDia = botao.getAttribute('data-dia');
	let dataId = botao.getAttribute('data-idAbono');
  let dataIdUsuario = botao.getAttribute('data-idUsuario');

	let dados = {
		"dia": dataDia,
		"id_abono": dataId,
    "id_usuario": dataIdUsuario
	}

	$.ajax({
        url: "ajax/verDetalhesAbonoSolicAdm.php",
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
