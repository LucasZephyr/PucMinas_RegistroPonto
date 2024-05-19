function buscarDadosTabela(){

	 Swal.fire({
	    title: 'Aguarde...',
	    html: '<div class="spinner-border" style="overflow:none" role="status"></div>',
	    showConfirmButton: false, //remove o botao fechar 
	    allowOutsideClick: false, //impede que o usuario feche o alert clicando fora dele
	    allowEscapeKey: false  //impede que o usuario feche o alert pressionando Esc
  	});
      
        let formulario = document.getElementById("frmSolicitarAbono");
        let formData = new FormData(formulario);        
         
        $.ajax({
            url: "ajax/solicitarAbono.php",
            data: formData,              
            cache: false,
            processData: false,          
            contentType: false,      
            dataType: "html",
            type: "POST",
            success: function(resp){
                Swal.close();
                
				$("#respostaAjax").html(resp);
                  
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

function SolicitarAbono(dia, mes, ano){

	let dados = {
		'dia': dia,
		'mes': mes,
		'ano': ano
	};

	$.ajax({
            url: "ajax/solicitarAbonoRequicao.php",
            data: dados,              
            cache: false,
            dataType: "html",
            type: "POST",
            success: function(resp){
                Swal.close();
                
				$("#corpoModalAbono").html(resp);
                  
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



function solicitarAbonoGerencia(){

	if($("#justificativaAbono").val() == "" || $("#justificativaAbono").val() == " "){
		return Swal.fire({ icon: 'question', text: 'A justificativa não pode ser vazia!', showConfirmButton: true });
	}


	let formulario = document.getElementById("frmJustificativaAbono");
   	let formData = new FormData(formulario);        
         
        $.ajax({
            url: "ajax/criarAbono.php",
            data: formData,              
            cache: false,
            processData: false,          
            contentType: false,      
            dataType: "json",
            type: "POST",
            success: function(resp){
                
            	if(resp.informacao == "SUCESSO"){
            		
	            	Swal.fire({
	                    icon: 'success',
	                    title: 'Sucesso',
	                    text: 'Seu abono foi solicitado. No momento, está pendente de avaliação pela gerência para verificar e corrigir seu horário.',
	                    showConfirmButton: true
	                });
                

            	}else{

	            	Swal.fire({
	                    icon: 'error',
	                    title: 'Falha ao criar abono',
	                    text: 'Não foi possivel criar seu abono. Por favor, entre em contato com o administrador do sistema.',
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

function addBatidas() {

    let numeroDeClasses = $('#batidas').find('.col-md-4').length;
    let html = '<div class="col-md-4"><label class="form-label">'+(numeroDeClasses + 1)+'º Registro</label><input type="time" class="form-control" name="abono_'+numeroDeClasses+'" "></div>';


    if(numeroDeClasses < 6){
        $('#batidas').append(html);    
    }else{
        Swal.fire({
            icon: 'question',
            text: 'Número máximo de batidas foi atingido!',
            showConfirmButton: true
        });
    }
    




}
