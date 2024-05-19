<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;


$inserirFerias = $sql->inserirFerias($_REQUEST, $_SESSION['usuario']['id_usuario']);
echo json_encode($inserirFerias);exit;
