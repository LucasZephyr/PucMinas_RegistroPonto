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



    <script defer src="../assets/js/gestor/cadastrarUsuario.js"></script>



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

                                            <b style="color: #012970; font-family: 'Nunito', sans-serif";>Cria&ccedil;&atilde;o de Conta</b>

                                        </h3>

                                    </div>

                                 </div>



                                 <hr>



                            <form class="was-validated" action="processa/criarConta.php" method="POST">



                                <div class="row"> <!-- INICIO LINHA 01 -->

                                    <div class="col-md-5">

                                        <div class="mb-3">

                                            <label class="form-label">Nome</label>

                                                <input class="form-control" id="nome" name="nome" placeholder="EX: Pedro Almeida" required>

                                            <div class="invalid-feedback">

                                            Por favor! preencha este campo (Nome).

                                            </div>

                                        </div>

                                    </div>



                                    <div class="col-md-3">

                                        <div class="mb-3">

                                            <label class="form-label">Data Nascimento</label>

                                                <input class="form-control" type="date" id="nascimento" name="nascimento" required>

                                            <div class="invalid-feedback">

                                            Por favor! preencha este campo (Nascimento).

                                            </div>

                                        </div>

                                    </div>



                                    <div class="col-md-4">

                                        <div class="mb-3">

                                            <label for="validationTextarea" class="form-label">Setor</label>

                                                <input maxlength="20" class="form-control" id="set" name="set" placeholder="EX: RH" required>

                                            <div class="invalid-feedback">

                                            Por favor! preencha este campo (Setor).

                                            </div>

                                        </div>

                                    </div>

                                </div> <!--FIM LINHA 01 -->





                                <div class="row"> <!-- INICIO LINHA 02 -->

                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label class="form-label">Matr&iacute;cula</label>

                                                <input maxlength="15" class="form-control" id="mat" name="mat" placeholder="EX: 00121709" required>

                                            <div class="invalid-feedback">

                                            Por favor! preencha este campo (Nome).

                                            </div>

                                        </div>

                                    </div>





                                    <div class="col-md-6">

                                        <div class="mb-3">

                                            <label for="validationTextarea" class="form-label">Fun&ccedil;&atilde;o</label>

                                                <input class="form-control" id="func" name="func" placeholder="EX: secretário" required>

                                            <div class="invalid-feedback">

                                            Por favor! preencha este campo (Setor).

                                            </div>

                                        </div>

                                    </div>





                                </div> <!--FIM LINHA 02 -->





                                <div class="mb-3">

                                    <button class="btn btn-primary" type="submit"><i class="bi bi-box-arrow-in-right"></i> Criar Conta</button>

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