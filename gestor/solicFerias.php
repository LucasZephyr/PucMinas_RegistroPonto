<?php

$tempo = 7200; #duas horas
session_set_cookie_params($tempo);
session_start();
if(!$_SESSION['usuario']['logado'] == 'sim'){
    header("Location: login.php");
}

require '../classes/sql.class.php';
$sql = new SQL();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Solictar Ferias</title>

    <script defer src="../assets/js/gestor/solicFerias.js"></script>
    
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
                    <li class="breadcrumb-item active">Solicitar F&eacute;rias</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12"> <!-- inicio coluna a esquerda-->
                    <div class="row">

                    <div class="card">
                        <h5 class="card-header">Preencha os Campos abaixo</h5>
                        <div class="card-body">

                            <div class="container">
                            <h2 class="mt-4">Formulário de Férias</h2>

                            <form class="row" name="formFerias" id="formFerias">
                              
                                <div class="form-group col-md-4 mt-3">
                                  <label for="dataInicio">Em qual dia você gostaria de iniciar suas férias?</label>
                                  <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
                                </div>

                                <div class="form-group col-md-4 mt-3">
                                  <label for="duracao">Quantos dias você quer tirar (20 a 30 dias)?</label>
                                  <input type="number" class="form-control" id="duracao" name="duracao" min="20" max="30" required>
                                </div>

                                <div id="perguntaAdicional" class="form-group mt-3 col-md-4" style="display: none;">

                                    <label for="adicionais">Gostaria de vender os outros dias restantes?</label>
                                    <select class="form-control" id="adicionais" name="adicionais" required>
                                        <option value="">Selecione</option>
                                        <option value="sim">Sim</option>
                                    </select>
                                </div>


                              

                                <div class="form-group mt-3 col-md-12">
                                    <label for="adiantamento">Receber adiantamento do 13º?</label>
                                        <select class="form-control" id="adiantamento" name="adiantamento" required>
                                            <option value="">Selecione</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                </div>


                              
                              <button type="button" id="btnFerias" class="btn btn-primary mt-3">Enviar</button>
                            </form>
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



