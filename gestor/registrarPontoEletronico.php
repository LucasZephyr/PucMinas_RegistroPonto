<?php

date_default_timezone_set('America/Belem');

$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}

require '../classes/sql.class.php';
$sql = new SQL();

$registroPonto = $sql->getRegistroPontoUsuario($_SESSION['usuario']['id_usuario']);
#echo "<pre>";print_r($registroPonto);exit;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registro de Ponto Eletrônico</title>
    
    <?php include '../includes/cabecalho.php';?>


</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registro de Ponto Eletr&ocirc;nico</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Ponto Eletr&ocirc;nico</li>
                    <li class="breadcrumb-item active">Registrar Ponto Eletr&ocirc;nico</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Registre seus hor&aacute;rio no mapa abaixo:</h5>
                        <div class="card-body">

                            <form class="was-validated" action="#" id="formMapaRegistroPonto" onsubmit="return false;">

                            <div class="row"> 
                                 <div id='map' style='width: 99%; height: 400px;'></div>
                            </div>


                            <?php if(count($registroPonto) < 7){ ?>
                                <div class="mt-3">
                                    <button 
                                        class="btn btn-primary" 
                                        id="btnRegistrarPontoEletronico" 
                                        type="button" 
                                        onclick="obterLocalizacao();"
                                        >
                                            <i class="bi bi-box-arrow-in-right"></i> 
                                        Registrar Localização
                                    </button>

                                    
                                    <div class="mt-3">Endereco aproximado: <br><p id="endereco"></p></div>
                                    


                                </div>
                            <?php } ?>

                            </form>
                            
                        </div>
                    </div>


                    </div>
                </div>


                <div class="col-lg-3 ms-3"> <!-- inicio coluna a direita-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Registros - <?=date('d/m/y')?></h5>
                        <div class="card-body">

                            <table class="table table-hover">
                                <?php 
                                    $contador = 1;
                                    for ($i=0; $i < count($registroPonto); $i++) { 
                                ?>
                                    <tr>
                                        <td><?=$contador?> Registro</td>
                                        <td><?=$registroPonto[$i]['hora']?></td>
                                    </tr>
                                <?php
                                    $contador++; 
                                    } 
                                ?>
                            </table>
                            
                            
                        </div>
                    </div>


                    </div>
                </div>


            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->


    <!-- ======= RODAPÉ ======= -->
    <?php include "../includes/rodape.php";?>
    <script defer src="../assets/js/ponto/registrarPontoEletronico.js"></script>

</body>
</html>