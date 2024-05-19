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

$getDadoFeriasRelatorio = $sql->getDadoFeriasRelatorio();
#echo '<pre>';print_r($getDadoFeriasRelatorio);exit;

#cabecalho
  $dadosXls = utf8_decode('Nome; CPF; Data Inicio; Adiantamento 13; Duracao; Dias Adicionais' . "\n"); 

  foreach($getDadoFeriasRelatorio as $dados){ 

    $nome = $dados['nome'];
    $cpf = $dados['cpf'];
    $data = date('d/m/Y', strtotime($dados['data_inicio']));
    $adiantamento_13 = $dados['adiantamento_13'];
    $duracao = $dados['duracao'];
    $diasAdd = $dados['dias_adicionais'];
     

    $dadosXls .= $nome . ';' . $cpf . ';' . $data . ';' . $adiantamento_13 . ';' . $duracao . ';' . $diasAdd . "\n";

  }


    #$diretorio = $_SERVER['DOCUMENT_ROOT']."/intranet/acomp_matricula_monitoramento/";
    #$nomeArquivo = 'relatorioServidorSede.csv'; 
    #file_put_contents($diretorio . $nomeArquivo, $dadosXls);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="relatorio_ferias.csv"'); 
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    echo utf8_encode($dadosXls);