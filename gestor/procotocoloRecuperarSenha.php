<?php
session_start();

require '../classes/sql.class.php';
$sql = new SQL();

$varLucas = $sql->getDadosSistema();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestor</title>

    <style>
        input::placeholder {
            color: gray;
            font-family: Arial;
            text-align: center;
            font-weight: 100;
            font-size: 18px;
        }
    </style>
    
    <?php include '../includes/cabecalho.php'; ?>
</head>
<body>

<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/<?=$varLucas[0]['icone']?>" alt="">
        <span class="d-none d-lg-block">Registro de Ponto</span>
    </a>
</div>


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <div id="relogio" style="margin-right: 40px; color: #000000; font-size: 21px; font-weight: 100;">

        </div>

    </ul>
</nav>
</header>

    <!-- Inicio menu Principal-->
<main id="main" class="main" style="margin-left: 0;">
   <section class="section dashboard">
      <div class="row">

         <div class="col-lg-12">
            <!-- inicio coluna a esquerda-->
            <div class="row">

                <!-- Card 'LOGIN' -->
                <div class="col-xxl-12 col-md-12"> <!--TAMANHO DO CARD -->
                  <div class="card info-card sales-card">


                     <div class="card-body">
                        <section class="ftco-section">
                           <div class="container">

                              <div class="row justify-content-center">
                                 <div class="col-md-7 col-lg-10"> <!-- TAMANHO DOS INPUTS-->
                                    <div class="login-wrap p-4 p-md-5">
                                       <h3 class="text-center mb-4">Seja bem-vindo<br>
                                            <b style="color: #012970; font-family: 'Nunito', sans-serif";>Recuperação de Senha</b>
                                        </h3>
                                    </div>
                                 </div>

                                 <hr>

                                 <form class="row" id="formSenha" method="POST">
                                    <div class="col-md-4">
                                        <label for="validationCustom01" class="form-label">MATRÍCULA</label>
                                        <input type="text" class="form-control" id="matricula" name="matricula" required>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label">EMAIL</label>
                                        <input type="text" class="form-control" id="email" name="email" required>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="validationCustomUsername" class="form-label">DATA DE NASCIMENTO</label>
                                        <input type="text" class="form-control" id="dtNasc" name="dtNasc" required>
                                    </div>


                                    <div class="col-12" style="margin-top: 20px">
                                        <button class="btn btn-primary" id="bntEsqueceuSenha" type="button">Solicitar Troca de Senha</button>
                                    </div>


                                    <div class="w-50 text-md-right mt-3">
                                        <a href="index.php">Voltar</a>
                                    </div>
                                </form>


                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
               </div><!-- FIM Card LOGIN -->
               
            </div>
         </div>
      </div>
   </section>
</main>


<!-- FIM DO MENU PRINCIPAL -->
<footer class="footer">
        <div class="credits">
             Criado Por <a href="http://<?=$_SERVER['HTTP_HOST']?>/gestaoPontoSeduc/gestor/creditos.php">Zephyr</a>
        </div>
    </footer>

<script src="../assets/jquery/mascaraJquery.js"></script>
<script src="../assets/js/gestor/procotocoloRecuperarSenha.js"></script>


</body>
</html>