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

#echo "<pre>";print_r();exit;



$meses = [
    "01" => "Jan",
    "02" => "Fev",
    "03" => "Mar",
    "04" => "Abr",
    "05" => "Mai",
    "06" => "Jun",
    "07" => "Jul",
    "08" => "Ago",
    "09" => "Set",
    "10" => "Out",
    "11" => "Nov",
    "12" => "Dez"
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Abonos</title>
    
    <?php include '../includes/cabecalho.php';?>


</head>

<body>

    <?php include '../includes/navBar.php'?>
    <?php include '../includes/menuLateral.php'?>


    <!-- Inicio menu Principal-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Solicitar Abonos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">inicio</a></li>
                    <li class="breadcrumb-item">Ponto Eletrônico</li>
                    <li class="breadcrumb-item active">Solicitar Abonos</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-11"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Solicite abonos para correção de seus horarios</h5>
                        <div class="card-body">

                            <form class="row g-3" id="frmSolicitarAbono" onsubmit="return false;">

                                <div class="col-md-4">
                                    <label for="mes" class="form-label">Mês</label>
                                    <select class="form-select" id="mes" name="mes">
                                        <option value="">Selecione...</option>
                                        <?php foreach ($meses as $numero => $nome) { ?>
                                            <option value="<?=$numero?>"><?=$nome?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="ano" class="form-label">Ano</label>
                                    <select class="form-select" id="ano" name="ano">
                                        <option value="">Selecione...</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                                  
                                  <div class="col-md-4 col-12">
                                    <label class="form-label mt-5"></label>
                                    <button class="btn btn-primary" type="button" onclick="buscarDadosTabela();">Buscar</button>
                                  </div>

                                  <hr>

                            </form>

                            <div id="respostaAjax">
                                
                            </div>
                            
                        </div>
                    </div>


                    </div>
                </div>


            </div>
        </section>

    </main><!-- FIM DO MENU PRINCIPAL -->


    <!-- Modal -->
    <div class="modal fade" id="modalSolicitarAbono" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" >Solicitação de Abono</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="corpoModalAbono">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- ======= RODAPE ======= -->
    <?php include "../includes/rodape.php";?>
    <script defer src="../assets/js/ponto/SolicitarAbono.js"></script>

</body>
</html>