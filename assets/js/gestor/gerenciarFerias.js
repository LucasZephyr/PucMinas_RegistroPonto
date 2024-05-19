function acaoFerias(id, status){
    

    Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Espelo pelo processamento dos dados!',
        showConfirmButton: false
    });

    let dados = {
        'id' : id,
        'status' : status
    };

    $.ajax({
        url: "ajax/ajaxGerenciarFerias.php",
        data: dados,
        dataType: "json",
        type: "POST",
        success: function(resp){
            Swal.close();

            if(resp.informacao == "SUCESSO"){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    html: 'Ação Concluida com Sucesso',
                    showConfirmButton: true
                });

                $("#linha_"+id).remove();

            }

            if(resp.informacao == "ERROR"){
                Swal.fire({
                   icon: 'question',
                   title: 'Erro ao processar esta ação',
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


{
    $(document).ready(function() {
    	var table = $('#feriasTable').DataTable({
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