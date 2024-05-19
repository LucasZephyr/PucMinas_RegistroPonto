<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$atualizarDados = $sql->atualizarDados($_REQUEST, $_SESSION['usuario']['id_usuario']);



$resposta = array();
if($atualizarDados['informacao'] == "SUCESSO"){

	echo json_encode($atualizarDados);
	$_SESSION['usuario']['primeiro_acesso'] = 0;

}else{

	$resposta = array('informacao' => 'error');	
	echo json_encode($resposta);
}

