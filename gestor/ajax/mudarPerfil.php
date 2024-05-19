<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$_SESSION['usuario']['perfil'] = $_REQUEST['perfil'];

echo json_encode(array('informacao' => 'ok')); 
