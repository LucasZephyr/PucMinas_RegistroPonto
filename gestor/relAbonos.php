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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestor</title>
    
    <?php include '../includes/cabecalho.php'?>
</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Relat&oacute;rio de Abonos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Consultas</li>
                    <li class="breadcrumb-item active">Relat&oacute;rio de Abonos</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Relat&oacute;rio de Abonos pendentes</h5>
                        <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Bat 1</th>
                                        <th scope="col">Bat 2</th>
                                        <th scope="col">Bat 3</th>
                                        <th scope="col">Bat 4</th>
                                        <th scope="col">Bat 5</th>
                                        <th scope="col">Bat 6</th>
                                        <th scope="col">Justificativa</th>
                                        <th scope="col">Dia</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                foreach($getDadoAbonosRelatorio as $dados){ 
                                if($dados['status'] == '1'){
                                    $status = 'Pendente';
                                }elseif($dados['status'] == '2'){
                                    $status = 'Aprovado';
                                }else{
                                    $status = 'Reprovado';
                                }
                                ?>
                                    <tr>
                                        <td scope="col"><?=utf8_decode(utf8_encode($dados['nome']))?></td>
                                        <td scope="col"><?=$dados['batida1']?></td>
                                        <td scope="col"><?=$dados['batida2']?></td>
                                        <td scope="col"><?=$dados['batida3']?></td>
                                        <td scope="col"><?=$dados['batida4']?></td>
                                        <td scope="col"><?=$dados['batida5']?></td>
                                        <td scope="col"><?=$dados['batida6']?></td>
                                        <td scope="col"><?=($dados['justificativa'])?></td>
                                        <td scope="col"><?=date('d/m/Y', strtotime($dados['dia']))?></td>
                                        <td scope="col"><?=$status?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-12 mt-3">
                                    <a href="relatorioAbonosPdf.php">
                                        <button class="btn btn-primary" type="button"><i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF</button>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6" align="right">
                                <div class="col-12 mt-3">
                                    <a href="relatorioAbonoCsv.php">
                                        <button class="btn btn-primary" type="button"><i class="bi bi-filetype-csv"></i> Exportar CSV</button>
                                    </a>
                                </div>
                            </div>
                        </div>



                    

                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->

    <!-- ======= RODAPÉ ======= -->
    <?php include "../includes/rodape.php";?>

</body>

</html>