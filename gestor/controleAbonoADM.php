<?php

date_default_timezone_set('America/Belem');

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

$getAbonos = $sql->getAbonos();
#echo "<pre>";print_r($getAbonos);exit;




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registro de Ponto Eletr&ocirc;nico</title>
    
    <?php include '../includes/cabecalho.php';?>


</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Controle de Abonos (ADM)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Ponto Eletr&ocirc;nico</li>
                    <li class="breadcrumb-item active">Controle de Abonos (ADM)</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Aprove ou reprove os abonos solictados pelos colaboradores:</h5>
                        <div class="card-body row">


                        <?php     

                        if(!empty($getAbonos)){  #inicio if empty

                            foreach($getAbonos as $abonos){
                                
                            $data = $abonos['dia'];
                            $id = $abonos['id'];
                            $dataFormatada = DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y'); 
                            $id_usuario = $abonos['id_usuario'];
                            
                        ?>
                        <div class="col-md-4 mt-3" id="card<?=$id?>">
                                <div class="card" style="width: 20rem;">
                                  <div class="card-body">
                                    <h5 class="card-title"><?=$dataFormatada?></h5>
                                    <h5 class="card-subtitle mb-2 text-body-secondary">Justificativa: </h5>
                                    <p class="card-text"><?=$abonos['justificativa']?></p>
                                    <p class="card-text"><?=$abonos['nome']?></p>



                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <button class="btn btn-success" data-idAbono="<?=$id?>" type="button" id="btnAprovar<?=$id?>" 
                                            onclick='aprovar(this)'
                                            >
                                                Aprovar
                                            </button>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <button class="btn btn-danger" data-idAbono="<?=$id?>" type="button" id="btnReprovar<?=$id?>" 
                                            onclick='reprovar(this)'
                                            >
                                                Reprovar
                                            </button>
                                        </div>

                                        <button 
                                        class="btn btn-secondary mt-3" 
                                        data-dia="<?=$data?>" 
                                        data-idAbono="<?=$id?>" 
                                        data-idUsuario="<?=$id_usuario?>" 
                                        type="button" 
                                        id="btnVerDetalhes" 
                                        onclick='verDetalhesAbono(this)'
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalVerDetalhesAbono"
                                        >
                                            Ver Detalhes
                                        </button>

                                    </div>

                                  </div>
                                </div>
                            </div>

                        <?php
                            } #fim foreach

                        }else{ #else empty  ?> 

                            <div class="col-12 mt-2 text-center">
                            <button class="btn btn-secondary" type="button">
                                Sem Abonos Pendentes!
                            </button>
                        </div>

                        <?php
                        } #fim if empty 
                        ?>


                        

                            
                        </div>
                    </div>


                    </div>
                </div>
            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->


    <!-- Modal -->
    <div class="modal fade" id="modalVerDetalhesAbono" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detalhes da Solicitação</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="conteudoModalAbono"> 

            <!-- dados dinamicos atraves do jquery -->
                
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>






    <!-- ======= RODAPÉ ======= -->
    <?php include "../includes/rodape.php";?>
    <script defer src="../assets/js/ponto/controleAbonoADM.js"></script>

</body>
</html>