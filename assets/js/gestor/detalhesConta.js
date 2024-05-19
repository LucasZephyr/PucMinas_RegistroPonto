{
    $(document).ready(function() {
    	var table = $('#idTabela').DataTable({
            "iDisplayLength": 8, 
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

$('#dtNasc').mask('99/99/9999');
$('#telefone').mask('(99) 9 9999 9999');
$('#cpf').mask('999.999.999-99');

btnAtualizarDados.onclick = () => {

    Swal.fire({
        icon: 'info',
        title: 'Aguarde',
        text: 'Espelo pelo processamento dos dados!',
        showConfirmButton: false
      });

    var formulario = document.getElementById("formConta");
    var formData = new FormData(formulario);

    $.ajax({
        url: "ajax/atualizarDadosConta.php",
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
                    html: 'Dados atualizados com sucesso. Por favor, atualize a pagina para ver seus dados atualizados.',
                    showConfirmButton: true
                });


            }

            if(resp.informacao == "ERROR"){
                Swal.fire({
                   icon: 'question',
                   title: 'Error. Por favor, verifique seus dados',
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