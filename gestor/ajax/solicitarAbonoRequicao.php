<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$data = $_REQUEST['ano'] . '-' . $_REQUEST['mes'] . '-' . $_REQUEST['dia'];

$getRegistroAbonoPorDia = $sql->getRegistroAbonoPorDia($data, $_SESSION['usuario']['id_usuario']);
#echo "<pre>";print_r($getRegistroAbonoPorDia);exit;


$html = '
	<form class="row g-3" id="frmJustificativaAbono" onsubmit="return false;">

	<div id="batidas" class="row"> 
';
$i = 1;
foreach($getRegistroAbonoPorDia as $abono){

	$dataAbono = $abono['data'];
	$horaAbono = $abono['hora'];
	$idAbono = $abono['id'];

	$html .= '		
		  <div class="col-md-4">
		    <label for="validationCustom01" class="form-label">'.$i.'º Registro</label>
		    <input type="time" class="form-control" name="abono_'.$idAbono.'" value="'.$horaAbono.'">
		  </div>
	';

	$i++;
}

$html .= '

	</div> <!-- FIM DIV BATIDAS -->

	<div class="col-12">
    	<button class="btn btn-primary" type="button" 
    	onclick="addBatidas()">
    	Adicionar Batida</button>
  	</div>

';


$html .= '

	<input type="hidden" name="dia" value="'.$data.'">
	<input type="hidden" name="id_usuario" value="'.$_SESSION['usuario']['id_usuario'].'">

	<div class="col-md-12 mb-3">
    	<label for="validationTextarea" class="form-label">Justificativa</label>
    	<textarea class="form-control" id="justificativaAbono" name="justificativaAbono" placeholder="Escreva sua Justificativa..."></textarea>
  	</div>


	<div class="col-12">
    	<button class="btn btn-primary" type="button" 
    	onclick="solicitarAbonoGerencia()">
    	Solicitar Abono Gerência</button>
  	</div>
</form>

';

echo $html;








