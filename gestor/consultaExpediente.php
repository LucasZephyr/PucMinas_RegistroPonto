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
            <h1>Relat&oacute;rio de Férias</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Consultas</li>
                    <li class="breadcrumb-item active">Relat&oacute;rio de Ferias</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Relat&oacute;rio de F&eacute;rias dos us&uacute;arios ativos</h5>
                        <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Data de Início</th>
                                        <th scope="col">Adiantamento 13º</th>
                                        <th scope="col">Dura&ccedil;&atilde;o</th>
                                        <th scope="col">Dias Adicionais</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php foreach($getDadoFeriasRelatorio as $dados){?>
                                    <tr>
                                        <td><?=$dados['nome']?></td>
                                        <td><?=$dados['cpf']?></td>
                                        <td><?=date('d/m/Y', strtotime($dados['data_inicio']))?></td>
                                        <td><?=$dados['adiantamento_13']?></td>
                                        <td><?=$dados['duracao']?></td>
                                        <td><?=$dados['dias_adicionais']?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-12 mt-3">
                                    <a href="relatorioFeriasPdf.php">
                                        <button class="btn btn-primary" type="button"><i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF</button>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6" align="right">
                                <div class="col-12 mt-3">
                                    <a href="relatorioFeriasCsv.php">
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