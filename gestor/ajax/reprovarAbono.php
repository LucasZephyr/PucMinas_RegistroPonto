<?php

#echo "<pre>";print_r($_REQUEST);exit;

require '../../classes/sql.class.php';
$sql = new SQL();

$reprovarAbono = $sql->reprovarAbono($_REQUEST['id_abono']);
if($reprovarAbono['informacao'] == "SUCESSO"){
    echo json_encode($reprovarAbono);
}else{
    $arrayResposta = array('text' => 'Erro na reprovação do abono', 'informacao' => 'Falha');
    echo json_encode($arrayResposta);exit;
    
}


