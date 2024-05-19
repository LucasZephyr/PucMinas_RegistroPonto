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


$feriasGeral = $sql->getFeriasPendentes();
#echo '<pre>';print_r($feriasGeral);exit;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Ver Ferias Solic </title>

    <script defer src="../assets/js/gestor/gerenciarFerias.js"></script>
    
    <?php include '../includes/cabecalho.php'?>
</head>

<body>

    <?php include '../includes/navBar.php'?>

    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Servidores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">F&eacute;rias</li>
                    <li class="breadcrumb-item active">Gerenciar Férias(ADM)</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Preencha os Campos abaixo</h5>
                        <div class="card-body mt-3">

                            <h5>Lista de todas as férias solicitadss (status pendentes)</h5>

                            <div class="container mt-4">

                            <table class="table table-hover" id="feriasTable">
                            <thead>
                                <tr align="center">
                                <th scope="col">Funcionario</th>
                                <th scope="col">Data Inicio</th>
                                <th scope="col">Duracao</th>
                                <th scope="col">Adiantamento 13</th>
                                <th scope="col">Dias Adicionais</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($feriasGeral as $ferias){ 

                                    if($ferias['status'] == 1){
                                        $status = 'Pendente';    
                                    }elseif($ferias['status'] == 2){
                                        $status = 'Aprovado';
                                    }else{
                                        $status = 'Reprovado';
                                    }

                                ?>
                                <tr id="linha_<?=$ferias['id']?>">

                                    <td><?=$ferias['nome']?></td>
                                    <td><?=date('d/m/Y', strtotime($ferias['data_inicio']))?></td>
                                    <td><?=$ferias['duracao']?></td>
                                    <td><?=$ferias['adiantamento_13']?></td>
                                    <td><?=$ferias['dias_adicionais']?></td>
                                    <td> <?=$status?></td>

                                    <td align="center">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-success btn-sm" onclick="acaoFerias(<?=$ferias['id']?>, '2')"></i> Aprovar</button>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="acaoFerias(<?=$ferias['id']?>, '3')"> Reprovar</button>
                                        </div>
                                    </td>

                                </tr>
                                <?php } ?>

                            </tbody>

                            </table>



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