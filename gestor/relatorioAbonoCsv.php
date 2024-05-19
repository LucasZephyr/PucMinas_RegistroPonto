<?php
$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}
if($_SESSION['usuario']['perfil'] != '2'){
    header("Location: index.php");
}


require '../classes/sql.class.php';
$sql = new SQL();

$getDadoAbonosRelatorio = $sql->getDadoAbonosRelatorio();
#echo '<pre>';print_r($getDadoAbonosRelatorio);exit;

#cabecalho
  $dadosXls = utf8_decode('Nome; Bat1; Bat2; Bat3; Bat4; Bat5; Bat6; Justificativa; Dia; Status' . "\n"); 

  foreach($getDadoAbonosRelatorio as $dados){ 

    if($dados['status'] == '1'){
        $status = 'Pendente';
    } elseif($dados['status'] == '2'){
        $status = 'Aprovado';
    } else{
        $status = 'Reprovado';
    }

    $nome = $dados['nome'];
    $batida1 = $dados['batida1'];
    $batida2 = $dados['batida2'];
    $batida3 = $dados['batida3'];
    $batida4 = $dados['batida4'];
    $batida5 = $dados['batida5'];
    $batida6 = $dados['batida6'];
    $justificativa = $dados['justificativa'];
    $dia = date('d/m/Y', strtotime($dados['dia']));

    $dadosXls .= $nome . ';' . $batida1 . ';' . $batida2 . ';' . $batida3 . ';' . $batida4 . ';' . $batida5 . ';' . $batida6 . ';' . $justificativa . ';' . $dia . ';' . $status . "\n";

}


    #$diretorio = $_SERVER['DOCUMENT_ROOT']."/intranet/acomp_matricula_monitoramento/";
    #$nomeArquivo = 'relatorioServidorSede.csv'; 
    #file_put_contents($diretorio . $nomeArquivo, $dadosXls);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="relatorio_abono.csv"'); 
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    echo utf8_encode($dadosXls);