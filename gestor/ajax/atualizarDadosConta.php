<?php

require '../../classes/sql.class.php';
$sql = new SQL();
session_start();

$atualizarDados = $sql->atualizarDadosConta($_REQUEST, $_SESSION['usuario']['id_usuario']);

$resposta = array();
if($atualizarDados['informacao'] == "SUCESSO"){
	$_SESSION['usuario']['login'] = $_REQUEST['matricula'];
	$_SESSION['usuario']['cpf'] = $_REQUEST['cpf'];
	$_SESSION['usuario']['nome'] = $_REQUEST['nome'];
	$_SESSION['usuario']['email'] = $_REQUEST['email'];
	$_SESSION['usuario']['telefone'] = $_REQUEST['telefone'];
	$_SESSION['usuario']['data_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $_REQUEST['dtNasc'])));

	echo json_encode($atualizarDados);
}else{
	$resposta = array('informacao' => 'error');	
	echo json_encode($resposta);
}


