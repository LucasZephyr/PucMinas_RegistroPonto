<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_SESSION);exit;


$arrayResposta = array();

if($_SESSION['usuario']['logado'] != "sim"){

	$arrayResposta = array (
		"informacao" => "Usuário não logado!",
		"icon" => "error",
		"title" => "Permissão Negada!"
	);

	echo json_encode($arrayResposta);exit;

}

if($_REQUEST['latitude'] == '' || $_REQUEST['longitude'] == ''){

	$arrayResposta = array (
		"informacao" => "Coordenadas não obtidas!",
		"icon" => "question",
		"title" => "Permissão Negada ao obter Coordenadas!"
	);

	echo json_encode($arrayResposta);exit;
}


$insertRegistroPonto = $sql->insertRegistroPonto($_SESSION['usuario']['id_usuario'], $_REQUEST);

if($insertRegistroPonto['informacao'] == "SUCESSO"){
	echo json_encode($insertRegistroPonto);exit;

}else{

	$insertRegistroPonto = 
	array_merge(
		$insertRegistroPonto, 
		array("text" => "Erro ao persitir informações no banco de dados!")
	);

	echo json_encode($insertRegistroPonto);exit;

}











