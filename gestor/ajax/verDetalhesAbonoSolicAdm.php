<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$getSolicitacao = $sql->getAbonosPorUsuarios3($_REQUEST['id_abono']);

#$getRegistros = $sql->getRegistroAbonoPorDia($_REQUEST['dia']);
$getRegistros = $sql->getRegistroAbonoPorDia($_REQUEST['dia'], $_REQUEST['id_usuario']);

#echo "<pre>";print_r($getSolicitacao);echo "</pre>";
#echo "<pre>";print_r($getRegistros);echo "</pre>";


?>

<div class="table-responsive">
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th scope="col">TIPO</th>
			<th scope="col">1 Batida</th>
			<th scope="col">2 Batida</th>
			<th scope="col">3 Batida</th>
			<th scope="col">4 Batida</th>
			<th scope="col">5 Batida</th>
			<th scope="col">6 Batida</th>
		</tr>
	</thead>

	<tbody>

		<tr>
		    <td>Batida</td>
		    <td><?= !empty($getRegistros[0]['hora']) ? $getRegistros[0]['hora'] : '--' ?></td>
		    <td><?= !empty($getRegistros[1]['hora']) ? $getRegistros[1]['hora'] : '--' ?></td>
		    <td><?= !empty($getRegistros[2]['hora']) ? $getRegistros[2]['hora'] : '--' ?></td>
		    <td><?= !empty($getRegistros[3]['hora']) ? $getRegistros[3]['hora'] : '--' ?></td>
		    <td><?= !empty($getRegistros[4]['hora']) ? $getRegistros[4]['hora'] : '--' ?></td>
		    <td><?= !empty($getRegistros[5]['hora']) ? $getRegistros[5]['hora'] : '--' ?></td>
		</tr>

		<tr>
		    <td>Solicitação</td>
		    <td><?= !empty($getSolicitacao[0]['batida1']) ? $getSolicitacao[0]['batida1'] : '--' ?></td>
		    <td><?= !empty($getSolicitacao[0]['batida2']) ? $getSolicitacao[0]['batida2'] : '--' ?></td>
		    <td><?= !empty($getSolicitacao[0]['batida3']) ? $getSolicitacao[0]['batida3'] : '--' ?></td>
		    <td><?= !empty($getSolicitacao[0]['batida4']) ? $getSolicitacao[0]['batida4'] : '--' ?></td>
		    <td><?= !empty($getSolicitacao[0]['batida5']) ? $getSolicitacao[0]['batida5'] : '--' ?></td>
		    <td><?= !empty($getSolicitacao[0]['batida6']) ? $getSolicitacao[0]['batida6'] : '--' ?></td>
		</tr>

		<tr>
		    <td>Diferença</td>
			    <?php
				    $diferencas = array();
				    for ($i = 0; $i < 6; $i++) {
				        $horaSolicitacao = isset($getSolicitacao[0]["batida" . ($i + 1)]) ? strtotime($getSolicitacao[0]["batida" . ($i + 1)]) : false;
				        $horaBatida = isset($getRegistros[$i]['hora']) ? strtotime($getRegistros[$i]['hora']) : false;

				        if ($horaSolicitacao !== false && $horaBatida !== false) {
				            $diferencaSegundos = $horaBatida - $horaSolicitacao;
				            $diferencaFormatada = gmdate("H:i:s", abs($diferencaSegundos));
				            $diferencas[] = $diferencaFormatada;
				        } else {
				            $diferencas[] = '--'; #se n for possel calcular vai add '--' no array
				        }
				    }

				    foreach ($diferencas as $diferenca) {
				        echo "<td>$diferenca</td>";
				    }
			    ?>
		</tr>

	</tbody>


</table>
</div>

