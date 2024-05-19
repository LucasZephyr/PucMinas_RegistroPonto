<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

if($_REQUEST['mes'] == "" || $_REQUEST['ano'] == ""){
    $htmlVazio = '

        <h3>Por favor, selecione um mês e ano para exibir seu histórico.</h3>

    '; 

    echo $htmlVazio;exit;
}

$getRegistroPonto = $sql->getRegistroPonto($_REQUEST['mes'], $_REQUEST['ano'], $_SESSION['usuario']['id_usuario']);
#echo "<pre>";print_r($getRegistroPonto);exit;

$html = '
    <div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Dia</th>
                <th>Entrada 1</th>
                <th>Saída 1</th>
                <th>Entrada 2</th>
                <th>Saída 2</th>
                <th>Entrada 3</th>
                <th>Saída 3</th>
                <th>Acão</th>
            </tr>
        </thead>
        <tbody>';


// Loop para preencher a tabela com os dias do mês
for ($dia = 1; $dia <= 31; $dia++) {
    $html .= "<tr>";
    $html .= "<td>{$dia}</td>";

    $registros_para_dia = [];

    // Encontra todos os registros correspondentes a um determinado dia
    foreach ($getRegistroPonto as $registro) {
        $data_registro = date('d', strtotime($registro['data'])); // Extrai o dia do registro

        // Se o dia do registro corresponder ao dia atual no loop
        if ((int)$data_registro === $dia) {
            $registros_para_dia[] = $registro['hora'];
            // Aqui você pode adicionar outras informações dos registros, se necessário
        }
    }

    // Preenche as células com os registros encontrados para o dia
    $num_registros = count($registros_para_dia);
    for ($i = 0; $i < 6; $i++) {
        if ($i < $num_registros) {
            $html .= "<td>{$registros_para_dia[$i]}</td>";
        } else {
            $html .= "<td>--</td>";
        }
    }

    $html .= '
    <td>
	    <div class="col-12">
	    	<button class="btn btn-primary" type="button"
            data-bs-toggle="modal" data-bs-target="#modalSolicitarAbono"
	    	onclick="SolicitarAbono('.$dia . ", " . $_REQUEST['mes'] . ", " . $_REQUEST['ano'] . ');">
	    		Solicitar
	    	</button>
	  	</div>
	</td>
	';

    $html .= "</tr>";
}


$html .= '
        </tbody>
    </table>
</div>';


echo $html;
