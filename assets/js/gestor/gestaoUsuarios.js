function atualizarStatus(status, id, acao){

	let dados = {
		'status' : status,
		'id_usuario' : id 
	};
	
    $.ajax({
        url: "ajax/alterarStatusUsuario.php",
        data: dados,
        dataType: "json",
        type: "POST",
        success: function(resp){

            if(resp.informacao === "SUCESSO"){

                Swal.fire({              
                    icon: "success",
                    title: acao + ': foi concluida com sucesso!',
                    showConfirmButton: true
                });

            }else{

                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao atualizar status',
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


}


{
    $(document).ready(function() {
    	var table = $('#usuarios').DataTable({
            "iDisplayLength": 4, 
    		'responsive': true,
            'autoWidth': false,
			'lengthMenu': [5, 10, 25, 50, 75, 100, 500, 1000, 10000],
            'order': [[0, 'asc']],
    		'oLanguage': {
                'sProcessing': 'Aguarde enquanto os dados são carregados ...',
                'sLengthMenu': 'Mostrar _MENU_ registros por pagina',
                'sZeroRecords': 'Nenhum registro correspondente ao criterio encontrado',
                'sInfoEmtpy': 'Exibindo 0 a 0 de 0 registros',
                'sInfo': 'Exibindo de _START_ a _END_ de _TOTAL_ registros',
                'sInfoFiltered': '',
                'sSearch':  'Pesquisar _INPUT_ na tabela',
                'oPaginate': {
                    'sFirst':    'Primeiro',
                    'sPrevious': 'Anterior',
                    'sNext':     'Próximo',
                    'sLast':     'Último'
                },
                'aria': {
                    'sortAscending': ': ative para classificar a coluna em ordem crescente',
                    'sortDescending': ': ative para classificar a coluna em ordem decrescente'
                },
                "sInfoEmpty": "Não há registros para mostrar"
            }   
    	});
    });
}