<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;


$verificaDadosDuplicados = $sql->verificaDadosDuplicados($_REQUEST);
if(empty($verificaDadosDuplicados)){

	$insertUsuario = $sql->insertUsuario($_REQUEST);
	echo json_encode($insertUsuario);

}else{
	
	$var = array('informacao' => 'ERROR', 'error' => "Dados Duplicados!");
	echo json_encode($var);exit;
}






