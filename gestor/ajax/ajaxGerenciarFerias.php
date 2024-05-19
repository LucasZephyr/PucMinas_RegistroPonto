<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$atualizarFerias = $sql->atualizarFeriasStatus($_REQUEST['id'], $_REQUEST['status']);
echo json_encode($atualizarFerias);die();



