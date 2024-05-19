<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;

$atualizarSenha = $sql->atualizarSenha($_REQUEST['senha1'], $_REQUEST['senha3'], $_SESSION['usuario']['id_usuario']);

if($atualizarSenha['informacao'] == "SUCESSO"){
    echo json_encode($atualizarSenha);
}else{
    $atualizarSenha = array('informacao' => 'error');
    echo json_encode($atualizarSenha);exit;
}
