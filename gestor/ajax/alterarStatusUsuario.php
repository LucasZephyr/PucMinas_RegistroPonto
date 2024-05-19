<?php

require '../../classes/sql.class.php';
$sql = new SQL();

session_start();
#echo "<pre>";print_r($_REQUEST);exit;


$atualizarStatusUsuario = $sql->atualizarStatusUsuario($_REQUEST['status'], $_REQUEST['id_usuario']);


$arrayResposta = array();
if($atualizarStatusUsuario['informacao'] == 'SUCESSO'){

    $arrayResposta = array(
        'informacao' => 'SUCESSO'
    );
    echo json_encode($arrayResposta);die();

}else{
    $arrayResposta = array(
        'informacao' => 'error'
    );
    echo json_encode($arrayResposta);die();

}




