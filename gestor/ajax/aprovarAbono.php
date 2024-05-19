<?php
#echo "<pre>";print_r($_REQUEST);exit;

require '../../classes/sql.class.php';
$sql = new SQL();

$aprovarAbono = $sql->aprovarAbono($_REQUEST['id_abono']);
if($aprovarAbono['informacao'] == "SUCESSO"){
    echo json_encode($aprovarAbono);
}else{
    $arrayResposta = array('text' => 'Erro na aprovação do abono', 'informacao' => 'Falha');
    echo json_encode($arrayResposta);exit;
}



